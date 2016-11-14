<?php

namespace App\Http\Controllers\User;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Vote\VoteRepositoryInterface;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Poll\PollRepositoryInterface;
use App\Repositories\ParticipantVote\ParticipantVoteRepositoryInterface;
use App\Repositories\Participant\ParticipantRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Mail;
use App\Models\Option;

class VoteController extends Controller
{

    protected $voteRepository;
    protected $activityRepository;
    protected $pollRepository;
    protected $participantVoteRepository;
    protected $participantRepository;
    protected $userRepository;

    public function __construct(
        VoteRepositoryInterface $voteRepository,
        ActivityRepositoryInterface $activityRepository,
        PollRepositoryInterface $pollRepository,
        ParticipantVoteRepositoryInterface $participantVoteRepository,
        ParticipantRepositoryInterface $participantRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->voteRepository = $voteRepository;
        $this->activityRepository = $activityRepository;
        $this->pollRepository = $pollRepository;
        $this->participantVoteRepository = $participantVoteRepository;
        $this->participantRepository = $participantRepository;
        $this->userRepository = $userRepository;
    }

    public function store(Request $request)
    {
        //get MAC address
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        $inputs = $request->only('option', 'input', 'poll_id', 'isRequiredEmail');
        $poll = $this->pollRepository->findPollById($inputs['poll_id']);
        $now = Carbon::now();

        //check time close poll
        if (Carbon::now()->format('d/m/Y h:i') > Carbon::parse($poll->date_close)->format('d/m/Y h:i')) {
            $poll->status = false;
            $poll->save();

            return view('errors.show_errors')->with('message', trans('polls.message_poll_closed'));
        }

        if (auth()->check()) {
            $currentUser = auth()->user();
            $participantInformation = [
                'user_id' => $currentUser->id,
            ];

            $isChanged = false;

            if (! $inputs['isRequiredEmail']) {
                if ($inputs['input'] != $currentUser->name) {
                    $participantInformation['name'] = $inputs['input'];
                    $isChanged = true;
                }
            } else {
                if ($inputs['input'] != $currentUser->email) {
                    if ($this->userRepository->checkEmailExist($inputs['input'])) {
                        return redirect()->to($poll->getUserLink())->with('message', trans('polls.email_exist') . "<br><a href='" .  url('login') . "'>" . trans('polls.login_here') . '</a>');
                    }

                    $participantInformation['email'] = $inputs['input'];
                    $isChanged = true;
                }
            }

            if (! $isChanged) {
                foreach ($inputs['option'] as $option) {
                    $votes[] = [
                        'user_id' => $currentUser->id,
                        'option_id' => $option,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            } else {
                $participant = $this->participantRepository->create($participantInformation);
                foreach ($inputs['option'] as $option) {
                    $participantVotes[] = [
                        'participant_id' => $participant->id,
                        'option_id' => $option,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            try {
                DB::beginTransaction();

                $activity = [
                    'poll_id' => $inputs['poll_id'],
                    'type' => config('settings.activity.participated'),
                    'user_id' => $currentUser->id,
                ];

                if ($isChanged) {
                    $this->participantVoteRepository->insert($participantVotes);
                    $activity['name'] = $inputs['input'];
                } else {
                    $this->voteRepository->insert($votes);
                }

                $this->activityRepository->create($activity);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            $participantInformation = [
                'ip_address' => $ip,
            ];

            if ($inputs['isRequiredEmail']) {
                if ($this->userRepository->checkEmailExist($inputs['input'])) {
                    return redirect()->to($poll->getUserLink())->with('message', trans('polls.email_exist') . "<br><a href='" .  url('login') . "'>" . trans('polls.login_here') . '</a>');
                }

                $participantInformation['email'] = $inputs['input'];
            } else {
                $participantInformation['name'] = $inputs['input'];
            }
            $participant = $this->participantRepository->create($participantInformation);
            foreach ($inputs['option'] as $option) {
                $participantVotes[] = [
                    'participant_id' => $participant->id,
                    'option_id' => $option,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            try {
                DB::beginTransaction();
                $this->participantVoteRepository->insert($participantVotes);
                $activity = [
                    'poll_id' => $inputs['poll_id'],
                    'type' => config('settings.activity.participated'),
                    'name' => $inputs['input'],
                ];
                $this->activityRepository->create($activity);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }


        $totalVote = config('settings.default_value');
        foreach ($poll->options as $option) {
            $totalVote += $option->countVotes();
        }

        $optionRate = [];

        if ($totalVote) {
            foreach ($poll->options as $option) {
                $countOption = $option->countVotes();
                $optionRateItem['rate'] = (int) ($countOption * 100 / $totalVote);
                $optionRateItem['count'] = $countOption;
                $optionRateItem['name'] = $option->name;
                $optionRate[] = $optionRateItem;
            }
        }

        $emails = $poll->user->email;
        $optionName = '';
        foreach ($inputs['option'] as $option) {
            $optionName .= Option::find($option)->name . ',';
        }

        $optionName = substr($optionName, 0, strlen($optionName) - 1);
        Mail::queue('layouts.vote_mail', [
            'optionName' => $optionName,
            'title' => $inputs['input'],
            'linkUser' => $poll->getUserLink(),
            'linkAdmin' => $poll->getAdminLink(),
            'optionRate' => $optionRate,
        ], function ($message) use ($emails) {
            $message->to($emails)->subject(trans('label.mail.subject'));
        });

        return redirect()->to($poll->getUserLink())->with('message', trans('polls.vote_successfully'));
    }

    public function destroy($id, Request $request)
    {
        $inputs = $request->only('poll_id');
        $poll = $this->pollRepository->findPollById($inputs['poll_id']);
        $voteIds = $this->pollRepository->getVoteIds($inputs['poll_id']);

        if ($voteIds) {
            $this->voteRepository->deleteVote($voteIds);
        }

        $participantVoteIds = $this->pollRepository->getParticipantVoteIds($inputs['poll_id']);

        if ($participantVoteIds) {
            $this->participantVoteRepository->delete($participantVoteIds);
            $this->participantRepository->delete($id);
        }

        return redirect()->to($poll->getUserLink())->with('message', trans('polls.remove_vote_successfully'));
    }
}

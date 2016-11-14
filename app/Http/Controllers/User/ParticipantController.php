<?php

namespace App\Http\Controllers\User;

use Flashy;
use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Participant\ParticipantRepositoryInterface;
use App\Repositories\ParticipantVote\ParticipantVoteRepositoryInterface;
use App\Repositories\Vote\VoteRepositoryInterface;
use App\Repositories\Activity\ActivityRepositoryInterface;
use App\Repositories\Poll\PollRepositoryInterface;

class ParticipantController extends Controller
{
    protected $participantRepository;
    protected $participantVoteRepository;
    protected $voteRepository;
    protected $activityRepository;
    protected $pollRepository;

    public function __construct(
        ParticipantRepositoryInterface $participantRepository,
        ParticipantVoteRepositoryInterface $participantVoteRepository,
        VoteRepositoryInterface $voteRepository,
        ActivityRepositoryInterface $activityRepository,
        PollRepositoryInterface $pollRepository
    ) {
        $this->participantRepository = $participantRepository;
        $this->participantVoteRepository = $participantVoteRepository;
        $this->voteRepository = $voteRepository;
        $this->activityRepository = $activityRepository;
        $this->pollRepository = $pollRepository;
    }

    public function deleteAllParticipant(Request $request)
    {
        $inputs = $request->only('poll_id');
        $poll = $this->pollRepository->find($inputs['poll_id']);
        $this->participantRepository->deleteAllParticipants($inputs['poll_id'], $this->participantVoteRepository, $this->voteRepository);
        $emails = $poll->user->email;

        if ($emails) {
            Mail::queue('layouts.delete_all_participant_mail', [
                'link' => $poll->getAdminLink(),
            ], function ($message) use ($emails) {
                $message->to($emails)->subject(trans('label.mail.subject'));
            });
        }

        Flashy::message(trans('polls.flashy_message'), 'https://mail.google.com/mail');
        $activity = [
            'poll_id' => $inputs['poll_id'],
            'type' => config('settings.activity.all_participants_deleted'),
        ];

        if (auth()->check()) {
            $activity['user_id'] = auth()->user()->id;
        }

        $this->activityRepository->create($activity);

        return redirect()->to($poll->getUserLink())->with('message', trans('polls.delete_all_participants_successfully'));
    }
}

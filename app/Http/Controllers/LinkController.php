<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Link\LinkRepositoryInterface;
use App\Repositories\Poll\PollRepositoryInterface;
use App\Repositories\Vote\VoteRepositoryInterface;
use App\Repositories\ParticipantVote\ParticipantVoteRepositoryInterface;
use Carbon\Carbon;

class LinkController extends Controller
{
    protected $linkRepository;
    protected $pollRepository;
    protected $voteRepository;
    protected $participantVoteRepository;

    public function __construct(
        LinkRepositoryInterface $linkRepository,
        PollRepositoryInterface $pollRepository,
        VoteRepositoryInterface $voteRepository,
        ParticipantVoteRepositoryInterface $participantVoteRepository
    ) {
        $this->linkRepository = $linkRepository;
        $this->pollRepository = $pollRepository;
        $this->voteRepository = $voteRepository;
        $this->participantVoteRepository = $participantVoteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->value;
        $links = Link::where('token', $token)->get();

        if (! $links->count()) {
            return [
                'success' => false,
            ];
        }

        return [
            'success' => true,
            'link' => $links,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token, Request $request)
    {
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

        dd($ip);
        
        $link = $this->linkRepository->getPollByToken($token);

        if (! $link) {
            return view('errors.show_errors')->with('message', trans('polls.poll_not_found'));
        }

        if ($link->poll->isClosed()) {
            return view('errors.show_errors')->with('message', trans('polls.message_poll_closed'));
        }

        $linkUser = url('link') . '/' . $link->token;
        $numberOfVote = config('settings.default_value');
        $voteLimit = null;
        $isRequiredEmail = false;
        $isHideResult = false;
        $poll = $link->poll;
        $totalVote = config('settings.default_value');

        //check time close poll
        if (Carbon::now()->format('d/m/Y h:i') > Carbon::parse($poll->date_close)->format('d/m/Y h:i')) {
            $poll->status = false;
            $poll->save();

            return view('errors.show_errors')->with('message', trans('polls.message_poll_closed'));
        }

        foreach ($poll->options as $option) {
            $totalVote += $option->countVotes();
        }

        $optionRatePieChart = [];
        $optionRateBarChart = [];

        if ($totalVote) {
            foreach ($poll->options as $option) {
                $countOption = $option->countVotes();
                $optionRatePieChart[$option->name] = (int) ($countOption * 100 / $totalVote);
                if ($countOption > 0) {
                    $optionRateBarChart[] = [str_limit($option->name, 15), $countOption];
                }
            }
        }

        $optionRateBarChart = json_encode($optionRateBarChart);

        $requiredPassword = null;
        $passwordSetting = $poll->settings->whereIn('key', [config('settings.setting.set_password')])->first();

        if ($passwordSetting) {
            $requiredPassword = $passwordSetting->value;
        }


        if ($poll->settings) {
            foreach ($poll->settings as $setting) {
                if ($setting->key == config('settings.setting.set_limit')) {
                    $voteLimit = $setting->value;
                }

                $isRequiredEmail = ($setting->key == config('settings.setting.required_email'));
                $isHideResult = ($setting->key == config('settings.setting.hide_result'));
            }
        }

        if (! $link->link_admin) {

            if ($poll->settings) {
                foreach ($poll->settings as $setting) {
                    if ($setting->key == config('settings.setting.set_limit')) {
                        $voteLimit = $setting->value;
                    }
                }

                if ($voteLimit && $poll->countParticipants() >= $voteLimit) {
                    return view('errors.show_errors')->with('message', trans('polls.message_poll_limit'));
                }
            }

            $isRequiredEmail = $poll->settings->whereIn('key', [config('settings.setting.required_email')])->count() != config('settings.default_value');
            $isHideResult = $poll->settings->whereIn('key', [config('settings.setting.hide_result')])->count() != config('settings.default_value');
            $voteIds = $this->pollRepository->getVoteIds($poll->id);
            $votes = $this->voteRepository->getVoteWithOptionsByVoteId($voteIds);
            $participantVoteIds = $this->pollRepository->getParticipantVoteIds($poll->id);
            $participantVotes = $this->participantVoteRepository->getVoteWithOptionsByVoteId($participantVoteIds);
            $mergedParticipantVotes = $votes->toBase()->merge($participantVotes->toBase());

            if ($mergedParticipantVotes->count()) {
                foreach ($mergedParticipantVotes as $mergedParticipantVote) {
                    $createdAt[] = $mergedParticipantVote->first()->created_at;
                }

                $sortedParticipantVotes = collect($createdAt)->sort();
                $resultParticipantVotes = collect();
                foreach ($sortedParticipantVotes as $sortedParticipantVote) {
                    foreach ($mergedParticipantVotes as $mergedParticipantVote) {
                        foreach ($mergedParticipantVote as $participantVote) {
                            if ($participantVote->created_at == $sortedParticipantVote) {
                                $resultParticipantVotes->push($mergedParticipantVote);
                                break;
                            }

                        }
                    }
                }
                $mergedParticipantVotes = $resultParticipantVotes;
            }

            $isUserVoted = false;
            $isParticipantVoted = false;

            if (auth()->check()) {
                $isUserVoted = $this->pollRepository->checkUserVoted($poll->id, $this->voteRepository);
            } else {
                foreach ($participantVotes as $participantVote) {
                    foreach($participantVote as $item) {
                        if (isset($item->participant) && $item->participant->ip_address == $request->ip()) {
                            $isParticipantVoted = true;
                            break;
                        }
                    }
                }
            }

            $optionCombobox = [];
            $index = 0;
            foreach ($poll->options as $option) {
                $index += 1;
                $optionCombobox[$option->id] = "option " . $index;
            }

            return view('user.poll.details', compact(
                'optionCombobox', 'poll', 'isRequiredEmail', 'isUserVoted', 'isHideResult', 'numberOfVote', 'linkUser', 'mergedParticipantVotes', 'isParticipantVoted', 'requiredPassword',
                'optionRatePieChart', 'optionRateBarChart'
            ));
        } else {
            $poll = $link->poll;

            $voteIds = $this->pollRepository->getVoteIds($poll->id);
            $votes = $this->voteRepository->getVoteWithOptionsByVoteId($voteIds);
            $participantVoteIds = $this->pollRepository->getParticipantVoteIds($poll->id);
            $participantVotes = $this->participantVoteRepository->getVoteWithOptionsByVoteId($participantVoteIds);
            $mergedParticipantVotes = $votes->toBase()->merge($participantVotes->toBase());

            if ($mergedParticipantVotes->count()) {
                foreach ($mergedParticipantVotes as $mergedParticipantVote) {
                    $createdAt[] = $mergedParticipantVote->first()->created_at;
                }

                $sortedParticipantVotes = collect($createdAt)->sort();
                $resultParticipantVotes = collect();
                foreach ($sortedParticipantVotes as $sortedParticipantVote) {
                    foreach ($mergedParticipantVotes as $mergedParticipantVote) {
                        foreach ($mergedParticipantVote as $participantVote) {
                            if ($participantVote->created_at == $sortedParticipantVote) {
                                $resultParticipantVotes->push($mergedParticipantVote);
                                break;
                            }

                        }
                    }
                }
                $mergedParticipantVotes = $resultParticipantVotes;
            }

            foreach ($poll->links as $link) {
                if ($link->link_admin) {
                    $tokenLinkAdmin = $link->token;
                } else {
                    $tokenLinkUser = $link->token;
                }
            }

            $isRequiredEmail = $poll->settings->whereIn('key', [config('settings.setting.required_email')])->count() != config('settings.default_value');

            return view('user.poll.manage_poll', compact('poll', 'tokenLinkUser', 'tokenLinkAdmin', 'isRequiredEmail', 'isUserVoted', 'isHideResult', 'numberOfVote', 'linkUser', 'mergedParticipantVotes', 'isParticipantVoted'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

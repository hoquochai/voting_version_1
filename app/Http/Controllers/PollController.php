<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Http\Requests\PollEditRequest;
use App\Http\Requests\PollRequest;
use App\Repositories\Poll\PollRepositoryInterface;
use Illuminate\Http\Request;
use Mail;
use Flashy;

class PollController extends Controller
{
    private $pollRepository;

    public function __construct(PollRepositoryInterface $pollRepository)
    {
        $this->pollRepository = $pollRepository;
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
        $data = $this->pollRepository->getDataPollSystem();

        return view('user.poll.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(
            'title', 'location', 'description', 'name', 'email', 'chatwork_id', 'type', 'closingTime',
            'optionText', 'optionImage',
            'setting', 'value',
            'member'
        );
        $data = $this->pollRepository->store($input);

        if ($data) {
            $poll = $data['poll'];

            return redirect()->route('result-poll.show', ['id' => $poll->id]);
        } else {
            $message = trans('polls.message.create_fail');

            return redirect()->route('user-poll.create')->with('message', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->pollRepository->getDataPollSystem();
        $poll = Poll::with('user', 'options', 'settings')->find($id);
        $setting = $poll->settings->pluck('value', 'key')->toArray();
        $page = 'edit';
        $totalVote = $this->pollRepository->getTotalVotePoll($poll);

        return view('user.poll.edit', compact('poll', 'data', 'setting', 'page', 'totalVote'));
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
        $button = $request->btn_edit;
        $poll = Poll::with('options')->findOrFail($id);

        if ($button == trans('polls.button.save_info')) {
            $input = $request->only(
                'name', 'email', 'chatwork_id', 'title', 'location', 'description', 'type'
            );
            $input['date_close'] = $request->closingTime;

            $message = $this->pollRepository->editInfor($input, $id);
        } elseif ($button == trans('polls.button.save_option')) {
            $input = $request->only(
                'option', 'image', 'optionImage', 'optionText'
            );
            $message = $this->pollRepository->editPollOption($input, $id);
        } elseif ($button == trans('polls.button.save_setting')) {
            $input = $request->only(
                'setting', 'value'
            );
            $message = $this->pollRepository->editPollSetting($input, $id);
        }

        return redirect()->to($poll->getAdminLink())->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poll = $this->pollRepository->find($id);

        if (! $poll) {
            return view('errors.show_errors')->with('message', trans('polls.close_poll_fail'));
        }

        $emails = $poll->email;

        if ($poll->user_id) {
            $emails = $poll->user->email;
        }

        if ($emails) {
            Mail::queue('layouts.close_poll_mail', [
                'link' => $poll->getAdminLink(),
            ], function ($message) use ($emails) {
                $message->to($emails)->subject(trans('label.mail.subject'));
            });

            if (count(Mail::failures()) == config('settings.default_value')) {
                $poll->status = false;
                $poll->save();
            }
        }

        $poll->status = false;
        $poll->save();

        return redirect()->to($poll->getAdminLink())->with('messages', trans('polls.close_poll_successfully'));
    }
}

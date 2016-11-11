<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class DuplicateController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $settingConfig = config('settings.setting');
        $settingTrans = trans('polls.label.setting');
        $dataJson = json_encode([
            'message' => [
                'numberOfOptions' => config('settings.length_poll.option'),
                'length' => [
                    'title' => config('settings.length_poll.title'),
                    'description' => config('settings.length_poll.description'),
                    'name' => config('settings.length_poll.name'),
                    'email' => config('settings.length_poll.email'),
                    'link' => config('settings.length_poll.link'),
                    'limit' => config('settings.length_poll.number_limit'),
                    'password' => config('settings.length_poll.password_poll'),
                ],
                'confirm_delete_option' => trans('polls.message.confirm_delete'),
                'config' => [
                    'invite_all' => config('settings.participant.invite_all'),
                    'invite_people' => config('settings.participant.invite_people'),
                ],
                'setting' => [
                    'link' => $settingConfig['custom_link'],
                    'limit' => $settingConfig['set_limit'],
                    'password' => $settingConfig['set_password'],
                ],
                'validate' => [
                    'required' => trans('polls.validate_client.required'),
                    'max' => trans('polls.validate_client.max'),
                    'email' => trans('polls.validate_client.email'),
                    'number' => trans('polls.validate_client.number'),
                    'choose' => trans('polls.validate_client.choose'),
                    'option_empty' => trans('polls.validate_client.option_empty'),
                    'option_required' => trans('polls.validate_client.option_required'),
                    'participant_empty' => trans('polls.validate_client.participant_empty'),
                    'character' => trans('polls.validate_client.character'),
                    'email_exists' => trans('polls.message.email_exists'),
                    'email_valid' => trans('polls.message.email_valid'),
                    'link_exists' => trans('polls.message.link_exists'),
                    'link_valid' => trans('polls.message.link_valid'),
                ],
            ],
            'view' => [
                'option' => view('layouts.poll_option')->render(),
                'email' => view('layouts.poll_email')->render(),
            ],
            'oldInput' => session("_old_input"),
        ]);
        $dataView = [
            'setting' => [
                $settingConfig['required_email'] => $settingTrans['required_email'],
                $settingConfig['hide_result'] => $settingTrans['hide_result'],
                $settingConfig['custom_link'] => $settingTrans['custom_link'],
                $settingConfig['set_limit'] => $settingTrans['set_limit'],
                $settingConfig['set_password'] => $settingTrans['set_password'],
            ],
        ];
        $poll = Poll::with('user', 'options', 'settings')->find($id);
        $setting = $poll->settings->pluck('value', 'key')->toArray();

        return view('user.poll.duplicate', compact('poll', 'dataJson', 'dataView', 'setting'));
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

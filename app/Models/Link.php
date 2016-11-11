<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Poll;
use Mail;

class Link extends Model
{
    protected $fillable = [
        'poll_id',
        'token',
        'link_admin',
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function isTokenExist($token)
    {
        return $this->where('token', $token)->count() != config('settings.default_value');
    }

    public function editToken($tokenInput)
    {
        $result = [
            'success' => false,
            'is_exist' => false,
        ];

        if ($this->isTokenExist($tokenInput)) {
            $result['is_exist'] = true;

            return response()->json($result);
        }

        if ($tokenInput != $this->token) {
            $this->token = $tokenInput;
            $result['success'] = true;
            $emails = $this->poll->user->email;

            Mail::send('layouts.edit_link_mail', [
                'link' => url('/link') . '/' . $tokenInput,
            ], function ($message) use ($emails) {
                $message->to($emails)->subject(trans('label.mail.subject'));
            });

            $this->save();

            return response()->json($result);
        }

        return response()->json($result);
    }
}

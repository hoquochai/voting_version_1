<?php

namespace App\Models;

use App\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Option;
use App\Models\Setting;
use App\Models\Link;
use App\Models\Activity;
use App\Models\Comment;

class Poll extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'multiple',
        'location',
        'date_close',
        'name',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function countComments()
    {
        return $this->comments->count();
    }

    public function countParticipants()
    {
        $count = config('settings.default_value');
        $options = $this->options;
        $voteIds = [];

        if ($options) {
            foreach ($options as $option) {
                $votes = $option->votes;

                if ($votes) {
                    foreach ($votes as $vote) {
                        $voteIds[] = $vote->id;
                    }
                }
            }
        }

        $votes = Vote::whereIn('id', $voteIds)->with('user', 'option')->get()->groupBy('user_id');
        $options = $this->options;
        $participantVoteIds = [];

        if ($options) {
            foreach ($options as $option) {
                $participantVotes = $option->participantVotes;

                if ($participantVotes) {
                    foreach ($participantVotes as $participantVote) {
                        $participantVoteIds[] = $participantVote->id;
                    }
                }
            }
        }

        $participantVotes = ParticipantVote::whereIn('id', $participantVoteIds)->with('participant', 'option')->get()->groupBy('participant_id');
        $mergedParticipantVotes = $votes->toBase()->merge($participantVotes->toBase());

        if ($mergedParticipantVotes->count()) {
            foreach ($mergedParticipantVotes as $mergedParticipantVote) {
                $createdAt[] = $mergedParticipantVote->first()->created_at;
            }

            $count = collect($createdAt)->count();
        }

        return $count;
    }

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }

    public function getUserLink()
    {
        if (!$this->links) {
            return false;
        }

        foreach ($this->links as $link) {
            if ($link->link_admin == config('settings.default_value')) {
                return url('link') . '/' . $link->token;
            }
        }
    }

    public function getAdminLink()
    {
        if (!$this->links) {
            return false;
        }

        foreach ($this->links as $link) {
            if ($link->link_admin != config('settings.default_value')) {
                return url('link') . '/' . $link->token;
            }
        }
    }

    public function getMultipleAttribute($value)
    {
        return ($value == config('settings.type_poll.multiple_choice')
            ? trans('polls.label.multiple_choice')
            : trans('polls.label.single_choice'));
    }

    public function getStatusAttribute($value)
    {
        return ($value == config('settings.status.open')
            ? trans('polls.label.poll_opening')
            : trans('polls.label.poll_closed'));
    }

    public function isClosed()
    {
        return $this->status == trans('polls.label.poll_closed');
    }

    public function showStatus()
    {
        if ($this->status == trans('polls.label.poll_opening')) {
            return "<label class='label label-success'>" . trans('polls.label.poll_opening') . '</label>';
        } elseif ($this->status == trans('polls.label.poll_closed')) {
            return "<label class='label label-danger'>" . trans('polls.label.poll_closed') . '</label>';
        }
    }

    public function getListEmailVoted()
    {
        $listEmail = [];
        try {
            foreach ($this->options as $option) {
                if ($option->votes->count()) {
                    foreach ($option->votes as $vote) {
                        if ($vote->user->email) {
                            $listEmail[] = $vote->user->email;
                        }
                    }
                }

                if ($option->participantVotes->count()) {
                    foreach ($option->participantVotes as $participantVote) {
                        if ($participantVote->participant->email) {
                            $listEmail[] = $participantVote->participant->email;
                        }
                    }
                }
            }
        } catch(\Exception $ex) {
            return [];
        }

        return $listEmail;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'body','price','profilePics'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getProfilePicsAttribute()
    {
        // return $this->attributes['admin'] == 'yes';
        return json_decode($this->attributes['profilePics'], true);
    }

    protected $appends = ['profilePics'];
}

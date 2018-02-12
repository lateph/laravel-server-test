<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'body','price','profilePics','category_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getProfilePicsAttribute()
    {
        // return $this->attributes['admin'] == 'yes';
        if($this->attributes['profilePics']){
            $img =  json_decode($this->attributes['profilePics'], true);
            foreach ($img as $key => $value) {
                if (substr($value, 0, 4) != 'http') { 
                    $img[$key] = url('/img').'/'.$value; 
                }
            }
            return $img;
        }
        else{
            return false;
        }
    }

    protected $appends = ['profilePics'];
}

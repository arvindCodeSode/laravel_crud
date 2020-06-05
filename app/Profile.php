<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=[
        'image','','dob','hobbies','user_id'
    ];
    public function hasProfile(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

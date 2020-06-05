<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=[
        'name','class','email','phone'
    ];
    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id');
    }
}

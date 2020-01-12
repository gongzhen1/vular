<?php

namespace Water\Vular\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Admin extends User {
    use HasApiTokens, Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','issupper',
    ];

    public function roles()
    {
        return $this->belongsToMany('Water\Vular\Models\Role');
    }

    public function avatar(){
        return $this->belongsTo('Water\Vular\Models\Media');
    }

    public function avatarMedia(){
        $avatar = $this->avatarMedia;
        return $avatar ? $avatar->fitName(350,350) : 'avatar-blank.jpg';
    }

    public function isPermitted($authPoint){
        if($this->issupper){
            return true;
        }

        foreach ($this->roles as $role) {
             if($role->isPermitted($authPoint)){
                return true;
             }
        }

        return false;
    }
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property mixed role
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'username', 'phone', 'name', 'email', 'password', 'provider', 'provider_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role){
        return $role === $this->role;
    }

    /**
     * @return bool
     */
    public function isAdmin(){
        return $this->role === "admin";
    }

    /**
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at) ? true : false;
    }

    /**
     * @return bool
     */
    public function hasUpdatedAddress(){
        return (!is_null($this->address) || !is_null($this->birthday));
    }

    /**
     * @return bool
     */
    public function hasNotUpdatedAddress(){
        return (is_null($this->address) && is_null($this->birthday));
    }

    public function getName(){
        return $this->name;
    }



}

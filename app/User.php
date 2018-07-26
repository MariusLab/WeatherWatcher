<?php

namespace MariusLab;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email'
    ];

    public function triggers()
    {
        return $this->hasMany('MariusLab\Trigger');
    }
}

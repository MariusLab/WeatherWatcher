<?php

namespace MariusLab;

use Illuminate\Database\Eloquent\Model;

class Trigger extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'weather_attribute', 'condition'
    ];

    /**
     * Number of lives a trigger has
     * If set to null - never expires automatically
     *
     * @var int
     */
    protected $expires_after;

    /**
     * Weather attribute such as wind speed, temperature etc.
     *
     * @var string
     */
    protected $weather_attribute;

    /**
     * The condition for the trigger to activate
     *
     * @var string
     */
    protected $condition;

    public function users()
    {
        return $this->hasOne('MariusLab\User');
    }
}

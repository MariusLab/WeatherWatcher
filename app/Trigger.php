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
        'weather_attribute', 'condition'
    ];

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

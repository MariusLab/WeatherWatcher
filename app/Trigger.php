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
        'user_id', 'name', 'expression', 'amount'
    ];

    /**
     * Weather attribute such as wind_speed, temp etc.
     *
     * @var string
     */
    protected $name;

    /**
     * The expression for comparison
     *
     * @var string
     */
    protected $expression;

    /**
     * @var Value to be compared with
     */
    protected $amount;

    public function users()
    {
        return $this->hasOne('MariusLab\User');
    }
}

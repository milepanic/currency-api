<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyValue extends Model
{
    protected $guarded = [];

    protected $casts = [
        'exchange_rates' => 'array',
    ];

    protected $dates = [
        'date',
    ];
}

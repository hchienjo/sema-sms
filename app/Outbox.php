<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    protected $table = 'outbox';
    protected $dates = [
        'createdAt',
        'sendAt',
        'updatedAt'
    ];
}

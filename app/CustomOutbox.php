<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomOutbox extends Model
{
    protected $table = 'customOutbox';
    protected $primaryKey = 'id';

    protected $dates = [
        'createdAt',
        'updatedAt',
    ];
}

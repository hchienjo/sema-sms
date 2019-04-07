<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $primaryKey = 'subscriberID';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $dates = [
        'createdAt',
        'updatedAt',
        'deletedAt',
    ];
}

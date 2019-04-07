<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'contactID';

    const CREATED_AT = 'createdAt';
    const DELETED_AT = 'deletedAt';
    const UPDATED_AT = 'updatedAt';

    public $dates = [
        'createdAt',
        'deletedAt',
        'updatedAt',
    ];
}

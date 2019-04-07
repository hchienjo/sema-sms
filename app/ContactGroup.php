<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    protected $table = 'contactGroups';
    protected $primaryKey = 'contactGroupID';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $dates = [
        'createdAt',
        'deletedAt',
        'updatedAt',
    ];
}

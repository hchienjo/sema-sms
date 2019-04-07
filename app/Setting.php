<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'settingID';

    const CREATED_AT = 'createdAt';
    const DELETED_AT = 'deletedAt';
    const UPDATED_AT = 'updatedAt';

    public $dates = [
        'createdAt',
        'deletedAt',
        'updatedAt',
    ];

    public function scopeSdpPasswords($query) {
        return $query->where('name', '=', 'password')
            ->where('key', 'LIKE', '6%');
    }
}

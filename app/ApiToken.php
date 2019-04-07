<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiToken extends Model
{
    protected $table = 'ApiTokens';

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    public function status() {
        if ($this->status == 1){
            return 'Active';
        }
        return 'Disabled';
    }

    protected $dates = [
        'createdAt',
        'updatedAt',
        'deletedAt'
    ];

    public function organization(){
        return $this->BelongsTo('App\Organization', 'organizationID', 'organizationID')->withDefault([
            'companyName' => 'Unassigned'
        ]);
    }
}

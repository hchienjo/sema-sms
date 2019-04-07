<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    protected $primaryKey = 'serviceID';
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $dates = [
        'createdAt',
        'updatedAt',
        'deletedAt',
    ];

    public function serviceNameSlug(){
        return str_slug($this->serviceName);
    }

    public function organization(){
        return $this->BelongsTo('App\Organization', 'organizationID', 'organizationID')->withDefault([
            'companyName' => 'Unassigned'
        ]);
    }

    public function subscribers(){
        return $this->hasMany(Subscriber::class, 'productID', 'productID')
            ->where('status', '=', 1);
    }
}

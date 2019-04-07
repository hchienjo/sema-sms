<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = "identifier";

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';
    
    protected $dates = [
        'createdAt',
        'updatedAt',
        'deletedAt',
    ];

    public $incrementing = false;

    public function identifier(){
        return substr($this->identifier, 0, 8);
    }

    public function deletedAt(){
        $delTime = $this->deletedAt;
        if (empty($delTime)){
            $delTime = $this->createdAt;
        }
        return $delTime->setTimeZone('Africa/Nairobi');
    }
}

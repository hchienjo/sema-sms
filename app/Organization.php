<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class Organization extends Model
{

    protected $table = 'organization';
    protected $primaryKey = 'organizationID';
    protected $appends = ['units'];

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';
    const DELETED_AT = 'deletedAt';

    protected $dates = [
        'createdAt',
        'updatedAt',
        'deletedAt'
    ];

    public function getUnitsAttribute(){
        return sprintf("%.2f", Redis::get("units." . $this->organizationID));
    }

    public function type(){
        switch ($this->type){
            case 9:
                return "Post Paid";
                break;
            default:
                return "Pre Paid";
                break;
        }
    }

    public function status(){
        switch ($this->status){
            case 1:
                return "Active";
                break;
            case 2:
                return "Inactive";
                break;
        }
    }

    //Services are senderIDs and shortcodes registered to this organization
    public function services(){
        return $this->hasMany("App\Service", "organizationID", 'organizationID');
    }
}

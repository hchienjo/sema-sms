<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_group', 'company_id', 'friendlyID', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userGroup(){
        switch($this->user_group){
            case 1:
                return 'Super Admin';
                break;
            case 2:
                return 'Company User';
                break;
            default:
                return "Unassigned";
                break;
        }
    }

    public function organization(){
        return $this->hasOne('App\Organization', 'organizationID', 'company_id')->withDefault([
            'companyName' => 'Unassigned'
        ]);
    }

    public function status() {
        switch($this->status){
            case 1:
                return 'Active';
                break;
            case 2:
                return 'Disabled';
                break;
            default:
                return 'Unverified';
        }
    }
}

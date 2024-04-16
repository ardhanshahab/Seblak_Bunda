<?php

namespace App\Models;

use App\Models\Master\OutletUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes;

    protected $appends = ['role_name','outlet_list'];

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

 
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];  

    // Relation
    public function OutletUser()
    {
        return $this->hasMany(OutletUser::class);
    }

    // Appends

    public function getRoleNameAttribute()
    {
        return $this->roles()->pluck('name')[0];
    }

    public function getOutletListAttribute()
    {
        $outlet = '<ul>';
        foreach($this->OutletUser as $outletUser){
            $outlet .= '<li>' . $outletUser->outlet->name . '</li>';
        }
        $outlet .= '</ul>';
        return $outlet;
    }
}

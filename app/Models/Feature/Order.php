<?php

namespace App\Models\Feature;

use App\Models\Master\Outlet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function Outlet()
    {
        return $this->belongsTo(Outlet::class,'outlet_id');
    }

    public function Cashier()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}

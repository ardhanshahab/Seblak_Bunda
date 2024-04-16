<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletUser extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function Outlet()
    {
        return $this->belongsTo(Outlet::class,'outlet_id');
    }
}

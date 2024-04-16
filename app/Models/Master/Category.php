<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [''];
    protected $appends = ['image_path'];

    // Appends
    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
}

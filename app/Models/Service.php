<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $appends = ['Created'];
    protected $guarded = [];

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}

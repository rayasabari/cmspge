<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeFront extends Model
{
    use HasFactory;
    protected $table = 'page_home_front';
    protected $appends = ['LastUpdate'];

    public function getLastUpdateAttribute()
    {
        return $this->updated_at->diffForHumans();
    }
}

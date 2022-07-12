<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_parent',
        'parent_id',
        'slug',
        'title',
        'meta_description',
        'front_path',
        'created_by_id',
        'updated_by_id',
    ];
}

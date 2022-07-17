<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    
    protected $appends = ['Created'];
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

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}

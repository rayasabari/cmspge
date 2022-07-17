<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $with = ['element'];
    protected $fillable = [
        'page_id',
        'element_id',
        'title',
        'sub_title',
        'text',
        'image_id',
        'created_by_id',
        'updated_by_id',
    ];

    public function element()
    {
        return $this->belongsTo(Element::class)->select('id','name','slug');
    }
}

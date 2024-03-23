<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class contentBoard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'categoryId',
        'directory',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(categoryBoard::class, 'categoryId', 'id');
    }

    public function machine()
    {
        return $this->hasMany(contentAssgin::class, 'contentId', 'id');
    }


    public function contentMachine()
    {
        return $this->belongsToMany(contentAssgin::class, 'content_assgins', 'contentId', 'mesinId');
    }
}

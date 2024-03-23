<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoryBoard extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'keterangan'
    ];

    public function content()
    {
        return $this->hasMany(contentBoard::class, 'categoryId', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_pointCheck extends Model
{
    use HasFactory;
    protected $table = "point_check";
    protected $primaryKey = 'id_check';
}

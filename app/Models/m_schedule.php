<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_schedule extends Model
{
    use HasFactory;
    protected $table = "schedule";
    protected $primaryKey = 'id_schedule';
}

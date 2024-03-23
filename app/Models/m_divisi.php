<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_divisi extends Model
{
    use HasFactory;
    protected $table = "divisi";
    protected $primaryKey = "id_divisi";
}

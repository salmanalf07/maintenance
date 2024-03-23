<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_jenisMesin extends Model
{
    use HasFactory;
    protected $table = "jenis_mesin";
    protected $primaryKey = 'id_jenisMesin';
}

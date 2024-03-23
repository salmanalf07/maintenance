<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_mesin extends Model
{
    use HasFactory;
    protected $table = "mesin";
    protected $primaryKey = 'id_mesin';

    public function jenisMesin()
    {
        return $this->belongsTo(m_jenisMesin::class, 'jenis_mesin', 'id_jenisMesin');
    }
}

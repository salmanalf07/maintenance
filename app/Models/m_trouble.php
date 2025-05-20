<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class m_trouble extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "trouble";

    function detailTrouble()
    {
        return $this->hasOne(detailTrouble::class, 'troubleId', 'id');
    }
    function divisi()
    {
        return $this->belongsTo(m_divisi::class, 'id_divisi', 'id_divisi');
    }
    function mesin()
    {
        return $this->belongsTo(m_mesin::class, 'id_mesin', 'id_mesin');
    }
}

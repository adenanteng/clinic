<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitLab extends Model
{
    use HasFactory;

    public $table = 'visit_labs';

    public $fillable = [
        'visit_id',
        'type',
        'treatment_id',
        'klinis',
        'description',
        'date',
        'status',
    ];

    const DIBUAT = 1;
    const DIMINTA = 2;
    const DIKERJAKAN = 3;
    const SELESAI = 4;
    const DITERIMA = 5;
    const LAB_STATUS = [
        self::DIBUAT => 'Dibuat',
        self::DIMINTA => 'Diminta',
        self::DIKERJAKAN => 'Sedang dikerjakan',
        self::SELESAI => 'Selesai',
        self::DITERIMA => 'Telah diterima pasien',
    ];

    const LAB = 1;
    const RADIOLOGI = 2;
    const LAB_TYPE = [
        self::LAB => 'Laboratorium',
        self::RADIOLOGI => 'Radiologi',
    ];

    /**
     *
     * @return BelongsTo
     */
    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}

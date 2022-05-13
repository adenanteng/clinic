<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitBilling extends Model
{
    use HasFactory;

    protected $table = 'visit_billings';

    public $fillable = [
        'visit_id',
        'type',
        'name',
        'unit_price',
        'duration',
        'description',
        'status',
    ];

    const ADMINISTRATION = 1;
    const DRUG = 2;
    const BHP = 3;
    const LABORATORIUM = 4;
    const ROOM_RATE = 5;
    const BILLING_TYPE = [
        self::ADMINISTRATION  => 'Administrasi',
        self::DRUG  => 'Obat',
        self::BHP  => 'BHP',
    ];

    const PENDAFTARAN_ODP = 15000;
    const PENDAFTARAN_IDP = 100000;
    const KONSUL_ODP = 50000;
    const KONSUL_IDP = 75000;
    const PARAMEDIS = 5000;
    const RADIOLOGI = 10000;
    const TINDAKAN = 80000;
    const ADM_TYPE = [
        self::PENDAFTARAN_ODP  => 'Pendaftaran Rawat Jalan',
        self::PENDAFTARAN_IDP  => 'Tarif Kamar',
        self::KONSUL_ODP  => 'Jasa Konsul Dokter',
        self::KONSUL_IDP  => 'Jasa Visite Dokter',
        self::PARAMEDIS => 'Jasa Paramedis',
        self::RADIOLOGI  => 'Radiologi',
        self::TINDAKAN  => 'Tindakan',
    ];

    /**
     * @return string
     */
    public function getSubtotalAttribute()
    {
        return $this->unit_price * $this->unit;
    }
}

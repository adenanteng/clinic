<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pharmacy extends Model
{
    use HasFactory;

    public $table = 'pharmacies';

    public $fillable = [
        'drug_unique_id',
        'category',
        'name',
        'brand',
        'unit',
    ];

    const PHARMACY = 1;
    const GENERAL = 2;
    const DEPT_TYPE = [
        self::PHARMACY => 'Farmasi',
        self::GENERAL  => 'Umum',
    ];

    const TABLET = 1;
    const KAPSUL = 2;
    const PIL = 3;
    const UNIT_TYPE =  [
        self::TABLET => 'Tablet',
        self::KAPSUL    => 'Kapsul',
        self::PIL => 'Pil',
    ];

    const ALKES = 1;
    const OBAT = 2;
    const BHP = 3;
    const INJEKSI = 4;
    const DRUG_CATEGORY =  [
        self::ALKES => 'Alkes',
        self::OBAT    => 'Obat',
        self::BHP => 'BHP',
        self::INJEKSI => 'Injeksi',
    ];

    const TOKO_ABADI = 1;
    const ABANG_TANGGUH = 2;
    const HARAPAN_JAYA = 3;
    const SUPPLIER_TYPE = [
        self::TOKO_ABADI => 'Toko Abadi',
        self::ABANG_TANGGUH    => 'Abang Tangguh',
        self::HARAPAN_JAYA => 'Harapan Jaya',
    ];

    const DIBUAT = 1;
    const DIMINTA = 2;
    const DIKERJAKAN = 3;
    const SELESAI = 4;
    const DITERIMA = 5;
    const PRESCRIPTION_STATUS = [
        self::DIBUAT => 'Dibuat',
        self::DIMINTA => 'Diminta',
        self::DIKERJAKAN => 'Sedang dikerjakan',
        self::SELESAI => 'Selesai',
        self::DITERIMA => 'Telah diterima pasien',
    ];

    /**
     *
     * @return HasMany
     */
    public function procurements()
    {
        return $this->hasMany(PharmacyProcurement::class, 'drug_id');
    }
}

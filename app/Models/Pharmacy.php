<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pharmacy extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $table = 'pharmacies';

    public $fillable = [
        'dept_id',
        'category_id',
        'name',
        'unit_id',
    ];

    const ALL = 0;
    const PHARMACY = 1;
    const GENERAL = 2;
    const DEPT_TYPE = [
        self::ALL => 'Semua',
        self::PHARMACY => 'Farmasi',
        self::GENERAL  => 'Umum',
    ];

    const TABLET = 1;
    const KAPSUL = 2;
    const PIL = 3;
    const VIAL = 4;
    const UNIT_TYPE =  [
        self::TABLET => 'Tablet',
        self::KAPSUL    => 'Kapsul',
        self::PIL => 'Pil',
        self::VIAL => 'Vial',
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

    const ICON = 'icon';

    protected $appends = ['icon', 'stock','unit_text','category_text','total_procurement','price','price_bpjs'];

    /**
     *
     * @return HasMany
     */
    public function procurements()
    {
        return $this->hasMany(PharmacyProcurement::class, 'drug_id');
    }

    /**
     * @return string
     */
    public function getTotalProcurementAttribute(): string
    {
        return PharmacyProcurement::where('drug_id', $this->id)->count();
    }

    /**
     * @return string
     */
    public function getStockAttribute(): string
    {
        return PharmacyProcurement::where('drug_id', $this->id)->where('remaining', '>', 0)->sum('remaining');
    }

    /**
     * @return string|null
     */
    public function getPriceAttribute(): ?string
    {
        if ($this->total_procurement > 0) {
            return PharmacyProcurement::where('drug_id', $this->id)->where('remaining', '>', 0)->first()->selling_price;
        }else{
            return null;
        }
    }

    /**
     * @return string|null
     */
    public function getPriceBpjsAttribute(): ?string
    {
        if ($this->total_procurement > 0) {
            return PharmacyProcurement::where('drug_id', $this->id)->where('remaining', '>', 0)->first()->selling_price_bpjs;
        }else{
            return null;
        }
    }

    /**
     * @return string
     */
    public function getUnitTextAttribute(): string
    {
        return Pharmacy::UNIT_TYPE[$this->unit];
    }

    /**
     * @return string
     */
    public function getCategoryTextAttribute(): string
    {
        return Pharmacy::DRUG_CATEGORY[$this->unit];
    }

    /**
     * @return string
     */
    public function getIconAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::ICON)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('web/media/hospital/pharmacy.png');
    }
}

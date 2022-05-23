<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PharmacyProcurement extends Model
{
    use HasFactory;

    public $table = 'pharmacy_procurements';

    public $fillable = [
        'dept_id',
        'drug_id',
        'supplier_id',
        'expired_date',
        'amount',
        'remaining',
        'lifetime',
        'invoice_no',
        'purchase_price',
        'selling_price,'
    ];

    /**
     * @return BelongsTo
     */
    public function pharmacys()
    {
        return $this->belongsTo(Pharmacy::class, 'drug_id');
    }
}

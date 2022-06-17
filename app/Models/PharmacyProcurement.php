<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Stephenjude\Wallet\Traits\HasWallet;

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
        'selling_price',
        'selling_price_bpjs',
    ];

    /**
     * @return BelongsTo
     */
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, 'drug_id');
    }
}

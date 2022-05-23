<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PatientPayment
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $payment_gateway
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment wherePatientPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment wherePatientPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientPayment whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class PatientPayment extends Model
{
    use HasFactory;

    protected $table = 'patient_payments';

    protected $fillable =[
        'patient_id',
        'payment_gateway_id',
        'payment_card',
    ];

    /**
     * @return BelongsTo
     */
    public function payment_gateways()
    {
        return $this->belongsTo(PaymentGateway::class, 'payment_gateway_id');
    }
}

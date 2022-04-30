<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentCategory
 *
 * @property int $id
 * @property int $payment_gateway_id
 * @property string $payment_gateway
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory wherePaymentCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory wherePaymentCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class PaymentCategory extends Model
{
    use HasFactory;

    protected $table = 'payment_categories';

    protected $fillable =[
        'payment_category_id',
        'payment_category',
    ];
}

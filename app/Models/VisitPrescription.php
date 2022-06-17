<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VisitPrescription
 *
 * @property int $id
 * @property int $visit_id
 * @property string $prescription_name
 * @property string $frequency
 * @property string $duration
 * @property mixed $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription wherePrescriptionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitPrescription whereVisitId($value)
 * @mixin \Eloquent
 */
class VisitPrescription extends Model
{
    use HasFactory;

    protected $table = 'visit_prescriptions';

    protected $appends = ['date', 'status_name', 'total_unit'];

    public $fillable = [
        'visit_id',
//        'group_id',
        'drug_id',
        'procurement_id',
        'frequency',
        'duration',
        'description',
        'status',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'prescription_name' => 'required|max:121',
        'frequency'         => 'required',
        'duration'          => 'required',
    ];

    /**
     * @return string
     */
    public function getDateAttribute()
    {
        $date = Carbon::parse($this->created_at)->locale('id');

        $date->settings(['formatFunction' => 'translatedFormat']);

        return $date->format('l, j F Y ; h:i a'); // Selasa, 16 Maret 2021 ; 08:27 pagi

//        return date('d M', strtotime($this->created_at));
    }

    /**
     * @return string
     */
    public function getStatusNameAttribute()
    {
        return Pharmacy::PRESCRIPTION_STATUS[$this->status];
    }

    /**
     * @return int
     */
    public function getTotalUnitAttribute()
    {
        return $this->frequency * $this->duration;
    }

    /**
     * @return BelongsTo
     */
    public function pharmacys()
    {
        return $this->belongsTo(Pharmacy::class, 'drug_id');
    }

    /**
     *
     * @return BelongsTo
     */
    public function procurement()
    {
        return $this->belongsTo(PharmacyProcurement::class, 'procurement_id');
    }

    /**
     *
     * @return BelongsTo
     */
    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}

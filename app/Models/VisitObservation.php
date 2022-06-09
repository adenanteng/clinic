<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VisitObservation
 *
 * @property int $id
 * @property string $observation_name
 * @property int $visit_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereObservationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitObservation whereVisitId($value)
 * @mixin \Eloquent
 */
class VisitObservation extends Model
{
    use HasFactory;

    public $table = 'visit_observations';

    public $fillable = [
        'observation_name',
        'visit_id',
        'symptoms',
        'anamnesis',
        'prognosis',
        'temperature',
        'awareness',
        'height',
        'weight',
        'systole',
        'diastole',
        'respiratory_rate',
        'heart_rate',
        'assessment',
        'plan',
        'create_user_id',
        'update_user_id',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'observation_name' => 'string',
        'visit_id'         => 'integer',
    ];

    const DPJP = 1;
    const PPJA = 2;
    const CPPT = 3;
    const OBSERVATION_TYPE = [
        self::DPJP  => 'DPJP',
        self::PPJA  => 'PPJA',
        self::CPPT  => 'CCPT',
    ];

    const DPJP_RAPT = 1;
    const DPJP_TYPE = [
        self::DPJP_RAPT  => 'RAPT',
    ];

    const PPJA_IGD = 1;
    const PPJA_RJALAN = 2;
    const PPJA_ANAK = 3;
    const PPJA_JIWA = 4;
    const PPJA_MATERNITAS = 5;
    const PPJA_TYPE = [
        self::PPJA_IGD  => 'Pengkajian IGD',
        self::PPJA_RJALAN  => 'Pengkajian Rawat Jalan',
        self::PPJA_ANAK  => 'Keperawatan Anak',
        self::PPJA_JIWA  => 'Keperawatan Jiwa',
        self::PPJA_MATERNITAS  => 'Pengkajian Awal Maternitas',
    ];

    /**
     * @return string
     */
    public function getCreateUserAttribute()
    {
        $a = User::whereId($this->create_user_id)->pluck('first_name')[0];
        $b = User::whereId($this->create_user_id)->pluck('last_name')[0];
        return $a.' '.$b;
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

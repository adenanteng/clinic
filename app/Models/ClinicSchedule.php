<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClinicSchedule
 *
 * @property int $id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClinicSchedule whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClinicSchedule extends Model
{
    use HasFactory;

     protected $table = 'clinic_schedules';

    const Mon = 1;
    const Tue = 2;
    const Wed = 3;
    const Thu = 4;
    const Fri = 5;
    const Sat = 6;
    const Sun = 0;

    const WEEKDAY = [
        self::Mon => 'SEN',
        self::Tue => 'SEL',
        self::Wed => 'RAB',
        self::Thu => 'KAM',
        self::Fri => 'JUM',
        self::Sat => 'SAB',
        self::Sun => 'MIN',
    ];

    const WEEKDAY_FULL_NAME = [
        self::Mon => 'Senin',
        self::Tue => 'Selasa',
        self::Wed => 'Rabu',
        self::Thu => 'Kamis',
        self::Fri => 'Jumat',
        self::Sat => 'Sabtu',
        self::Sun => 'Minggu',
    ];

    public $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
    ];
}

<?php

namespace App\Models;

use Database\Factories\PatientFactory;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class Patient
 *
 * @package App\Models
 * @version July 29, 2021, 11:37 am UTC
 * @property int $id
 * @property string $patient_unique_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static PatientFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient newQuery()
 * @method static Builder|Patient onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient wherePatientUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient whereUserId($value)
 * @method static Builder|Patient withTrashed()
 * @method static Builder|Patient withoutTrashed()
 * @mixin Model
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read string $profile
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Patient permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Patient role($roles, $guard = null)
 */
class Patient extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasRoles;

    protected $table = 'patients';

    const PROFILE = 'profile';

    const A = 1;
    const B = 2;
    const AB = 3;
    const O = 4;
    const BLOOD_GROUP_ARRAY = [
        self::A  => 'A',
        self::B  => 'B',
        self::AB  => 'AB',
        self::O => 'O',
    ];

    const KTP = 1;
    const KTA = 2;
    const NIP = 4;
    const PELAJAR = 3;
    const NRIC_GROUP_ARRAY = [
        self::KTP  => 'KTP',
        self::KTA  => 'KTA',
        self::NIP  => 'NIP',
        self::PELAJAR  => 'Kartu Pelajar / Mahasiswa',
    ];

    const MALE = 1;
    const FEMALE = 2;
    const GENDER_GROUP_ARRAY = [
        self::MALE  => 'Laki-laki',
        self::FEMALE  => 'Perempuan',
    ];

    const SINGLE = 1;
    const MARRIED = 2;
    const DIVORCES = 3;
    const MARRIED_GROUP_ARRAY = [
        self::SINGLE  => 'Belum Menikah',
        self::MARRIED  => 'Menikah',
        self::DIVORCES  => 'Cerai',
    ];

    const ISLAM = 1;
    const KRISTEN = 2;
    const KATOLIK = 3;
    const BUDHA = 4;
    const HINDU = 5;
    const KONGHUCU = 6;
    const RELIGION_GROUP_ARRAY = [
        self::ISLAM  => 'Islam',
        self::KRISTEN  => 'Kristen',
        self::KATOLIK  => 'Katolik',
        self::BUDHA => 'Budha',
        self::HINDU  => 'Hindu',
        self::KONGHUCU  => 'Konghucu',
    ];

    public $fillable = [
//        'patient_unique_id',
        'user_id',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'patient_unique_id' => 'required|unique:patients,patient_unique_id|regex:/^\S*$/u',
        'first_name'        => 'nullable',
        'last_name'         => 'nullable',
        'email'             => 'nullable|email|unique:users,email',
        'contact'           => 'nullable|unique:users,contact',
//        'password'          => 'required|same:password_confirmation|min:6',
        'postal_code'       => 'nullable',
        'profile'           => 'nullable|mimes:jpeg,jpg,png|max:2000',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $editRules = [
        'first_name' => 'nullable',
        'last_name'  => 'nullable',
        'profile'    => 'nullable|mimes:jpeg,jpg,png',
        'email'      => 'nullable|email|unique:users,email',
    ];

    protected $appends = ['profile', 'patient_unique_id', 'payment_name'];

    protected $with = ['media', 'address'];

    /**
     * @return string
     */
    public function getPatientUniqueIdAttribute()
    {
        return str_pad($this->id, 6, "0", STR_PAD_LEFT);
    }

    /**
     * @return string
     */
    public function getPaymentNameAttribute()
    {
        return PatientPayment::with('gateway')->where('patient_id', $this->id)->get()->pluck('gateway.payment_name');
//        return 'BPJS';
    }

    /**
     * @return string
     */
    public static function generatePatientUniqueId()
    {
        for ($i=1; $i<=999999; $i++) {
            $patientUniqueId = str_pad($i, 6, "0", STR_PAD_LEFT);
            $isExist = self::wherePatientUniqueId($patientUniqueId)->exists();

            if (!$isExist) {
                return $patientUniqueId;
            }
        }
//        while (true) {
//            $isExist = self::wherePatientUniqueId($patientUniqueId)->exists();
//            if ($isExist) {
//                self::generatePatientUniqueId();
//            }
//            break;
//        }
        return $patientUniqueId;
    }

    /**
     * @return string
     */
    public function getProfileAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
        $gender = $this->user->gender;
        if ($gender == self::FEMALE){

            return asset('web/media/avatars/woman_child.png');
        }

        return asset('web/media/avatars/man_child.png');
    }

    /**
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'owner');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function payment()
    {
        return $this->hasMany(PatientPayment::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

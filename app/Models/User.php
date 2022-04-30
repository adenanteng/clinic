<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Lab404\Impersonate\Models\Impersonate;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $contact
 * @property string|null $dob
 * @property int $gender
 * @property int $status
 * @property string|null $language
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Address|null $address
 * @property-read Doctor|null $doctor
 * @property-read string $full_name
 * @property-read string $profile_image
 * @property-read MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[]
 *     $notifications
 * @property-read int|null $notifications_count
 * @property-read Patient|null $patient
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereContact($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDob($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLanguage($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int|null $type
 * @property string|null $blood_group
 * @property-read mixed $role_name
 * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Collection|Qualification[] $qualifications
 * @property-read int|null $qualifications_count
 * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles, $guard = null)
 * @method static Builder|User whereBloodGroup($value)
 * @method static Builder|User whereType($value)
 * @property-read \App\Models\Staff|null $staff
 * @property string|null $region_code
 * @method static Builder|User whereRegionCode($value)
 */
class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia, HasRoles, Impersonate;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'dob',
        'gender',
        'status',
        'password',
        'language',
        'blood_group',
        'type',
        'region_code',
        'email_verified_at',
        'email_notification',
        'time_zone',
        'dark_mode',
        'nric_type',
        'nric_id',
        'gender',
        'marriage',
        'religion',
        'profession',
    ];

    const LANGUAGES = [
        'id' => 'Indonesian',
        'en' => 'English',
    ];

    const LANGUAGES_IMAGE = [
        'en' => 'web/media/flags/united-states.svg',
        'id' => 'web/media/flags/iraq.svg',
    ];

    const PROFILE = 'profile';
    const ADMIN = 1;
    const DOCTOR = 2;
    const PATIENT = 3;
    const STAFF = 4;
    const TYPE = [
        self::ADMIN   => 'Admin',
        self::DOCTOR  => 'Doctor',
        self::PATIENT => 'Patient',
        self::STAFF   => 'Staff',
    ];
    const ALL = 2;
    const ACTIVE = 1;
    const DEACTIVE = 0;
    const STATUS = [
        self::ALL      => 'All',
        self::ACTIVE   => 'Active',
        self::DEACTIVE => 'Deactive',
    ];

    const TIME_ZONE_ARRAY = [
        'Asia/Jakarta',
        'Asia/Jayapura',
        'Asia/Pontianak',
    ];

    protected $with = ['media'];

    protected $appends = ['full_name', 'profile_image', 'role_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    const MALE = 1;
    const FEMALE = 2;
    const GENDER = [
        self::MALE   => 'Laki-laki',
        self::FEMALE => 'Perempuan',
    ];

    public static $rules = [
//        'first_name'      => 'required',
//        'last_name'       => 'required',
        'email'           => 'nullable|email|unique:users,email',
        'contact'         => 'nullable|unique:users,contact',
        'password'        => 'required|same:password_confirmation|min:6',
        'dob'             => 'nullable|date',
        'experience'      => 'nullable|numeric',
        'specializations' => 'nullable',
        'gender'          => 'required',
        'status'          => 'nullable',
        'postal_code'     => 'nullable',
        'profile'         => 'nullable|mimes:jpeg,png,jpg|max:2000',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getProfileImageAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
        $gender = $this->gender;
        if ($gender == self::FEMALE){

            return asset('web/media/avatars/female.png');
        }

        return asset('web/media/avatars/male.png');
    }

    /**
     * @return string
     */
    public function getRoleNameAttribute()
    {
        $role = $this->roles()->first();

        if (! empty($role)) {
            return $role->display_name;
        }
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * @return string
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->dob)->age;
    }

    /**
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'owner');
    }

    /**
     * @return HasOne
     */
    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id');
    }

    /**
     *
     *
     * @return HasMany
     */
    public function qualifications()
    {
        return $this->hasMany(Qualification::class, 'user_id');
    }

    /**
     *
     * @return HasOne
     */
    public function patient()
    {
        return $this->hasOne(Patient::class, 'user_id');
    }

    /**
     * @return HasOne
     */
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function gCredentials(): HasOne
    {
        return $this->hasOne(GoogleCalendarIntegration::class, 'user_id');
    }
}

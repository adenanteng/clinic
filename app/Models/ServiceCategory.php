<?php

namespace App\Models;

use Database\Factories\ServiceCategoryFactory;
use Eloquent as Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * Class ServiceCategory
 *
 * @package App\Models
 * @version August 2, 2021, 7:11 am UTC
 * @property string $name
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static ServiceCategoryFactory factory(...$parameters)
 * @method static Builder|ServiceCategory newModelQuery()
 * @method static Builder|ServiceCategory newQuery()
 * @method static Builder|ServiceCategory query()
 * @method static Builder|ServiceCategory whereCreatedAt($value)
 * @method static Builder|ServiceCategory whereId($value)
 * @method static Builder|ServiceCategory whereName($value)
 * @method static Builder|ServiceCategory whereUpdatedAt($value)
 * @mixin Model
 */
class ServiceCategory extends Model
{
    use HasFactory;

    protected $table = 'service_categories';

    public $fillable = [
        'name',
        'slug',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:service_categories,name',
    ];

    public function services(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Service::class,'category_id');
    }
    public function activatedServices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Service::class,'category_id')->where('status',Service::ACTIVE);
    }

}

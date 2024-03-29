<?php

namespace App\Repositories;

use App\Models\ServiceCategory;
use App\Models\TreatmentCategory;
use App\Repositories\BaseRepository;

/**
 * Class ServiceCategoryRepository
 * @package App\Repositories
 * @version August 2, 2021, 7:11 am UTC
 */
class TreatmentCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TreatmentCategory::class;
    }
}

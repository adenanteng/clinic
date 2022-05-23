<?php

namespace App\Repositories;

use App\Models\VisitBilling;
use App\Repositories\BaseRepository;

/**
 * Class VisitBillingRepository
 * @package App\Repositories
 * @version May 7, 2022, 6:43 pm WIB
*/

class VisitBillingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
      'visit_id',
      'type',
      'name',
      'unit_price',
      'unit',
      'subtotal',
      'status'
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
        return VisitBilling::class;
    }


}

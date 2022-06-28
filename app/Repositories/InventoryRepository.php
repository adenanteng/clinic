<?php

namespace App\Repositories;

use App\Http\Controllers\AppBaseController;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\Service;
use App\Models\Treatment;
use App\Models\TreatmentCategory;
use DB;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServicesRepository
 * @package App\Repositories
 * @version August 2, 2021, 12:09 pm UTC
 */
class InventoryRepository extends AppBaseController
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

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
        return Pharmacy::class;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function store(array $input): bool
    {
        try {
            DB::beginTransaction();

            Pharmacy::create($input);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     * @param $treatment
     * @return bool
     */
    public function update($input, $treatment): bool
    {
        try {
            DB::beginTransaction();
            $input['charges'] = str_replace(',', '', $input['charges']);
            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $treatment->update($input);

            if (isset($input['icon']) && ! empty('icon')) {
                $treatment->clearMediaCollection(Service::ICON);
                $treatment->media()->delete();
                $treatment->addMedia($input['icon'])->toMediaCollection(Service::ICON, config('app.media_disc'));
            }

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function prepareData()
    {
        $data['dept_type'] = Pharmacy::DEPT_TYPE;
        $data['drug_category'] = Pharmacy::DRUG_CATEGORY;
        $data['unit'] = Pharmacy::UNIT_TYPE;
        return $data;
    }
}

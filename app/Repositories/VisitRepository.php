<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\Role;
use App\Models\User;
use App\Models\Visit;
use App\Models\Patient;
use App\Models\VisitPrescription;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class EncounterRepository
 * @package App\Repositories
 * @version September 3, 2021, 7:09 am UTC
 */
class VisitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'visit_date',
        'doctor',
        'patient',
        'description',
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
        return Visit::class;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data['doctors'] = Doctor::with('user')->get()->where('user.status', true)->pluck('user.full_name', 'id');
        $data['patients'] = Patient::with('user')->get()->pluck('user.full_name', 'id');

        return $data;
    }

    /**
     * @param  array  $input
     * @param  int  $encounter
     *
     * @return bool
     */
    public function update($input, $encounter)
    {
        $encounter->update($input);

        return true;
    }

    /**
     * @param $id
     *
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function getShowData($id)
    {
        return Visit::with([
            'visitDoctor.user', 'visitPatient.user', 'problems', 'observations', 'notes', 'prescriptions.pharmacys.procurements',
        ])->where('appointment_id', $id);
    }

    /**
     * @return array
     */
    public function getSoapData()
    {
        $soap['prognosis'] = Visit::PROGNOSIS;
        $soap['awareness'] = Visit::AWARENESS;
        $soap['staff'] = User::where('type', User::DOCTOR)->orWhere('type', User::STAFF)->get()->pluck('full_name', 'id');

        return $soap;
    }

    /**
     * @return array
     */
    public function getPrescriptionData()
    {
        $prescription['drug'] = Pharmacy::all()->pluck('name', 'id');

        return $prescription;
    }
}



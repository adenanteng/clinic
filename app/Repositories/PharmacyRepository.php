<?php

namespace App\Repositories;

use App\Events\CreateGoogleAppointment;
use App\Http\Controllers\GoogleCalendarController;
use App\Mail\AppointmentBookedMail;
use App\Mail\DoctorAppointmentBookMail;
use App\Mail\PatientAppointmentBookMail;
use App\Models\Appointment;
use App\Models\AppointmentGoogleCalendar;
use App\Models\Doctor;
use App\Models\GoogleCalendarIntegration;
use App\Models\GoogleCalendarList;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Pharmacy;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Specialization;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserGoogleAppointment;
use App\Models\Visit;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class AppointmentRepository
 * @package App\Repositories
 * @version August 3, 2021, 10:37 am UTC
 */
class PharmacyRepository extends BaseRepository
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

            $input['status'] = (isset($input['status'])) ? 1 : 0;
            $services = Service::create($input);
            if (isset($input['doctors']) && !empty($input['doctors'])) {
                $services->serviceDoctors()->sync($input['doctors']);
            }
            if (isset($input['icon']) && !empty('icon')) {
                $services->addMedia($input['icon'])->toMediaCollection(Service::ICON, config('app.media_disc'));
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
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
    public function getPrescriptionData()
    {
        $prescription['drug'] = Pharmacy::all()->pluck('name', 'id');

        return $prescription;
    }

    /**
     * @return array
     */
    public function prepareData()
    {
        $data['serviceCategories'] = ServiceCategory::orderBy('name', 'ASC')->pluck('name', 'id');
        $data['doctors'] = Doctor::with('user')->get()->where('user.status', true)->pluck('user.full_name', 'id');

        return $data;
    }
}

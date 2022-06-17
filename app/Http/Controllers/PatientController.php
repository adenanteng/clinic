<?php

namespace App\Http\Controllers;

use App\DataTables\PatientDataTable;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Transaction;
use App\Models\Visit;
use App\Repositories\PatientRepository;
use Carbon\Carbon;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\Facades\DataTables;

class PatientController extends AppBaseController
{
    /** @var  PatientRepository */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    /**
     * Display a listing of the Patient.
     *
     * @param  Request  $request
     * @throws Exception
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PatientDataTable())->get())->make(true);
        }

        return view('patients.index');
    }

    /**
     * Show the form for creating a new Patient.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = $this->patientRepository->getData();

//        dd($data);
        return view('patients.create', compact('data'));
    }

    /**
     * Show the form for editing the specified Patient.
     *
     * @param  Patient  $patient
     * @return Application|Factory|View
     */
    public function edit(Patient $patient)
    {
        if (empty($patient)) {
            Flash::error('Patient not found.');

            return redirect(route('patients.index'));
        }
        $data = $this->patientRepository->getData();
//        unset($data['patientUniqueId']);

        return view('patients.edit', compact('data', 'patient'));
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param  CreatePatientRequest  $request
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function store(CreatePatientRequest $request)
    {
        $input = $request->all();

        $patient = $this->patientRepository->store($input);

        Flash::success('Patient created successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * Update the specified Patient in storage.
     *
     * @param  Patient $patient
     * @param  UpdatePatientRequest  $request
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Patient $patient, UpdatePatientRequest $request)
    {
        $input = request()->except(['_method', '_token','patient_unique_id']);

        if (empty($patient)) {
            Flash::error('Patient not found.');

            return redirect(route('patients.index'));
        }

        $patient = $this->patientRepository->update($input, $patient);

        Flash::success('Patient updated successfully.');

        return redirect(route('patients.index'));
    }


    /**
     * Display the specified Patient.
     *
     * @param $request
     *
     * @return Application|Factory|View
     */
    public function show($request)
    {

//        if (getLogInUser()->hasRole('doctor')) {
//            $doctor = Appointment::wherePatientId($patient->id)->whereDoctorId(getLogInUser()->doctor->id);
//            if (! $doctor->exists()) {
//                return redirect()->back();
//            }
//        }
//
//        if (empty($patient)) {
//            Flash::error('Patient not found.');
//
//            return redirect(route('patients.index'));
//        }

        $patient = $this->patientRepository->getPatientData($request);
        $appointmentStatus = Appointment::ALL_STATUS;
        $todayDate = Carbon::now()->format('Y-m-d');

        $data['todayAppointmentCount'] = Appointment::wherePatientId($patient['id'])->where('date', '=', $todayDate)->count();
        $data['upcomingAppointmentCount'] = Appointment::wherePatientId($patient['id'])->where('date', '>', $todayDate)->count();
        $data['completedAppointmentCount'] = Appointment::wherePatientId($patient['id'])->where('date', '<', $todayDate)->count();

//        dd(json_encode($data), $patient);

        return view('patients.show', compact('patient', 'appointmentStatus', 'data'));
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param  Patient  $patient
     *
     * @return JsonResponse
     */
    public function destroy(Patient $patient)
    {
        $existAppointment = Appointment::wherePatientId($patient->id)
            ->whereNotIn('status', [Appointment::CANCELLED, Appointment::CHECK_OUT])
            ->exists();
        $existVisit = Visit::wherePatientId($patient->id)->exists();

        if ($existAppointment || $existVisit) {
            return $this->sendError('Patient used somewhere else.');
        }

        $transactions = Transaction::whereUserId($patient->user_id)->get();

        try {
            DB::beginTransaction();

            foreach ($transactions as $transaction) {
                $transaction->delete();
            }

            $patient->delete();
            $patient->media()->delete();
            $patient->user()->delete();
            $patient->address()->delete();

            DB::commit();

            return $this->sendSuccess('Patient deleted successfully.');
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

    }

    /**
     * @param  Patient  $patient
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function patientAppointment(Patient $patient, Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new PatientDataTable())->getAppointment($request->only([
                'status', 'patientId', 'filter_date',
            ])))->make(true);
        }

        return redirect(route('patients.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\VisitDataTable;
use App\Http\Requests\CreateVisitPrescriptionRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Visit;
use App\Models\VisitBilling;
use App\Models\VisitNote;
use App\Models\VisitObservation;
use App\Models\VisitPrescription;
use App\Models\VisitProblem;
use App\Repositories\VisitBillingRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use App\Repositories\VisitRepository;
use Flash;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Comment\Doc;
use Response;
use Datatables;

class VisitController extends AppBaseController
{
    /** @var  VisitRepository */
    private $visitRepository;

    public function __construct(VisitRepository $visitRepo)
    {
        $this->visitRepository = $visitRepo;
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new VisitDataTable())->get())->make(true);
        }

        return view('visits.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = $this->visitRepository->getData();

        return view('visits.create', compact('data'));
    }

    /**
     * @param  CreateVisitRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateVisitRequest $request)
    {
        $input = $request->all();
        $this->visitRepository->create($input);

        Flash::success('Visit created successfully.');

        if (getLoginUser()->hasRole('doctor')) {
            return redirect(route('doctors.visits.index'));
        }

        return redirect(route('visits.index'));
    }

    /**
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        if (empty(Appointment::where('appointment_unique_id', $id)->first())) {
            abort(404);  //404 page
        }

        if (empty(Visit::where('appointment_id', $id)->first())) {
            $appointment = Appointment::where('appointment_unique_id', $id)->first()->toArray();
            $appointment['appointment_id'] = $appointment['appointment_unique_id'];
//            $appointment['date'] = Carbon::now();
//            dd($id);
            $this->visitRepository->create($appointment);
            $status = Appointment::where('appointment_unique_id', $id)->update(['status' => 2]);

//            VisitBillingRepository::create($appointment);
            Flash::success('Visit created successfully.');
        }


        $visit = $this->visitRepository->getShowData($id)->first();
        $observation = $this->visitRepository->getSoapData();
        $prescription = $this->visitRepository->getPrescriptionData();

//        dd($visit, $observation, $prescription);
        return view('visits.show', compact('visit', 'observation', 'prescription'));
    }

    /**
     * @param  Visit  $visit
     *
     * @return Application|Factory|View
     */
    public function edit(Visit $visit)
    {
        if (getLogInUser()->hasRole('doctor')) {
            $doctor = Visit::whereId($visit->id)->whereDoctorId(getLogInUser()->doctor->id);
            if (! $doctor->exists()) {
                return redirect(route('doctors.visits.index'));
            }
        }

        $data = $this->visitRepository->getData();

        return view('visits.edit', compact('data', 'visit'));
    }

    /**
     * @param  Visit  $visit
     * @param  UpdateVisitRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Visit $visit, UpdateVisitRequest $request)
    {
        $input = $request->all();
        $visit->update($input);

        Flash::success('Visit updated successfully.');

        if (getLoginUser()->hasRole('doctor')) {
            return redirect(route('doctors.visits.index'));
        }

        return redirect(route('visits.index'));
    }

    /**
     * @param  Visit  $visit
     *
     * @return mixed
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();

        return $this->sendSuccess('Visit deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function addProblem(Request $request)
    {
        $input = $request->all();
        $problem = VisitProblem::create(['problem_name' => $input['problem_name'], 'visit_id' => $input['visit_id']]);
        $problemData = VisitProblem::whereVisitId($input['visit_id'])->get();

        return $this->sendResponse($problemData, 'Problem added successfully.');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteProblem($id)
    {
        $problem = VisitProblem::findOrFail($id);
        $visitId = $problem->visit_id;
        $problem->delete();
        $problemData = VisitProblem::whereVisitId($visitId)->get();

        return $this->sendResponse($problemData, 'Problem deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function addObservation(Request $request)
    {
        $input = $request->all();
        $name = VisitObservation::where('visit_id', $input['visit_id'])->count();
        $name +=1;
        $input['observation_name'] = $input['observation_name'] . ' ' . $name;

        $observation = VisitObservation::create([
            'visit_id'          => $input['visit_id'],
            'observation_name'  => $input['observation_name'],
            'symptoms'          => $input['symptoms'],
            'anamnesis'         => $input['anamnesis'],
            'prognosis'         => $input['prognosis'],
            'temperature'       => $input['temperature'],
            'awareness'         => $input['awareness'],
            'height'            => $input['height'],
            'weight'            => $input['weight'],
            'systole'           => $input['systole'],
            'diastole'          => $input['diastole'],
            'respiratory_rate'  => $input['respiratory_rate'],
            'heart_rate'        => $input['heart_rate'],
            'plan'              => $input['plan'],
            'assessment'        => $input['assessment'],
            'create_user_id'    => $input['staff_id'],
            'update_user_id'    => $input['staff_id'],

        ]);
        $observationData = VisitObservation::whereVisitId($input['visit_id'])->get();

        return $this->sendResponse($observationData, 'Observation added successfully.');
//        return redirect()->route('visits.show');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteObservation($id)
    {
        $observation = VisitObservation::findOrFail($id);
        $visitId = $observation->visit_id;
        $observation->delete();
        $observationData = VisitObservation::whereVisitId($visitId)->get();

        return $this->sendResponse($observationData, 'Observation deleted successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     */
    public function addNote(Request $request)
    {
        $input = $request->all();
        $note = VisitNote::create(['note_name' => $input['note_name'], 'visit_id' => $input['visit_id']]);
        $noteData = VisitNote::whereVisitId($input['visit_id'])->get();

        return $this->sendResponse($noteData, 'Note added successfully.');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteNote($id)
    {
        $note = VisitNote::findOrFail($id);
        $visitId = $note->visit_id;
        $note->delete();
        $noteData = VisitNote::whereVisitId($visitId)->get();

        return $this->sendResponse($noteData, 'Note deleted successfully.');
    }

    /**
     * @param  CreateVisitPrescriptionRequest  $request
     *
     * @return mixed
     */
    public function addPrescription(CreateVisitPrescriptionRequest $request)
    {
        $input = $request->all();
        if (! empty($input['prescription_id'])) {
            $prescription = VisitPrescription::findOrFail($input['prescription_id']);
            $prescription->update($input);
            $message = 'Visit Prescription updated successfully.';
        } else {
            VisitPrescription::create($input);
            $message = 'Visit Prescription added successfully.';
        }

        $visitPrescriptions = VisitPrescription::whereVisitId($input['visit_id'])->with('pharmacys')->get();

        return $this->sendResponse($visitPrescriptions, $message);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function editPrescription($id)
    {
        $prescription = VisitPrescription::findOrFail($id);

        return $this->sendResponse($prescription, 'Prescription retrieved successfully.');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deletePrescription($id)
    {
        $prescription = VisitPrescription::findOrFail($id);
        $visitId = $prescription->visit_id;
        $prescription->delete();
        $prescriptionData = VisitPrescription::whereVisitId($visitId)->get();

        return $this->sendResponse($prescriptionData, 'Prescription deleted successfully.');
    }
}

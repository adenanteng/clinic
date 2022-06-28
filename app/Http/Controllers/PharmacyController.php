<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentDataTable;
use App\DataTables\PharmacyDataTable;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Appointment;
use App\Models\Pharmacy;
use App\Models\PharmacyProcurement;
use App\Models\Visit;
use App\Models\VisitPrescription;
use App\Repositories\PharmacyRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class PharmacyController extends AppBaseController
{
    /** @var  PharmacyRepository */
    private $pharmacyRepository;

    public function __construct(PharmacyRepository $pharmacyRepo)
    {
        $this->pharmacyRepository = $pharmacyRepo;
    }

    /**
     * @param  Request  $request
     *
     * @throws Exception
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new PharmacyDataTable())->get())->make(true);
        }
        $appointmentStatus = Appointment::ALL_STATUS;
        $paymentStatus = getAllPaymentStatus();
        $paymentGateway = getPaymentGateway();

        return view('pharmacies.index', compact('appointmentStatus', 'paymentStatus', 'paymentGateway'));
    }

    /**
     * Show the form for creating a new Services.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = $this->pharmacyRepository->prepareData();

        return view('pharmacies.create', compact('data'));
    }

    /**
     * Store a newly created Services in storage.
     *
     * @param  Request  $request
     *
     * @return Application|RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->pharmacyRepository->store($input);

        Flash::success('Service created successfully.');

        return redirect(route('pharmacies.index'));
    }

    /**
     * Show the form for editing the specified Services.
     *
     * @param  Request  $service
     * @return Application|Factory|View
     */
    public function edit(Request $service)
    {
        $data = $this->pharmacyRepository->prepareData();
        $selectedDoctor = $service->serviceDoctors()->pluck('doctor_id')->toArray();

        return view('pharmacies.edit', compact('service', 'data', 'selectedDoctor'));
    }

    /**
     * Update the specified Services in storage.
     *
     * @param  Request  $request
     * @param  Request  $service
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Request $service)
    {
        $this->pharmacyRepository->update($request->all(), $service);

        Flash::success('Service updated successfully.');

        return redirect(route('pharmacies.index'));
    }

    /**
     * Remove the specified Services from storage.
     *
     * @param  Request  $service
     * @return JsonResponse
     */
    public function destroy(Request $service): JsonResponse
    {
        $checkRecord = Appointment::whereServiceId($service->id)->exists();

        if ($checkRecord) {
            return $this->sendError('Service used somewhere else.');
        }
        $service->delete();

        return $this->sendSuccess('Service deleted successfully.');
    }

    /**
     * @param $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $input = Visit::where('appointment_id', $id)->get()->pluck('id');

        $visit = $this->pharmacyRepository->getShowData($id)->first();
        $prescription = $this->pharmacyRepository->getPrescriptionData();

//        dd($id);
        $upd = VisitPrescription::where('visit_id', $input)->where('status', 2)->update(['status' => 3]);


//        dd($visit, $prescription);
        return view('pharmacies.show', compact('visit', 'prescription'));
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function sendPrescription($id)
    {
        $prescription = VisitPrescription::where('visit_id', $id)->where('status', 1)->update(['status' => 2]);

        $visitPrescriptions = VisitPrescription::whereVisitId($id)->with('pharmacies')->get();

        return $this->sendResponse($visitPrescriptions, 'Prescription retrieved successfully.');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function donePrescription($id)
    {
        $prescription = VisitPrescription::where('visit_id', $id)->where('status', 3)->update(['status' => 4]);

//        $prescription = VisitPrescription::findOrFail($id);

        return $this->sendResponse($prescription, 'Prescription retrieved successfully.');
    }

}

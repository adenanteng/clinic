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
use Illuminate\Http\Request;
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

        return view('pharmacys.index', compact('appointmentStatus', 'paymentStatus', 'paymentGateway'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePharmacyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePharmacyRequest $request)
    {
        //
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
        return view('pharmacys.show', compact('visit', 'prescription'));
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function sendPrescription($id)
    {
        $prescription = VisitPrescription::where('visit_id', $id)->where('status', 1)->update(['status' => 2]);

        $visitPrescriptions = VisitPrescription::whereVisitId($id)->with('pharmacys')->get();

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Pharmacy $pharmacy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePharmacyRequest  $request
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePharmacyRequest $request, Pharmacy $pharmacy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pharmacy $pharmacy)
    {
        //
    }
}

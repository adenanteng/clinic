<?php

namespace App\Http\Controllers;

use App\DataTables\InventoryDataTable;
use App\DataTables\ServiceDataTable;
use App\DataTables\TreatmentDataTable;
use App\Models\Appointment;
use App\Models\Pharmacy;
use App\Models\Service;
use App\Models\Treatment;
use App\Repositories\InventoryRepository;
use App\Repositories\TreatmentRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateServicesRequest;
//use App\Http\Requests\UpdateServicesRequest;
use App\Repositories\ServicesRepository;
use Laracasts\Flash\Flash;
use Illuminate\Routing\Redirector;
use Yajra\DataTables\DataTables;
use function Symfony\Component\String\s;

class InventoryController extends AppBaseController
{
    /** @var  InventoryRepository */
    private $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepo)
    {
        $this->inventoryRepository = $inventoryRepo;
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View
     * @throws Exception
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new InventoryDataTable())->get($request->only('status')))->make(true);
        }
        $status = Pharmacy::DEPT_TYPE;

        return view('pharmacy_inventories.index',compact('status'));
    }

    /**
     * Show the form for creating a new Services.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = $this->inventoryRepository->prepareData();

        return view('pharmacy_inventories.create', compact('data'));
    }

    /**
     * Store a newly created Services in storage.
     *
     * @param  Request  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->inventoryRepository->store($input);

        Flash::success('Treatment created successfully.');

        return redirect(route('pharmacy_inventories.index'));
    }

    /**
     * Show the form for editing the specified Services.
     *
     * @param  Treatment $treatment
     * @return Application|Factory|View
     */
    public function edit(Treatment $treatment)
    {
        $data = $this->inventoryRepository->prepareData();
//        $selectedDoctor = $treatment->serviceDoctors()->pluck('doctor_id')->toArray();

        return view('pharmacy_inventories.edit', compact('treatment', 'data'));
    }

    /**
     * Update the specified Services in storage.
     *
     * @param  Request $request
     * @param  Treatment $treatment
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Treatment $treatment)
    {
        $this->inventoryRepository->update($request->all(), $treatment);

        Flash::success('Treatment updated successfully.');

        return redirect(route('treatments.index'));
    }

    /**
     * Remove the specified Services from storage.
     *
     * @param  Treatment  $treatment
     * @return JsonResponse
     */
    public function destroy(Treatment $treatment): JsonResponse
    {
        $checkRecord = Appointment::whereServiceId($treatment->id)->exists();

        if ($checkRecord) {
            return $this->sendError('Service used somewhere else.');
        }
        $treatment->delete();

        return $this->sendSuccess('Service deleted successfully.');
    }

    public function getService(Request $request)
    {
        $doctor_id = $request->doctorId;
        $service = Service::with('serviceDoctors')->whereHas('serviceDoctors', function ($q) use ($doctor_id) {
            $q->where('doctor_id', $doctor_id)->whereStatus(Service::ACTIVE);
        })->get();

        return $this->sendResponse($service, 'Retrieved successfully.');
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function getCharge(Request $request)
    {
        $chargeId = $request->chargeId;
        $charge = Service::find($chargeId);

        return $this->sendResponse($charge, 'Retrieved successfully.');
    }

}

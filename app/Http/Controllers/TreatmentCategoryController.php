<?php

namespace App\Http\Controllers;

use App\DataTables\TreatmentCategoryDataTable;
use App\Models\Treatment;
use App\Models\TreatmentCategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateTreatmentCategoryRequest;
//use App\Http\Requests\UpdateTreatmentCategoryRequest;
use App\Repositories\TreatmentCategoryRepository;
use Illuminate\Support\Str;
use Response;
use Yajra\DataTables\DataTables;

class TreatmentCategoryController extends AppBaseController
{
    /** @var  TreatmentCategoryRepository */
    private $treatmentCategoryRepository;

    public function __construct(TreatmentCategoryRepository $treatmentCategoryRepo)
    {
        $this->treatmentCategoryRepository = $treatmentCategoryRepo;
    }

    /**
     * Display a listing of the TreatmentCategory.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View|Response
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of((new TreatmentCategoryDataTable())->get())->make(true);
        }

        return view('treatment_categories.index');
    }

    /**
     * Store a newly created TreatmentCategory in storage.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
        $input['slug'] = Str::slug($input['name']);
        $input['status'] = 1;
//        return response()->json($input);
        $treatmentCategory = $this->treatmentCategoryRepository->create($input);
        return $this->sendResponse($treatmentCategory, 'Treatment category created successfully.');
    }

    /**
     * Show the form for editing the specified TreatmentCategory.
     *
     * @param  TreatmentCategory  $treatmentCategory
     * @return JsonResponse
     */
    public function edit(TreatmentCategory $treatmentCategory): JsonResponse
    {
        return $this->sendResponse($treatmentCategory, 'Treatment category retrieved successfully.');
    }

    /**
     * Update the specified TreatmentCategory in storage.
     *
     * @param  Request  $request
     * @param  TreatmentCategory  $treatmentCategory
     * @return JsonResponse
     */
    public function update(Request $request, TreatmentCategory $treatmentCategory): JsonResponse
    {
        $input = $request->all();
        $input['slug'] = Str::slug($input['name']);
        $this->treatmentCategoryRepository->update($input, $treatmentCategory->id);

        return $this->sendSuccess('Treatment category updated successfully.');
    }

    /**
     * Remove the specified TreatmentCategory from storage.
     *
     * @param  TreatmentCategory  $treatmentCategory
     * @return JsonResponse
     */
    public function destroy(TreatmentCategory $treatmentCategory): JsonResponse
    {
        $checkRecord = Treatment::whereCategoryId($treatmentCategory->id)->exists();

        if($checkRecord){
            return $this->sendError('Treatment category used somewhere else.');
        }
        $treatmentCategory->delete();

        return $this->sendSuccess('Treatment category deleted successfully.');
    }
}

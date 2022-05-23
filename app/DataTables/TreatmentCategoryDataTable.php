<?php

namespace App\DataTables;

use App\Models\TreatmentCategory;

/**
 * Class ServiceCategoryDataTable
 */
class TreatmentCategoryDataTable
{
    /**
     * @return TreatmentCategory
     */
    public function get()
    {
        /** @var TreatmentCategory $query */
        $query = TreatmentCategory::with('treatments')->withCount('treatments')->get();

        return $query;
    }
}

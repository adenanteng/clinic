<?php

namespace App\DataTables;

use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ServiceDataTable
 */
class TreatmentDataTable
{
    /**
     * @return Treatment
     */
    public function get($input = [])
    {
        /** @var Treatment $query */
        $query = Treatment::with('treatmentCategory');
        $query->when(isset($input['status']) && $input['status'] != Service::STATUS,
            function (Builder $q) use ($input) {
                if ($input['status'] == Service::ALL) {
                    $q->get();
                } else {
                    $q->where('status', $input['status']);
                }
            });

        return $query->get();
    }
}

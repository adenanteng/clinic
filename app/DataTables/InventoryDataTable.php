<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use App\Models\Service;
use App\Models\Treatment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ServiceDataTable
 */
class InventoryDataTable
{
    /**
     * @return Pharmacy
     */
    public function get($input = [])
    {
        /** @var Pharmacy $query */
        $query = Pharmacy::with('procurements');
        $query->when(isset($input['status']) && $input['status'] != Pharmacy::DEPT_TYPE,
            function (Builder $q) use ($input) {
                if ($input['status'] == Pharmacy::ALL) {
                    $q->get();
                } else {
                    $q->where('dept_id', $input['status']);
                }
            });

        return $query->get();
    }
}

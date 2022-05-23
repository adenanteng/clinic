<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\User;
use App\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandController extends AppBaseController
{
    /**
     * Show the application dataAjax.
     *
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = User::with('patient', 'doctor', 'address')->where('first_name','LIKE',"%$search%")
                ->orWhere('last_name','LIKE',"%$search%")
                ->get();

        }
//        dd(json_decode($data));
//        return response()->json($items);
        return $this->sendResponse(['items'=>$data], 'anjenk');
//        return response()->json(['items'=>$data]);
    }
}

<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Models\Country;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class PatientRepository
 * @package App\Repositories
 * @version July 29, 2021, 11:37 am UTC
 */
class PatientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Patient::class;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data['patientUniqueId'] = mb_strtoupper(Patient::generatePatientUniqueId());

        $data['payment'] = Appointment::PAYMENT_GATEWAY;

        $data['countries'] = Country::toBase()->pluck('name', 'id');
        $data['bloodGroupList'] = Patient::BLOOD_GROUP_ARRAY;
        $data['nricGroupList'] = Patient::NRIC_GROUP_ARRAY;
        $data['genderGroupList'] = Patient::GENDER_GROUP_ARRAY;
        $data['religionGroupList'] = Patient::RELIGION_GROUP_ARRAY;
        $data['marriageGroupList'] = Patient::MARRIED_GROUP_ARRAY;

        return $data;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            $addressInputArray = Arr::only($input, ['address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code']);

            foreach ($input['payment_gateway_id'] as $index=>$gate) {
                if ($gate == null) {
                    unset ($input['payment_gateway_id'][$index]);
                    unset ($input['payment_card'][$index]);
                }
            }
            foreach ($input['payment_card'] as $index=>$card) {
                if ($card == null) {
                    unset ($input['payment_gateway_id'][$index]);
                    unset ($input['payment_card'][$index]);
                }
            }

            $input['payment_gateway_id'][] = '1';
            $input['payment_card'][] = null;
//            $paymentInputArray = Arr::only($input, ['payment_gateway_id', 'payment_card']);
//            dd($paymentInputArray);

            $pieces = explode(" ", $input['full_name']);
            $input['first_name'] = $pieces[0];
            if (!empty($pieces[1])) {
                $input['last_name'] = $pieces[1];
            }
            unset($input['full_name']);

//            if (!empty($input['email'])) {
//                $input['email'] = setEmailLowerCase($input['email']);
//            }

            $patientArray = Arr::only($input, ['patient_unique_id']);
            $input['type'] = User::PATIENT;

            $input['password'] = Hash::make(123456);
            $user = User::create($input);

            $patient = $user->patient()->create($patientArray);
            $address = $patient->address()->create($addressInputArray);

            foreach ($input['payment_gateway_id'] as $key=>$payment) {
                $bayar['payment_gateway_id'] = $input['payment_gateway_id'][$key];
                $bayar['payment_card'] = $input['payment_card'][$key];
                $payment = $patient->payment()->create($bayar);
            }

            $user->assignRole('patient');
            if (isset($input['profile']) && ! empty($input['profile'])) {
                $patient->addMedia($input['profile'])->toMediaCollection(Patient::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @param  $patient
     *
     * @return bool
     */
    public function update($input, $patient)
    {
//        dd($input);
        try {
            DB::beginTransaction();
            $addressInputArray = Arr::only($input, ['address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code']);
            $input['type'] = User::PATIENT;

            foreach ($input['payment_gateway_id'] as $index=>$gate) {
                if ($gate == null) {
                    unset ($input['payment_gateway_id'][$index]);
                    unset ($input['payment_card'][$index]);
                }
            }
            foreach ($input['payment_card'] as $index=>$card) {
                if ($card == null) {
                    unset ($input['payment_gateway_id'][$index]);
                    unset ($input['payment_card'][$index]);
                }
            }

            $input['payment_gateway_id'][] = '1';
            $input['payment_card'][] = null;

            $pieces = explode(" ", $input['full_name']);
            $input['first_name'] = $pieces[0];
            if (!empty($pieces[1])) {
                $input['last_name'] = $pieces[1];
            }
            unset($input['full_name']);

//            if(!empty($input['email'])) {
//                $input['email'] = setEmailLowerCase($input['email']);
//            }

//            dd($input);
            /** @var Patient $patient */
            $patient->user()->update(Arr::except($input, [
                'address1', 'address2', 'city_id', 'state_id', 'country_id', 'postal_code', 'patient_unique_id',
                'avatar_remove',
                'profile',
            ]));
            $patient->address()->update($addressInputArray);

            if (isset($input['profile']) && ! empty($input['profile'])) {
                $patient->clearMediaCollection(Patient::PROFILE);
                $patient->media()->delete();
                $patient->addMedia($input['profile'])->toMediaCollection(Patient::PROFILE, config('app.media_disc'));
            }

            foreach ($input['payment_gateway_id'] as $key=>$payment) {
                $bayar['payment_gateway_id'] = $input['payment_gateway_id'][$key];
                $bayar['payment_card'] = $input['payment_card'][$key];
                $payment = $patient->payment()->create($bayar);
            }
            
            DB::commit();

            return true;
        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function getPatientData($input)
    {
        $patient = Patient::where('patient_unique_id', '=', $input)->with(['user.address', 'appointments', 'address'])->first();
//        dd(json_decode($patient));
//        $patient = Patient::with(['user.address', 'appointments', 'address'])->whereId($input)->first();

        return $patient;
    }

}

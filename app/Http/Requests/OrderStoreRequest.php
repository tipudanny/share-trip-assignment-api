<?php

namespace App\Http\Requests;

use App\Interfaces\RewardPoint;
use App\Models\RewardInPurchases;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $rewardSettingInfo = RewardInPurchases::first();
        $rewardPoint =  floor(($rewardSettingInfo['points'] * $this->price)/$rewardSettingInfo['amount']);

        $this->merge([
            'user_id' => Auth::id(),
            'point_rewarded' => $rewardPoint
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'       => 'required|integer',
            'product_id'    => 'required|integer',
            'price'         => 'required|numeric',
            'point_rewarded' => 'required|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }
}

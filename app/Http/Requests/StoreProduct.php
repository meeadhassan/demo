<?php

namespace App\Http\Requests;

use App\Constants\Request\RequestKey;
use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
        $data = $this->all();
        $data['product_name'] = request()->get('product_name');
        $data['price'] = request()->get('price');
        $data['description'] = request()->get('description');
        $this->replace($data);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            RequestKey::PRODUCT_NAME =>'required | string' ,
            RequestKey::PRICE =>'required | numeric' ,
            RequestKey::DESCRIPTION => 'required '
        ];
    }


}

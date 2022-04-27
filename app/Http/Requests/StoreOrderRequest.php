<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'table_id'       => ['required','exists:tables,id'],
            'item_id'        => ['required','exists:items,id'],
            'payment_state'  => ['required','boolean'],
            'payment_method' => ['in:card,cash,city_ledger,voucher,credit','nullable'],
            'client_id'      => ['required'],
            'status'         => ['in:pending,preparing,reserved,done,paid,canceled','required'],
            'customer'       => ['required','numeric'],
            'discount_amount'=> ['nullable','numeric'],
            'notes'          => ['nullable','string'],
            'client_name'    => ['nullable','string'],
        ];
    }
}

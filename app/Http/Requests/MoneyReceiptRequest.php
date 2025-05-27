<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MoneyReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set to true to allow authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $moneyReceiptId = $this->route('money_receipt'); // Get the current money receipt ID

        return [
            'quotation_id' => 'nullable|exists:quotations,id',
            'invoice_id' => 'nullable|exists:invoices,id',
            'source' => 'required|in:quotation,invoice',
            'receipt_date' => 'required|date',
            'receipt_number' => [
                'required',
                'string',
                Rule::unique('money_receipts', 'receipt_number')->ignore($moneyReceiptId),
            ],
            'paymenttype' => 'required|in:advance,part,finalpayment',
            'paymentmode' => 'required|in:cash,cheque,draft,netbanking,upi,digitalwallet',
            'amount' => 'required|numeric|min:0',
            'remark' => 'nullable|string|max:255',
            'status' => 'required|in:0,1',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'quotation_id.exists' => 'The selected quotation does not exist.',
            'invoice_id.exists' => 'The selected invoice does not exist.',
            'source.required' => 'The source field is required.',
            'receipt_date.required' => 'The receipt date is required.',
            'receipt_number.unique' => 'The receipt number must be unique.',
            'paymenttype.required' => 'Please specify the type of payment.',
            'paymentmode.required' => 'Please specify the mode of payment.',
            'amount.required' => 'The amount is required and must be a number.',
            'status.required' => 'Please provide the status of the receipt.',
        ];
    }
}

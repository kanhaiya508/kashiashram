<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LorryReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Determine if the request is for creating or updating
        $rules = [
            'quotation_id' => 'required|exists:quotations,id',
            'lr_no' => [
                'required',
                'max:255',
                $this->isMethod('post') // For store method
                    ? 'unique:lorry_receipts,lr_no'
                    : Rule::unique('lorry_receipts', 'lr_no')->ignore($this->lorry_receipt),
            ],
            'lr_date' => 'required|date',
            'vehicle_no' => 'nullable|max:50',
            'risk_type' => 'required|in:owner,carrier',
            'package' => 'nullable|max:255',
            'description' => 'nullable|max:500',
            'total_weight' => 'nullable|numeric|min:0',
            'package_condition' => 'nullable|max:255',
            'remark' => 'nullable|max:500',
            'freight_to_be_billed' => 'nullable',
            'freight_paid' => 'nullable',
            'freight_to_pay' => 'nullable',
            'insurance' => 'nullable|max:255',
        ];

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'quotation_id.required' => 'Quotation ID is required.',
            'quotation_id.exists' => 'The selected quotation does not exist.',
            'lr_no.required' => 'LR Number is required.',
            'lr_no.unique' => 'This LR Number already exists.',
            'lr_date.required' => 'LR Date is required.',
            'lr_date.date' => 'LR Date must be a valid date.',
            'total_weight.numeric' => 'Total weight must be a number.',
            'freight_to_pay.required' => 'Freight to Pay is required.',
            'freight_to_pay.numeric' => 'Freight to Pay must be a numeric value.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Set to true if authorization is not handled here
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->route('quotation'); // Get the ID of the quotation being updated (if any)

        return [
            'quotation_number' => 'required|string|max:255|unique:quotations,quotation_number,' . $id,
            'date' => 'required|date',
            'survey_id' => 'required|exists:surveys,id',
            'moving_type' => 'required|in:local,domestic,international,household_goods,office_shifting,vehicle_shifting,industrial_goods_shifting',
            'packing_date' => 'nullable|date|before_or_equal:delivery_date',
            'delivery_date' => 'nullable|date|after_or_equal:packing_date',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }

    /**
     * Get custom error messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'quotation_number.required' => 'The quotation number is required.',
            'quotation_number.unique' => 'The quotation number must be unique.',
            'date.required' => 'The quotation date is required.',
            'survey_id.required' => 'Please select a valid survey.',
            'survey_id.exists' => 'The selected survey does not exist.',
            'moving_type.required' => 'Please select a moving type.',
            'moving_type.in' => 'The selected moving type is invalid.',
            'packing_date.before_or_equal' => 'The packing date must be before or equal to the delivery date.',
            'delivery_date.after_or_equal' => 'The delivery date must be after or equal to the packing date.',
            'status.required' => 'The quotation status is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}

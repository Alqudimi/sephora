<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_phone' => ['required', 'string', 'max:40'],
            'customer_email' => ['nullable', 'email', 'max:190'],
            'delivery_method' => ['required', 'in:standard,same_day,click_collect'],
            'emirate' => ['required_unless:delivery_method,click_collect', 'nullable', 'string', 'max:100'],
            'area' => ['nullable', 'string', 'max:150'],
            'street_address' => ['required_unless:delivery_method,click_collect', 'nullable', 'string', 'max:400'],
            'building' => ['nullable', 'string', 'max:150'],
            'delivery_instructions' => ['nullable', 'string', 'max:500'],
            'store_id' => ['required_if:delivery_method,click_collect', 'nullable', 'string', 'max:50'],
            'payment_method' => ['required', 'in:card,apple_pay,tabby,tamara,cod'],
            'gift_message' => ['nullable', 'string', 'max:400'],
            'gift_box' => ['nullable', 'boolean'],
            'samples' => ['nullable', 'array', 'max:3'],
            'samples.*' => ['nullable', 'integer', 'exists:products,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Please enter the recipient full name.',
            'customer_phone.required' => 'Please enter a UAE mobile number.',
            'emirate.required_unless' => 'Please select your emirate.',
            'street_address.required_unless' => 'Please enter your building / street address.',
            'store_id.required_if' => 'Please choose a pick-up boutique.',
            'payment_method.required' => 'Please choose a payment method.',
        ];
    }
}

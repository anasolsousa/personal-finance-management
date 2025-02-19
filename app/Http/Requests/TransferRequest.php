<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $type = $this->input('type');

        $specificRules = match($type) {
            'account_transfer' => [
                'account_to_id' => 'required|exists:accounts,id'
            ],
            'saving' => [
                'reinforcement' => 'required|numeric|min:0.01', 
                'end_date' => 'required|date',
                'entity_id' => 'required|exists:entities,id',
                'sub_entity_id' => 'nullable|exists:sub_entities,id',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'nullable|exists:sub_categories,id',
            ],
            'investment' => [
                'initial_amount' => 'required|numeric|min:0.01', 
                'final_amount'=> 'required|numeric|min:0.01',  
                'reinforcement'=> 'required|numeric|min:0.01',
                'entity_id' => 'required|exists:entities,id',
                'sub_entity_id' => 'nullable|exists:sub_entities,id',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'nullable|exists:sub_categories,id',
            ],
            default => []
        };

        $commonRules = [
            'date' => 'required|date',
            'notes' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:account_transfer,saving,investment',

            'account_from_id'=> 'required|exists:accounts,id',
        ];

        return array_merge($commonRules, $specificRules);
    }

    public function messages()
    {
        return [
            'date.required' => 'A data é obrigatória.',
            'date.date' => 'O formato da data está inválido.',
            'amount.required' => 'O valor é obrigatório.',
            'amount.numeric' => 'O valor deve ser numérico.',
            'amount.min' => 'O valor a transferir deve ser maior que 0.',
            'type.required' => 'O tipo é obrigatório.',
            'type.in' => 'O tipo deve ser "account_transfer", "saving" ou "investment".',
            'account_from_id.required' => 'A conta é obrigatória.',
            'account_from_id.exists' => 'Conta inválida.',
            'entity_id.required' => 'A entidade é obrigatória.',
            'entity_id.exists' => 'Entidade inválida.',
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'Categoria inválida.',
            'sub_entity_id.exists' => 'Subentidade inválida.',
            'sub_category_id.exists' => 'Subcategoria inválida.',

            'account_to_id.required' => 'A conta é obrigatória.',
            'account_to_id.exists' => 'Conta inválida.',

            'reinforcement.required' => 'O valor é obrigatório.',
            'reinforcement.numeric' => 'O valor deve ser numérico.',
            'reinforcement.min' => 'O valor a transferir deve ser maior que 0.',

            'end_date.required' => 'A data é obrigatória.',
            'end_date.date' => 'O formato da data está inválido.',

            'initial_amount.required' => 'O valor é obrigatório.',
            'initial_amount.numeric' => 'O valor deve ser numérico.',
            'initial_amount.min' => 'O valor a transferir deve ser maior que 0.',

            'final_amount.required' => 'O valor é obrigatório.',
            'final_amount.numeric' => 'O valor deve ser numérico.',
            'final_amount.min' => 'O valor a transferir deve ser maior que 0.',
        ];
    }
}

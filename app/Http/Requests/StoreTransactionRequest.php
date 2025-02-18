<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'notes' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:expense,income',
            'payment_method' => 'required|string',
            'account_id' => 'required|exists:accounts,id',
            'entity_id' => 'required|exists:entities,id',
            'sub_entity_id' => 'nullable|exists:sub_entities,id',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id'
        ];
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
            'type.in' => 'O tipo deve ser "despesa" ou "receita".',
            'payment_method.required' => 'O método de pagamento é obrigatório.',
            'account_id.required' => 'A conta é obrigatória.',
            'account_id.exists' => 'Conta inválida.',
            'entity_id.required' => 'A entidade é obrigatória.',
            'entity_id.exists' => 'Entidade inválida.',
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'Categoria inválida.',
            'sub_entity_id.exists' => 'Subentidade inválida.',
            'sub_category_id.exists' => 'Subcategoria inválida.'
        ];
    }
}
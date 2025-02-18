<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\DB; 

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::with(['category', 'subCategory', 'entity', 'subEntity'])
        ->get();

        return response()->json($transaction);
    }

    public function income()
    {
        $income = Transaction::where('type', 'income')
        ->orderBy('created_at', 'desc')
        ->get();
        
        return response()->json($income);
    }

    public function expense()
    {
        $expense = Transaction::where('type', 'expense')
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($expense);
    }

    public function store(Request $request)
    {
        $transaction = new Transaction();

        $transaction->date = $request->date;
        $transaction->notes = $request->notes;
        $transaction->amount = $request->amount;
        $transaction->type = $request->type;
        $transaction->payment_method = $request->payment_method;
        $transaction->account_id = $request->account_id;
        $transaction->entity_id = $request->entity_id;
        $transaction->sub_entity_id = $request->sub_entity_id;
        $transaction->category_id = $request->category_id;
        $transaction->sub_category_id = $request->sub_category_id;

        $account = Account::find($transaction->account_id);

        if(!$account){
            return response()->json([
                'messege' => 'Conta não foi encontrada'
            ], 404);
        }

        if($transaction->type === 'expense' && $account->amount <= 0){
            return response()->json([
                'message' => 'Não é possivel realizar esta operacao pois o saldo da conta é 0'
            ],400);
        }
        
        DB::transaction(function() use ($transaction, $account){

            if($transaction->type === 'income'){
                $account->amount = $account->amount + $transaction->amount;
            } else {
                $account->amount = $account->amount - $transaction->amount;
            }
            $account->save();
        });
     
        $transaction->save();

        return response()->json([
            'message' => 'Transação criada com sucesso',
            'transaction' => $transaction 
        ], 201);
    }

    public function show(string $id)
    {
        $transaction = Transaction::find($id);
        return response()->json($transaction);
    }

    public function update(Request $request, string $id)
    {
        $transaction = Transaction::find($id);

        $validated = $request->validate([
            'date' => 'required|date',
            'notes' => 'nullable|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:expense,income',
            'payment_method' => 'required|string',
            'account_id' => 'required|exists:accounts,id',
            'entity_id' => 'required|exists:entities,id',
            'sub_entity_id' => 'nullable|exists:sub_entities,id',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id'
        ], [
            'date.required' => 'A data é obrigatória',
            'date.date' => 'Data em formato inválido',
            'amount.required' => 'O valor é obrigatório',
            'amount.numeric' => 'O valor deve ser numérico',
            'type.required' => 'O tipo é obrigatório',
            'type.in' => 'O tipo deve ser despesa ou receita',
            'payment_method.required' => 'O método de pagamento é obrigatório',
            'account_id.required' => 'A conta é obrigatória',
            'account_id.exists' => 'Conta inválida',
            'entity_id.required' => 'A entidade é obrigatória',
            'entity_id.exists' => 'Entidade inválida',
            'category_id.required' => 'A categoria é obrigatória',
            'category_id.exists' => 'Categoria inválida'
        ]);

        $account = Account::find($transaction->account_id);

        if(!$account){
            return response()->json([
                'messege' => 'Conta não foi encontrada'
            ], 404);
        }

        if($transaction->type === 'expense' && $account->amount <= 0){
            return response()->json([
                'message' => 'Não é possivel realizar esta operacao pois o saldo da conta é 0'
            ],400);
        }

        DB::transaction(function() use ($transaction, $account){

            if($transaction->type === 'income'){
                $account->amount = $account->amount + $transaction->amount;
            } else {
                $account->amount = $account->amount - $transaction->amount;
            }
            $account->save();
        });

        $transaction->update($validated);

        return response()->json([
            'message' => 'Transação atualizado com sucesso',
            'Transaction' => $transaction
        ], 200);
    }

    public function destroy(string $id)
    {
        $transaction = Transaction::find($id);
        $account = Account::find($transaction->account_id);

        if(!$transaction){
            return response()->json([
                'messege' => 'Transação não encontrada'
            ]);
        }

        if(!$account){
            return response()->json([
                'messege' => 'Conta não foi encontrada'
            ], 404);
        }

        DB::transaction(function() use ($transaction, $account){

            if($transaction->type === 'income'){
                $account->amount = $account->amount + $transaction->amount;
            } else {
                $account->amount = $account->amount - $transaction->amount;
            }
            $account->save();
        });

        $transaction->delete();

        return response()->json([
            'message' => 'Transação eliminada com sucesso',
            'transation' => $transaction
        ]);
    }
}

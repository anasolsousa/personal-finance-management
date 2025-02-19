<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\TransactionRequest;

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

    public function store(TransactionRequest $request)
    {
        $validated = $request->validated();
        $transaction = Transaction::create($validated);

        $account = Account::find($transaction->account_id);

        if($transaction->type === 'expense' && $account->amount <= 0){
            return response()->json([
               'message' => 'Operação não permitida: o saldo da conta é insuficiente (0).'
            ],400);
        }

        if($transaction->type === 'income' && $transaction->amount <= 0){
            return response()->json([
                'message' => 'O valor a transferir tem que ser maior que 0'
            ], 400);
        }
        
        DB::transaction(function() use ($transaction, $account){

            if($transaction->type === 'income'){
                $account->amount += $transaction->amount;
            } else {
                $account->amount -= $transaction->amount;
            }
            $account->save();
        });

        return response()->json([
            'message' => 'Transação criada com sucesso',
            'transaction' => $transaction 
        ], 201);
    }

    public function show(string $id)
    {
        $transaction = Transaction::find($id);

        if(!$transaction){
            return response()->json([
                'message' => 'Transação não foi encontrada',
            ], 404);
        }

        return response()->json($transaction);
    }

    public function update(TransactionRequest $request, string $id)
    {
        $transaction = Transaction::find($id);

        $validated = $request->validated();
        $transaction = Transaction::create($validated);
      
        $account = Account::find($transaction->account_id);

        if(!$transaction){
            return response()->json([
                'message' => 'Transação não foi encontrada',
            ], 404);
        }

        if($transaction->type === 'expense' && $account->amount <= 0){
            return response()->json([
              'message' => 'Operação não permitida: o saldo da conta é insuficiente (0).'
            ],400);
        }

        if($transaction->type === 'expense' && $transaction->amount > $account->amount){
            return response()->json([
                'message' => 'Operação não permitida: o saldo da conta é insuficiente.'
              ],400);
        }

        DB::transaction(function() use ($transaction, $account){

            if($transaction->type === 'income'){
                $account->amount += $transaction->amount;
            } else {
                $account->amount -= $transaction->amount;
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
                'message' => 'Transação não encontrada'
            ]);
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

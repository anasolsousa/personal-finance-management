<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Http\Requests\TransfernRequest;

class TransferController extends Controller
{
    // ver as transferencias todas
    public function index()
    {
        $allTransfers = Transfer::all();
        return response()->json($allTransfers);
    }

    public function store(TransfernRequest $request)
    {
        $validated = $request->validated();
        $transfer = Transfer::create($validated);

        $accountFrom = Account::find($transfer->account_from_id);

        if($accountFrom->amount <= 0){
            return response()->json([
                'message' => 'Não é possível realizar a operação, saldo insuficiente.'
            ],400);
        }

        if($transfer->amount > $accountFrom->amount){
            return response()->json([
                'message' => 'Operação não permitida: o saldo da conta é insuficiente.'
              ],400);
        }

        switch($transfer->type) {
            case 'account_transfer':
                $accountTo = Account::find($transfer->account_to_id);

                $accountTo->amount += $transfer->amount;
                $accountFrom->amount -= $transfer->amount;;
                
                $accountTo->save();
                $accountFrom->save();
                break;

            case 'saving':
                $accountTo = Account::find($transfer->account_to_id);

                $accountTo->amount += $transfer->amount;
                $accountFrom->amount -= $transfer->amount;;
                
                $accountTo->save();
                $accountFrom->save();
                break;
            
            case 'investment':
                $accountFrom->amount -= $transfer->amount;
                $accountFrom->initial_amount = $transfer->amount;
                $accountFrom->save();
                break;
        }

        $accountFrom->save();

        return response()->json([
            'message' => 'Transferencia realizada com sucesso',
            'Transferencia' => $transfer 
        ], 201);
    }

    public function update(TransfernRequest $request, string $id)
    {
        $transfer = Transfer::find($id);

        $validated = $request->validated();

        if (!$transfer) {
            return response()->json([
                'message' => 'Transferência não encontrada.'
            ], 404);
        }

        $transfer->update($validated);

        if($accountFrom->amount <= 0){
            return response()->json([
                'message' => 'Não é possível realizar a operação, saldo insuficiente.'
            ],400);
        }

        if($transfer->amount > $accountFrom->amount){
            return response()->json([
                'message' => 'Operação não permitida: o saldo da conta é insuficiente.'
              ],400);
        }

        switch($transfer->type) {
            case 'account_transfer':
                $accountTo = Account::find($transfer->account_to_id);

                $accountTo->amount += $transfer->amount;
                $accountFrom->amount -= $transfer->amount;;
                
                $accountTo->save();
                $accountFrom->save();
                break;

            case 'saving':
                $accountTo = Account::find($transfer->account_to_id);

                $accountTo->amount += $transfer->amount;
                $accountFrom->amount -= $transfer->amount;;
                
                $accountTo->save();
                $accountFrom->save();
                break;
            
            case 'investment':
                $accountFrom->amount -= $transfer->amount;
                $accountFrom->initial_amount = $transfer->amount;
                $accountFrom->save();
                break;
        }

        $accountFrom->save();

        return response()->json([
            'message' => 'Transferencia realizada com sucesso',
            'Transferencia' => $transfer 
        ], 201);
    }

    public function destroy(string $id)
    {
        //
    }
}

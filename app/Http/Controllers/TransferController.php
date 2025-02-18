<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Http\Requests\StoreTransfernRequest;

class TransferController extends Controller
{
    // ver as transferencias todas
    public function index()
    {
        $allTransfers = Transfer::all();
        return response()->json($allTransfers);
    }

    public function store(StoreTransfernRequest $request)
    {
        $validated = $request->validated();
        $transfer = Transfer::create($validated);

       
        $accountFrom = Account::find($transfer->account_from_id);
        
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
        

        if($account->amount <= 0 && $transfer->amount < $account->amount){
            return response()->json([
                'message' => 'Não é possível realizar a operação, saldo insuficiente.'
            ],400);
        }

        return response()->json([
            'message' => 'Transferencia realizada com sucesso',
            'Transferencia' => $transfer 
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Account;
use Illuminate\Support\Facades\DB;   
use App\Http\Requests\TransferRequest;

class TransferController extends Controller
{
    // ver as transferencias todas
    public function index()
    {
        $allTransfers = Transfer::all();
        return response()->json($allTransfers);
    }

    public function store(TransferRequest $request)
    {
        return DB::transaction(function () use ($request) {

            $validated = $request->validated();
            //dd($validated);
            $transfer = Transfer::create($validated);
            //dd($transfer);
            $accountFrom = Account::find($transfer->account_from_id);
         
            if($accountFrom->amount <= 0){
                return response()->json([
                    'message' => 'Não é possível realizar a operação, saldo insuficiente.'
                ],400);
            }

            if($transfer->amount > $accountFrom->amount){
                return response()->json([
                    'message' => 'Não é possível realizar a operação, saldo insuficiente.'
                ],400);
            }

            switch($transfer->type) {
                case 'account_transfer':
                case 'saving':
                    $accountTo = Account::find($transfer->account_to_id);

                    $accountTo->amount += $transfer->amount;
                    $accountFrom->amount -= $transfer->amount;
                    
                    $accountTo->save();
                    $accountFrom->save();
                    break;
                
                case 'investment':
                    $accountTo = Account::find($transfer->account_to_id);

                    $accountFrom->amount -= $transfer->amount;
                    $accountTo->amount += $transfer->amount;  

                    $accountFrom->save();
                    $accountTo->save(); 
                    break;

                    default:
                    return response()->json([
                        'message' => 'Tipo de transferência inválido'
                    ], 400);
            }
            
            return response()->json([
                'message' => 'Transferencia realizada com sucesso',
                'Transferencia' => $transfer 
            ], 201);
        });
    }

    public function update(TransferRequest $request, string $id)
    {
        return DB::transaction(function () use ($request, $id) {  

            //dd($request);
            $transfer = Transfer::find($id);

            $accountFrom = Account::find($transfer->account_from_id);
            //dd($transfer);
            if (!$transfer) {
                return response()->json([
                    'message' => 'Transferência não encontrada.'
                ], 404);
            }
            // devolver o dinheiro antes de aplicar outra ação
            $amountNow = $transfer->amount;

            switch($transfer->type) {
                case 'account_transfer':
                case 'saving':
                    $accountTo = Account::find($transfer->account_to_id);

                    $accountTo->amount -=  $amountNow;
                    $accountFrom->amount +=  $amountNow;
                    break;
                
                case 'investment':
                    $accountFrom->amount += $amountNow;
                    $accountFrom->initial_amount = 0;
                    $accountTo->amount -= $amountNow;
                    break;
            }

            $accountFrom->save();
            $accountTo->save();

            $validated = $request->validated();
            $newAmount = $validated['amount'];

            if($accountFrom->amount <= 0){
                return response()->json([
                    'message' => 'Não é possível realizar a operação, saldo insuficiente.'
                ],400);
            }

            if($transfer->amount > $accountFrom->amount){
                return response()->json([
                    'message' => 'Não é possível realizar a operação, saldo insuficiente.'
                ],400);
            }

            switch($transfer->type) {
                case 'account_transfer':
                case 'saving':
                    $accountTo = Account::find($transfer->account_to_id);

                    $accountTo->amount += $newAmount;
                    $accountFrom->amount -= $newAmount;
                    break;
                
                case 'investment':
                    $accountFrom->amount -= $newAmount;
                    $accountFrom->initial_amount = $newAmount;
                    $accountTo->amount += $newAmount;
                    break;
            }

            $accountFrom->save();
            $accountTo->save();  

         
            $transfer->update($validated);

            return response()->json([
                'message' => 'Transferencia atualizada com sucesso',
                'Transferencia' => $transfer 
            ], 200);
        });
    }


    public function destroy(string $id)
    {
        return DB::transaction(function () use ($id) {  

            $transfer = Transfer::find($id);
            $account = Account::find($transfer->account_id);
            $accountFrom = Account::find($transfer->account_from_id);

            if(!$transfer){
                return response()->json([
                    'message' => 'Transferencia não foi encontrada'
                ],404);
            }

            switch($transfer->type) {
                case 'account_transfer':
                case 'saving':
                    $accountTo = Account::find($transfer->account_to_id);

                    if($accountTo->amount < $transfer->amount) {
                        return response()->json([
                            'message' => 'Saldo insuficiente na conta de destino para reverter a transferência'
                        ], 400);
                    }
        
                    $accountTo->amount -= $transfer->amount;
                    $accountFrom->amount += $transfer->amount;;
                    
                    $accountTo->save();
                    $accountFrom->save();
                    break;
                
                case 'investment':
                    $accountTo = Account::find($transfer->account_to_id);

                    if($accountTo->amount < $transfer->amount) {
                        return response()->json([
                            'message' => 'Saldo insuficiente na conta de investimento para reverter a operação'
                        ], 400);
                    }

                    $accountFrom->amount += $transfer->amount;
                    $accountTo->amount -= $transfer->amount;

                    $accountFrom->save();
                    $accountTo->save();
                    break;
            }
            $transfer->delete(); 
            
            return response()->json([
                'message' => 'Transferencia excluída e valores revertidos com sucesso'
            ], 200);
        });
    }
}

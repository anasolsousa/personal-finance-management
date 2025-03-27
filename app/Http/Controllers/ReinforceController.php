<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Account;
use Illuminate\Support\Facades\DB;   

class ReinforceController extends Controller
{
    public function reinforce(Request $request, string $id)
    {
        return DB::transaction(function () use ($request, $id) {  

            $validated = $request->validate([
                'reinforcement'=> 'required|numeric|min:0.01',
                'account_from_id'=> 'required|exists:accounts,id', // conta onde sai o dinheiro
            ]);
            
            $transfer = Transfer::find($id);

            if (!$transfer) {
                return response()->json([
                    'message' => 'Transferência não encontrada.'
                ], 404);
            }
            
            if($transfer->type === 'saving' || $transfer->type === 'investment'){

                // Obter o valor do reforço da requisição
                $reinforcement = $validated['reinforcement'];

                $accountFrom = Account::find($validated['account_from_id']);
                $accountTo = Account::find($transfer->account_to_id);

                

                if($accountFrom->amount < $reinforcement){
                    return response()->json([
                        'message' => 'Saldo insuficiente para reforço.'
                    ], 400);
                }
                
                // saldo inicial acrecenta o valor do reforço
                $transfer->amount += $reinforcement;
                // da conta onde sai o dinheiro ele tira o valor
                $accountFrom->amount -= $reinforcement;
                // da conta onde entra mais o reforço
                $accountTo->amount += $reinforcement;

                // para o valor de transferencia ocupar a variavel reforço da transfer
                $transfer->reinforcement = $reinforcement;
                // para atualizar o id da conta de onde sai o dinheiro
                $transfer->account_from_id = $accountFrom['id'];
                // dd($transfer->account_from_id);

                $accountFrom->save();
                $accountTo->save();
                $transfer->save();

                return response()->json([
                    'message' => 'Reforço realizado com sucesso',
                    'transferencia' => $transfer,
                    'reforco' => $reinforcement
                ], 200);
            }
        });  
    }
}

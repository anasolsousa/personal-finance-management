<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;

class AccountController extends Controller
{
  
    public function index()
    {
        $account = Account::where('user_id', auth()->id())->get();
        return response()->json($account);
    }

    public function store(Request $request)
    {
        $account = new Account();

        $account->name = $request->name;
        $account->type = $request->type;
        $account->amount = $request->amount;
        $account->user_id = auth()->id();

        $account->save();

        return response()->json([
            'message' => 'Conta criada com sucesso',
            'account' => $account
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        // procura pelo id da conta ('id'), e pelo id do user ('$id');
        // serve para garantir que atualiza a conta com o id certo e no user certo
        $account = Account::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();
        
        if(!$account){
            return response()->json([
                'message' => 'A Conta não foi encontrada'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'amount' => 'required|numeric',
        ], [
            'name.max' => 'O campo aceita no máximo 255 caracteres.',
            'type.max' => 'O campo aceita no máximo 255 caracteres.',
            'amount.numeric' => 'O valor deve ser numérico.',
        ]);

        $account->update($validated);

        return response()->json([
            'message' => 'Conta atualizado com sucesso',
            'account' => $account 
        ], 200);

    }

    public function destroy(string $id)
    {
         // procura pelo id da conta ('id'), e pelo id do user ('$id');
        $account = Account::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if(!$account){
            return response()->json([
                'message' => 'Conta não foi encontrada'
            ],400);
        }

        $account->delete();

        return response()->json([
            'message' => 'Conta eliminada com sucesso'
        ],200);
    }
}

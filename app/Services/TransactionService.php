<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;

class TransactionService extends Service
{
    public function storeTransaction($request)
    {
        $wallet = Wallet::where('user_id', auth()->id())->first();

        if ($request->transactionType == 'expense' && $wallet->balance < $request->amount) {
            return $this->finalResultFail([], 'Saldo anda tidak cukup!');
        }

        Transaction::create([
            'description' => $request->description,
            'transactionType' => $request->transactionType,
            'amount' => $request->amount,
        ]);

        if ($request->transactionType == 'expense') {
            $wallet->update([
                'balance' => $wallet->balance - $request->amount,
            ]);
        } else {
            $wallet->update([
                'balance' => $wallet->balance + $request->amount,
            ]);
        }

        return $this->finalResultSuccess();
    }
}

<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;

class DashboardService extends Service
{
    public function getDashboardData(): array
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->limit(5)->get();
        $totalBalance = Wallet::where('user_id', auth()->id())->sum('balance');
        $dates = collect([]);
        $incomeData = collect([]);
        $expenseData = collect([]);

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates->push($date);

            $income = Transaction::where('transactionType', 'income')->whereDate('created_at', $date)->sum('amount');
            $expense = Transaction::where('transactionType', 'expense')->whereDate('created_at', $date)->sum('amount');

            $incomeData->push($income);
            $expenseData->push($expense);
        }

        return $this->finalResultSuccess([
            'transactions' => $transactions,
            'totalBalance' => $totalBalance,
            'dates' => $dates,
            'incomeData' => $incomeData,
            'expenseData' => $expenseData,
        ]);
    }
}

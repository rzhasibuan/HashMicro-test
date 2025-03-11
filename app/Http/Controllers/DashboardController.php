<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $transactions = $this->dashboardService->getDashboardData()["data"];
        return view("dashboard.index", [
            'transactions' => $transactions['transactions'],
            'totalBalance' => $transactions['totalBalance'],
            'dates' => $transactions['dates'],
            'incomeData' => $transactions['incomeData'],
            'expenseData' => $transactions['expenseData'],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;
use App\Models\Finance;
use App\Models\Wishlist;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalSchedule = Schedule::where('user_id', $userId)->count();
        $totalIncome = Finance::where('user_id', $userId)->where('type', 'income')->sum('amount');
        $totalExpense = Finance::where('user_id', $userId)->where('type', 'expense')->sum('amount');
        $totalWishlist = Wishlist::where('user_id', $userId)->count();

        $upcomingSchedules = Schedule::where('user_id', $userId)->orderBy('date')->take(5)->get();
        $priorityWishlist = Wishlist::where('user_id', $userId)->orderBy('priority')->take(5)->get();

        $financeChart = Finance::select(
                DB::raw('MONTH(date) as month'),
                DB::raw("SUM(CASE WHEN type='income' THEN amount ELSE 0 END) as income"),
                DB::raw("SUM(CASE WHEN type='expense' THEN amount ELSE 0 END) as expense")
            )
            ->where('user_id', $userId)
            ->groupBy(DB::raw('MONTH(date)'))
            ->orderBy('month')
            ->get()
            ->map(fn($item) => [
                'month' => date('F', mktime(0,0,0,$item->month,1)),
                'income' => (int)$item->income,
                'expense' => (int)$item->expense,
            ]);

        return view('dashboard.index', compact(
            'totalSchedule','totalIncome','totalExpense','totalWishlist',
            'upcomingSchedules','priorityWishlist','financeChart'
        ));
    }
}

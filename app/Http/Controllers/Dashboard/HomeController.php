<?php

namespace App\Http\Controllers\Dashboard;

use App\Admin;
use App\Classes;
use App\Models\Subscribe;
use App\Report;
use App\Teacher;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){

        $today = Carbon::today();

        $statistics['today_subscribed_success'] = Subscribe::query()
                                    ->whereMonth('created_at', '=', $today->month)
                                    ->whereDay('created_at', '=', $today->day)
                                    ->whereYear('created_at', '=', $today->year)
                                    ->where(function ($query){
                                        $query->whereIn('payment_status', ['Captured', 'Authorized'])
                                            ->orWhere('payment_method', '=', 'hsbc');
                                    })->count();

        $statistics['today_subscribed_fail'] = Subscribe::query()
                                    ->whereMonth('created_at', '=', $today->month)
                                    ->whereDay('created_at', '=', $today->day)
                                    ->whereYear('created_at', '=', $today->year)
                                    ->whereNotIn('payment_status', ['Captured', 'Authorized'])
                                    ->count();

        if(Subscribe::query()->orderBy('updated_at', 'DESC')->first()){
            $statistics['last_try_subscription'] = Subscribe::query()->orderBy('updated_at', 'DESC')->first()->updated_at->timezone('Asia/Riyadh')->diffForHumans();
        }else{
            $statistics['last_try_subscription'] = 0;
        }

        return view('dashboard.index', compact('statistics'));
    }
}

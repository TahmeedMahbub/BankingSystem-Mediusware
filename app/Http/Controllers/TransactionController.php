<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index () {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        return view('transaction.home', compact('transactions'));
    }

    public function showDeposits () {
        $deposits = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'deposit')->get();
        return view('transaction.deposit', compact('deposits'));
    }

    public function createDeposit () {
        return view('transaction.add-deposit');
    }

    public function storeDeposit (Request $request) {
        $deposit = new Transaction();
        $deposit->user_id = Auth::user()->id;
        $deposit->transaction_type = "deposit";
        $deposit->amount = $request->amount;
        $deposit->fee = 0;
        $deposit->date = date('Y-m-d');
        $deposit->created_at = date('Y-m-d h:i:sa');
        $deposit->updated_at = date('Y-m-d h:i:sa');
        $deposit->save();

        $user = User::find(Auth::user()->id);

        $user->balance += $request->amount;
        $user->save();

        return redirect()->route('deposit')->with('success', $deposit->amount.' Taka Deposited Successfully!');
    }

    public function showWithdraws () {
        $withdraws = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'withdraw')->get();
        return view('transaction.withdraw', compact('withdraws'));
    }

    public function createWithdraw () {
        return view('transaction.add-withdraw');
    }

    public function storeWithdraw (Request $request) {
        if($request->amount > Auth::user()->balance) {
            return redirect()->route('withdraw')->with('danger', 'Withdrawn amount cannot be better than your balance!');
        }
        $withdraw = new Transaction();
        $withdraw->user_id = Auth::user()->id;
        $withdraw->transaction_type = "withdraw";
        $withdraw->amount = $request->amount;
        $withdraw->fee = $this->withdrawnFee($request->amount);
        $withdraw->date = date('Y-m-d');
        $withdraw->created_at = date('Y-m-d h:i:sa');
        $withdraw->updated_at = date('Y-m-d h:i:sa');
        $withdraw->save();

        $user = User::find(Auth::user()->id);

        $user->balance -= ($withdraw->amount + $withdraw->fee);
        $user->save();

        return redirect()->route('withdraw')->with('success', $withdraw->amount.' Taka Withdrawn Successfully!');
    }

    public function withdrawnFee($amount) {
        if(Carbon::now()->dayName == "Friday"){
            return 0;
        }

        $rate = (Auth::user()->account_type == 'individual' ? 0.015 : 0.025) / 100;

        if(Auth::user()->account_type == 'business' && Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'withdraw')->sum('amount') > 50000) {
            $rate = 0.015 / 100;
        }

        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $monthly_withdraw = Transaction::where('user_id', Auth::user()->id)
                                        ->where('transaction_type', 'withdraw')
                                        ->whereBetween('date', [$startDate, $endDate])
                                        ->sum(DB::raw('CASE WHEN amount < 1000 THEN amount ELSE 1000 END'));

        if($monthly_withdraw <= 5000 && $monthly_withdraw + $amount <= 5000){
            if($amount <= 1000) {
                return 0;
            } else {
                $fee = ($amount - 1000) * $rate;
            }
        }
        else if($monthly_withdraw <= 5000 && $monthly_withdraw + $amount > 5000) {
            $limit = 5000 - $monthly_withdraw;
            if($limit < 1000) {
                if($amount <= $limit)
                {
                    return 0;
                }
                else
                {
                    $fee = ($amount - $limit) * $rate;
                }
            }
            else if($limit > 1000)
            {
                if($amount <= 1000)
                {
                    return 0;
                }
                else
                {
                    $fee = ($amount - 1000) * $rate;
                }
            }
            else
            {
                $fee = ($amount - 1000) * $rate;
            }
        }
        else
        {
            $fee = $amount * $rate;
        }

        return number_format($fee, 2);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index () {
        return view('transaction.home');
    }

    public function showDeposits () {
        //
    }

    public function createDeposit () {
        //
    }

    public function storeDeposit (Request $request) {
        //
    }

    public function showWithdraws () {
        //
    }

    public function createWithdraw () {
        //
    }

    public function storeWithdraw (Request $request) {
        //
    }

}

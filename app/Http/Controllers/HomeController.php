<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Factura;
use App\Sale;
use Carbon\Carbon;
use App\SoldProduct;
use App\Transaction;
use App\PaymentMethod;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $monthlyBalanceByMethod = $this->getMethodBalance()->get('monthlyBalanceByMethod');
        $monthlyBalance = $this->getMethodBalance()->get('monthlyBalance');

        $annualIncommes = $this->getAnnualIncomes();
        $anualExpenses = $this->getAnnualExpenses();
        $anualStudents = $this->getAnnualStudents();

        return view('dashboard', [
            'monthlybalance'            => $monthlyBalance,
            'monthlybalancebymethod'    => $monthlyBalanceByMethod,
            'lasttransactions'          => Transaction::latest()->limit(20)->get(),
            'pendentinvoice'           => Factura::where('status_pagamento', 'Pendente')->get(),
            'annualincommes'                => $annualIncommes,
            'anualExpenses'              => $anualExpenses,
            'anualstudents'             => $anualStudents,
            'lastmonths'                => array_reverse($this->getMonthlyTransactions()->get('lastmonths')),
            'lastincomes'               => $this->getMonthlyTransactions()->get('lastincomes'),
            'lastexpenses'              => $this->getMonthlyTransactions()->get('lastexpenses'),
            'semesterexpenses'          => $this->getMonthlyTransactions()->get('semesterexpenses'),
            'semesterincomes'           => $this->getMonthlyTransactions()->get('semesterincomes')
        ]);
    }

    public function getMethodBalance()
    {
        $methods = PaymentMethod::all();
        $monthlyBalanceByMethod = [];
        $monthlyBalance = 0;

        foreach ($methods as $method) {
            $balance = Transaction::findByPaymentMethodId($method->id)->thisMonth()->sum('amount');
            $monthlyBalance += (float) $balance;
            $monthlyBalanceByMethod[$method->name] = $balance;
        }
        return collect(compact('monthlyBalanceByMethod', 'monthlyBalance'));
    }

    public function getAnnualIncomes()
    {
        $sales = [];
        foreach(range(1, 12) as $i) {
            $monthlySalesCount = Transaction::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->sum('amount');

            array_push($sales, $monthlySalesCount);
        }
        return "[" . implode(',', $sales) . "]";
    }

    public function getAnnualExpenses()
    {
        $clients = [];
        foreach(range(1, 12) as $i) {
            $monthclients = Transaction::selectRaw('count(distinct estudante_id) as total')
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->first();

            array_push($clients, $monthclients->total);
        }
        return "[" . implode(',', $clients) . "]";
    }

    public function getAnnualStudents()
    {
        $products = [];
        foreach(range(1, 12) as $i) {
            $monthproducts = Estudante::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();

            array_push($products, $monthproducts);
        }
        return "[" . implode(',', $products) . "]";
    }

    public function getMonthlyTransactions()
    {
        $actualmonth = Carbon::now();

        $lastmonths = [];
        $lastincomes = '';
        $lastexpenses = '';
        $semesterincomes = 0;
        $semesterexpenses = 0;

        foreach (range(1, 6) as $i) {
            array_push($lastmonths, $actualmonth->shortMonthName);

            $incomes = Transaction::whereYear('created_at', $actualmonth->year)
                ->WhereMonth('created_at', $actualmonth->month)
                ->sum('amount');

            $semesterincomes += $incomes;
            $lastincomes = round($incomes).','.$lastincomes;

            $expenses = abs(Transaction::whereIn('type', ['expense', 'payment'])
                ->whereYear('created_at', $actualmonth->year)
                ->WhereMonth('created_at', $actualmonth->month)
                ->sum('amount'));

            $semesterexpenses += $expenses;
            $lastexpenses = round($expenses).','.$lastexpenses;

            $actualmonth->subMonth(1);
        }

        $lastincomes = '['.$lastincomes.']';
        $lastexpenses = '['.$lastexpenses.']';

        return collect(compact('lastmonths', 'lastincomes', 'lastexpenses', 'semesterincomes', 'semesterexpenses'));
    }
}

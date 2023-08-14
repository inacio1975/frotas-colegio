<?php

namespace App\Http\Controllers;

use App\Estudante;
use App\Factura;
use App\Sale;
use Carbon\Carbon;
use App\SoldProduct;
use App\Transaction;
use App\PaymentMethod;
use App\Viagem;

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
        $anualTravels = $this->getAnnualTravels();

        return view('dashboard', [
            'monthlybalance'            => $monthlyBalance,
            'monthlybalancebymethod'    => $monthlyBalanceByMethod,
            'lasttransactions'          => Transaction::latest()->limit(20)->get(),
            'pendentinvoice'           => Factura::where('status_pagamento', 'Pendente')->get(),
            'annualincommes'                => $annualIncommes,
            'anualExpenses'              => $anualExpenses,
            'anualtravels'             => $anualTravels,
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
        for ($i = 1; $i <= Carbon::now()->month; $i++) {
            $monthsales = Factura::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->sum('valor');

            array_push($sales, $monthsales);
        }

        return "[" . implode(',', $sales) . "]";
    }

    public function getAnnualExpenses()
    {
        $clients = [];
        foreach (range(1, 12) as $i) {
            $monthclients = Transaction::selectRaw('count(distinct estudante_id) as total')
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->first();

            array_push($clients, $monthclients->total);
        }
        return "[" . implode(',', $clients) . "]";
    }

    public function getAnnualTravels()
    {
        $viagens = [];
        for ($i = 1; $i <= Carbon::now()->month; $i++) {
            $monthviagens = Viagem::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)
                ->count();

            array_push($viagens, $monthviagens);
        }

        return "[" . implode(',', $viagens) . "]";
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
            $lastincomes = round($incomes) . ',' . $lastincomes;

            $expenses = abs(Transaction::whereIn('type', ['expense', 'payment'])
                ->whereYear('created_at', $actualmonth->year)
                ->WhereMonth('created_at', $actualmonth->month)
                ->sum('amount'));

            $semesterexpenses += $expenses;
            $lastexpenses = round($expenses) . ',' . $lastexpenses;

            $actualmonth->subMonth(1);
        }

        $lastincomes = '[' . $lastincomes . ']';
        $lastexpenses = '[' . $lastexpenses . ']';

        return collect(compact('lastmonths', 'lastincomes', 'lastexpenses', 'semesterincomes', 'semesterexpenses'));
    }
}

<?php

namespace App\Console;

use App\Estudante;
use App\Factura;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            $this->gerarFaturasMensais();
        })->monthly(); // Define a frequência mensal
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    private function gerarFaturasMensais()
    {
        $mesAtual = Carbon::now()->format('Y-m');

        // Obtém os estudantes que ainda não têm fatura para o mês atual
        $estudantes = Estudante::whereDoesntHave('facturas', function ($query) use ($mesAtual) {
            $query->whereYear('data_emissao', Carbon::now()->year)
                ->whereMonth('data_emissao', Carbon::now()->month);
        })->get();

        foreach ($estudantes as $estudante) {
            // Crie uma nova fatura para o estudante
            $fatura = new Factura();
            $fatura->valor = 20000;
            //$fatura->valor = $estudante->valor_pagar_mes;
            $fatura->data_emissao = Carbon::now();
            $fatura->data_vencimento = Carbon::now()->addDays(10);
            $fatura->estudante_id = $estudante->id;
            $fatura->save();

            // // Registre a transação correspondente
            // $transacao = new Transaction();
            // $transacao->type = 'Fatura';
            // $transacao->amount = $fatura->valor;
            // $transacao->estudante_id = $estudante->id;
            // $transacao->user_id = 1; // Defina o ID do usuário responsável
            // $transacao->save();
        }
    }
}

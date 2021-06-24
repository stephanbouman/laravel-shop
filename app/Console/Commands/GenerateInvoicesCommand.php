<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class GenerateInvoicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and store invoices for all orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Order::all()
            ->each(function (Order $order) {
                $order->saveInvoicePdf();
                $this->info('Generated invoice for order #' . $order->id);
            });
    }
}

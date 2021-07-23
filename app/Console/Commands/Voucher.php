<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Voucher as VoucherModel;

class Voucher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voucher:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update voucher status to expired when current date > date end';

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
        VoucherModel::whereDate('to', '<', Carbon::today()->toDateString())
                      ->orWhere('quantity', 0)
                      ->update(['status' => VoucherModel::EXPIRED_STATUS]);
        $this->info('voucher:status Command Run successfully!');
    }
}

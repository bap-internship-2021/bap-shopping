<?php

namespace Database\Seeders;

use Database\Factories\VoucherFactory;
use Illuminate\Database\Seeder;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Voucher::factory()->count(10)->create();
    }
}

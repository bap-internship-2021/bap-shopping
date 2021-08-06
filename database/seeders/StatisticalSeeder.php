<?php

namespace Database\Seeders;

use App\Models\Statistical;
use Illuminate\Database\Seeder;

class StatisticalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Statistical::insert(
            [
                ['order_date' => '2021-07-01', 'sales' => '20000000', 'profit' => '15000000', 'quantity' => '90', 'total_order' => '10'],
                ['order_date' => '2021-07-02', 'sales' => '30000000', 'profit' => '16000000', 'quantity' => '80', 'total_order' => '12'],
                ['order_date' => '2021-07-03', 'sales' => '40000000', 'profit' => '17000000', 'quantity' => '70', 'total_order' => '15'],
                ['order_date' => '2021-07-04', 'sales' => '50000000', 'profit' => '18000000', 'quantity' => '60', 'total_order' => '20'],
                ['order_date' => '2021-07-05', 'sales' => '40000000', 'profit' => '17000000', 'quantity' => '50', 'total_order' => '21'],
                ['order_date' => '2021-07-06', 'sales' => '30000000', 'profit' => '10000000', 'quantity' => '70', 'total_order' => '13'],
                ['order_date' => '2021-07-07', 'sales' => '10000000', 'profit' => '8000000', 'quantity' => '30', 'total_order' => '8'],
                ['order_date' => '2021-07-08', 'sales' => '60000000', 'profit' => '15000000', 'quantity' => '70', 'total_order' => '23'],
                ['order_date' => '2021-07-09', 'sales' => '70000000', 'profit' => '25000000', 'quantity' => '80', 'total_order' => '26'],
                ['order_date' => '2021-07-10', 'sales' => '80000000', 'profit' => '35000000', 'quantity' => '90', 'total_order' => '28'],
                ['order_date' => '2021-07-11', 'sales' => '90000000', 'profit' => '55000000', 'quantity' => '90', 'total_order' => '30'],
                ['order_date' => '2021-07-12', 'sales' => '70000000', 'profit' => '25000000', 'quantity' => '80', 'total_order' => '21'],
                ['order_date' => '2021-07-13', 'sales' => '60000000', 'profit' => '20000000', 'quantity' => '40', 'total_order' => '19'],
                ['order_date' => '2021-07-14', 'sales' => '50000000', 'profit' => '15000000', 'quantity' => '82', 'total_order' => '17'],
                ['order_date' => '2021-07-15', 'sales' => '70000000', 'profit' => '30000000', 'quantity' => '74', 'total_order' => '25'],
                ['order_date' => '2021-07-16', 'sales' => '20000000', 'profit' => '10000000', 'quantity' => '63', 'total_order' => '12'],
                ['order_date' => '2021-07-17', 'sales' => '30000000', 'profit' => '12000000', 'quantity' => '55', 'total_order' => '11'],
                ['order_date' => '2021-07-18', 'sales' => '50000000', 'profit' => '23000000', 'quantity' => '60', 'total_order' => '14'],
                ['order_date' => '2021-07-19', 'sales' => '70000000', 'profit' => '40000000', 'quantity' => '67', 'total_order' => '22'],
                ['order_date' => '2021-07-20', 'sales' => '90000000', 'profit' => '55000000', 'quantity' => '78', 'total_order' => '33'],
                ['order_date' => '2021-07-21', 'sales' => '10000000', 'profit' => '6000000', 'quantity' => '30', 'total_order' => '7'],
                ['order_date' => '2021-07-22', 'sales' => '30000000', 'profit' => '24000000', 'quantity' => '43', 'total_order' => '16'],
                ['order_date' => '2021-07-23', 'sales' => '50000000', 'profit' => '36000000', 'quantity' => '48', 'total_order' => '24'],
                ['order_date' => '2021-07-24', 'sales' => '80000000', 'profit' => '58000000', 'quantity' => '76', 'total_order' => '29'],
                ['order_date' => '2021-07-25', 'sales' => '90000000', 'profit' => '75000000', 'quantity' => '87', 'total_order' => '35'],
                ['order_date' => '2021-07-26', 'sales' => '70000000', 'profit' => '45000000', 'quantity' => '80', 'total_order' => '34'],
                ['order_date' => '2021-07-27', 'sales' => '60000000', 'profit' => '33000000', 'quantity' => '72', 'total_order' => '31'],
                ['order_date' => '2021-07-28', 'sales' => '40000000', 'profit' => '29000000', 'quantity' => '42', 'total_order' => '28'],
                ['order_date' => '2021-07-29', 'sales' => '20000000', 'profit' => '9000000', 'quantity' => '30', 'total_order' => '24'],
                ['order_date' => '2021-07-30', 'sales' => '50000000', 'profit' => '35000000', 'quantity' => '38', 'total_order' => '27'],
                ['order_date' => '2021-07-31', 'sales' => '80000000', 'profit' => '66000000', 'quantity' => '83', 'total_order' => '30'],
            ]
            );
    }
}

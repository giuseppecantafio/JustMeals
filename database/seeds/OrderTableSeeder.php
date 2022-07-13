<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakeOrders = [
            [
                'note' => "passate da dietro che c'è Leonardo!",
                'delivery_time' => '12:30',
                'total_price' => 15.00,
                'customer_id' => 1
            ],
            [
                'note' => 'il più presto possibbbbile',
                'delivery_time' => '22:30',
                'total_price' => 23.50,
                'customer_id' => 2
            ],
            [
                'note' => 'aiuto mio padre mi picchia',
                'delivery_time' => '04:30',
                'total_price' => 5.00,
                'customer_id' => 3
            ],
        ];

        foreach($fakeOrders as $order){
            $newOrder = new Order();

            $newOrder->note = $order['note'];
            $newOrder->delivery_time = $order['delivery_time'];
            $newOrder->total_price = $order['total_price'];
            $newOrder->customer_id = $order['customer_id'];

            $newOrder->save();
        }
    }
}

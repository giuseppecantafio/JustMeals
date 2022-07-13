<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakeCustomers = [
            [
                'name' => "Leonardo",
                'surname' => "Rossi",
                'email' => 'leo.rossi@gmail.com',
                'address' => 'Via dai cojoni, 69'
            ],
            [
                'name' => 'Clelia',
                'surname' => "Rossini",
                'email' => 'clelia.rossini@gmail.com',
                'address' => 'Via Manzoni, 50'
            ],
            [
                'name' => 'Giuliano',
                'surname' => "Mattoni",
                'email' => 'giuliano.mattoni@gmail.com',
                'address' => 'Via XXX 69'
            ],
        ];

        foreach($fakeCustomers as $customer){
            $newCustomer = new Customer();

            $newCustomer->name = $customer['name'];
            $newCustomer->surname = $customer['surname'];
            $newCustomer->email = $customer['email'];
            $newCustomer->address = $customer['address'];

            $newCustomer->save();
        }
    }
}

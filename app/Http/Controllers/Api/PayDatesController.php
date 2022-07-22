<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Item;
use App\Restaurant;

class PayDatesController extends Controller
{
    // public function getCartData(Request $request){


    //     // dd($request);
    //     $data = $request->all();

    //     // return redirect()->route('welcome', compact('data'));
    //     return redirect()->route('/', compact('data'));
    // }


    public function postPayment(Request $request){

        // $data = $request->all();
        // return response()->json($data);

        $data = $request->all();

        $userData = $data['user_dates']['datiUtente'];
        $transItems = $data['transaction']['cartItems'];
        // return response()->json($userData);
        $newOrder = new Order();
        // qui fare controllo del new customer, se è new o no
        $mailFound = false;
        $nameFound = false;
        $surnameFound = false;
        $fullnameFound = false;

        // dd($data);
        
        $CustomerEmail = Customer::where('email', $userData['email'])->get();

        $customerFullName = Customer::where([
            ['name', '=', $userData['name']],
            ['surname', '=', $userData['surname']],
        ])->get();
        
        foreach ($customerFullName as $customerConFullnameTrovata){
            if($customerConFullnameTrovata){
                $fullnameFound = true;
            }
        }

        foreach ($CustomerEmail as $customerConMailTrovata){
            if($customerConMailTrovata){
                $mailFound = true;
            }
        }

        if($mailFound && $fullnameFound){
            return response()->json('Bentornato');
            // dd('Bentornato!! Sconto Speciale per te');
            

        } else if ($mailFound){
            return response()->json('La tua mail esiste già sotto un altro nome');
            // dd('Questa mail esiste già sotto un altro nome. Reinserisci i dati corretti');
        } else {

            // return response()->json('creo nuovo customer');
            
            // NEW CUSTOMER
            $newCustomer = new Customer();
            $newCustomer->name = $userData['name'];
            $newCustomer->surname = $userData['surname'];
            $newCustomer->email = $userData['email'];
            $newCustomer->address = $userData['address'];
            $newCustomer->save();
            $customer = Customer::where("email", $newCustomer->email)->first();
        }

        // ORDINE
        $newOrder->customer_id = $customer->id;
        $newOrder->delivery_time = $userData['delivery_time'];
        $newOrder->note = $userData['note'];
        $itemsOrdered = [];

        $total_price = 0;

        $count = 1;
        foreach($transItems as $item){
            
            ${"newItem".$count} = [
                "stats" => Item::where("name", $item['name'])->first(),
                'quantity' => $item['quantity']
            ];



            $total_price += ${"newItem".$count}['stats']['price'] * ${"newItem".$count}['quantity'];
            $itemsOrdered[] = ${"newItem".$count};

            $count++;
        }

        
        $newOrder->total_price = $total_price;
        
        
        
        $newOrder->save();

        // return response()->json($newOrder);



        foreach($itemsOrdered as $singleItem){
            $price = $singleItem['stats']['price'];

            $newOrder->items()->attach(
                $singleItem['stats'],
                [
                    'quantity' => $singleItem['quantity'],
                    'item_price' => $price
                ]
            );

        }


    }
}

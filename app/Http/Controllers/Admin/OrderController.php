<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Item;
use App\Customer;
use App\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\ConfirmationMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rest_id)
    {
        $restaurant = Restaurant::findOrFail($rest_id);

        $auth_user = Auth::user()->id;
        if ($auth_user != $restaurant->user_id){
            abort(401);
        }

        $items = Item::where('restaurant_id', $restaurant->id)->get();

        $orders = Order::whereHas('items', function($q) use($items) {
                $q->whereIn('item_id', $items);
            })->get();
        // dd($orders);
        
        return view('admin.orders.index', compact('orders', 'restaurant', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::where("restaurant_id", 2)->get();
        return view('admin.orders.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newOrder = new Order();
        // qui fare controllo del new customer, se è new o no
        $mailFound = false;
        $nameFound = false;
        $surnameFound = false;
        $fullnameFound = false;
        
        $CustomerEmail = Customer::where('email', $data['userEmail'])->get();

        $customerFullName = Customer::where([
            ['name', '=', $data['userName']],
            ['surname', '=', $data['userSurname']],
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
            dd('Bentornato!! Sconto Speciale per te');
        } else if ($mailFound){
            dd('Questa mail esiste già sotto un altro nome. Reinserisci i dati corretti');
        } else {

            // NEW CUSTOMER
            $newCustomer = new Customer();
            $newCustomer->name = $data['userName'];
            $newCustomer->surname = $data['userSurname'];
            $newCustomer->email = $data['userEmail'];
            $newCustomer->address = $data['userAddress'];
            $newCustomer->save();
            $customer = Customer::where("email", $newCustomer->email)->first();
        }


        // ORDINE
        $newOrder->customer_id = $customer->id;
        $newOrder->delivery_time = $data['delivery'];
        $newOrder->note = $data['userNote'];
        $itemsOrdered = [];
        $item1 = Item::where("id", $data['item1'])->first();
        $item2 = Item::where("id", $data['item2'])->first();
        $item3 = Item::where("id", $data['item3'])->first();
        $price1 = $item1->price;
        $price2 = $item2->price;
        $price3 = $item3->price;
        $totPrice1 = $price1 * $data['quantity1'];
        $totPrice2 = $price2 * $data['quantity2'];
        $totPrice3 = $price3 * $data['quantity3'];
        $total_price = $totPrice1 + $totPrice2 + $totPrice3;
        $newOrder->total_price = $total_price;
        $newOrder->save();

        $newOrder->items()->sync([
            [
                'item_id' => $item1->id,
                'quantity' => $data['quantity1'],
                'item_price' => $price1
            ],
            [
                'item_id' => $item2->id,
                'quantity' => $data['quantity2'],
                'item_price' => $price2
            ],
            [
                'item_id' => $item3->id,
                'quantity' => $data['quantity3'],
                'item_price' => $price3
            ]
        ]);

        // App\User::find(1)->roles()->save($role, ['expires' => $expires]);

        return redirect()->route('admin.orders.show', $newOrder->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($rest_id, Order $order)
    {   
        $restaurant = Restaurant::findOrFail($rest_id);
        return view('admin.orders.show', compact('order', 'restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($restaurant_id, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $items = $order->items()->get();
        return view('admin.orders.edit', compact('restaurant_id', 'order', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $restaurant_id, $order_id)
    {
        $data = $request->all();

        $order = Order::findOrFail($order_id);

        if($order->delivery_time != $data['delivery']){
            $order->delivery_time = $data['delivery'];
            
        }

        if(isset($data['confirmed'])){
            $order->confirmed = 1;

            // mail di conferma

            $customer = Customer::findOrFail($order->customer_id);

            $items = $order->items()->get();

            $restaurant_id = $items[0]->restaurant_id;

            $restaurant = Restaurant::findOrFail($restaurant_id);

            Mail::to($customer->email)->send(new ConfirmationMail($customer->name, $customer->surname, $restaurant->name, $order->delivery_time));
        } else {
            $order->confirmed = 0;
        }

        $order->update();

        return redirect()->route('admin.orders.show', [$restaurant_id, $order->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rest_id, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->items()->sync([]);
        $order->delete();

        return redirect()->route('admin.orders.index', $rest_id);
    }

    
}

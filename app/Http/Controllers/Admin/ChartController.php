<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Restaurant;
use App\Item;
use Illuminate\Support\Facades\DB;
use App\Chart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $auth_user = Auth::user()->id;
        $restaurant = Restaurant::where("user_id", "=", $auth_user)
            ->get();
           
        
        // $cazzo = $user_urestaurant[0]->user_id;  
        //$restaurants = Restaurant::where($auth_user, "user_id")->get();
        
        
        $items_restaurant = Item::where("restaurant_id", $restaurant[0]->user_id)->with("orders")->get();
        

        // controllo autenticazione
        
        if ($auth_user != $restaurant[0]->user_id){
            abort(401);
        }
        $orders = DB::table('orders')
            
            ->select("total_price", DB::raw('count(*) as total'))
            ->groupBy("total_price")
            ->pluck("total", "total_price")
            ->all(); 

        for ($i=0; $i<=count($orders); $i++) {
            $colours[] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        }

        $chart = new Chart;
            $chart->labels = (array_keys($orders));
            $chart->dataset = (array_values($orders));
            $chart->colours = $colours;
        
            return view('admin.chart.index', compact('chart'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}

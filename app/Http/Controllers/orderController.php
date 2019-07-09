<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\group;
use App\order;
use App\item;

class orderController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        $user = $request->user();
        if($user->isAdmin()){
            $orders = order::orderBy('id', 'desc')
                ->get();
        } else {
            $orders = $user
                ->Orders()
                ->orderBy('id', 'desc')
                ->get();
        }


        return view('order.index', [
            'orders' => $orders
        ]);
    }

    public function create(Request $request){
        $data = [
            'groups' => group::orderBy('order')->get()
        ];

        return view('order.create', $data);
    }

    public function show(Request $request, $id){
        $user = $request->user();
        $order = order::findOrFail($id);
        if(!$user->isAdmin() && $order->user_id != $user->id){
            return redirect()
                ->route('order.index');
        }

        $data = [
            'groups' => group::orderBy('order')->get(),
            'order' => $order,
            'buys' => $order->Items->keyBy('item_id')->toArray()
        ];
        
        return view('order.show', $data);
    }

    public function store(Request $request){
        $order = $request
            ->user()
            ->Orders()->create([
                'summ' => 0,
            ]);

        $itogo = 0;
        foreach($request->count as $code => $count) {
            $item = item::find($code);

            if($count && $item) {
                $summ = $count * $item->price;
                $itogo += $summ;
                $order->Items()->create([
                    'item_id' => $item->id,
                    'count' => $count,
                    'price' => $item->price,
                    'summ' => $summ
                ]);
            }
        }

        $order->update(['summ' => $itogo]);

        return redirect()
            ->route('order.index')
            ->with([
                'status' => 'Заказ создан'
            ]);
    }


}

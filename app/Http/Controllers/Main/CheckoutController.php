<?php

namespace App\Http\Controllers\Main;

use App\Models\Cart\Cart;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use App\Models\Courier\Courier;
use App\Models\Payment\Payment;
use App\Models\Delivery\Delivery;
use App\Models\Indoregion\Regency;
use App\Models\Indoregion\District;
use App\Models\Indoregion\Province;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function view(Request $request)
    {

        $delivery = Delivery::where('user_id', Auth::id())->first();
       
        // $order = Order::where('status', 'Unpaid')
        // ->where('name', $delivery->receiver)->get();
        // dd($order);
        $cart = Cart::where('user_id', Auth::id())->get();
        
        // $snapToken = session()->get('snapToken');

        // if ($snapToken) {
        //     dd('a');
        // }

        $total_weight = 0;
        foreach ($cart as $data) {
           $total_weight +=  $data->book_qty * $data->book->weight;
        }

        $harga = $request->input('harga');
        
        // if ($request->ajax()) {
            // dd($request->input('harga_total'));
        // } else {
        //     // dd('bukan ajax');
        // }

        // if ($delivery === null) {
        //     dd('kososng');
        // } else {
        //     dd('onok');
        // }
            
        // dd($delivery);
            $kurir = Courier::all();
            
            // $ongkos = RajaOngkir::ongkosKirim([
            //     'origin'        => '444', // ID kota/kabupaten asal
            //     'destination'   => '444', // ID kota/kabupaten tujuan
            //     'weight'        => $total_weight, // berat barang dalam gram
            //     'courier'       => 'jne' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            // ])->get();
            // dd($ongkos);

            
            

                // foreach ($ongkos as $cost) {
                //     // dd($cost['costs']);   
                // }

            
        // $cart = Cart::where('user_id', Auth::id())->get();
        $province = RajaOngkir::provinsi()->all();
        
        if ($cart->count() == 0) {
            return redirect()->route('cartView');
        }

        return view('main.checkout', compact('cart', 'province', 'delivery', 'kurir', 'harga'));
    }

    public function province(Request $request)
    {
        $province_id = $request->input('province_id');
        

        $regency = Regency::where('province_id', $province_id)->get();
        // dd($regency);

        echo "<option value='0'>Pilih Kota/Kabupaten</option>";
        foreach ($regency as $data) {
            echo "<option value='$data[id]'>$data[name]</option>";
        }
    }

    public function regency(Request $request)
    {
        $regency_id = $request->input('regency_id');

        $district = District::where('regency_id', $regency_id)->get();
        // dd($district);   

        echo "<option value='' selected>Pilih Kecamatan</option>";
        foreach ($district as $data) {
            echo "<option value='$data[id]'>$data[name]</option>";
        }
    }

    public function addressStore(Request $request)
    {
        $deliveries = Delivery::where('user_id', Auth::id())->first();
        $validator = Validator::make($request->all(), [
            'label_address' => 'required',
            'receiver' => 'required',
            'phone' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors'=>$validator->messages(),
            ]);
        } elseif (!$deliveries) {
           

           $deliveries = new Delivery;
        }

           $deliveries->user_id = Auth::id();
           $deliveries->label_address = $request->label_address;
           $deliveries->receiver = $request->receiver;
           $deliveries->phone = $request->phone;
           $deliveries->province_id = $request->province;
           $deliveries->regency_id = $request->regency;
           $deliveries->district_id = $request->district;
           $deliveries->address = $request->address;
           $deliveries->save();

           return response()->json([
            'status'=>200,
            'message'=>'Alamat Tujuan Pengiriman Berhasil Tersimpan',
            'data'=>$deliveries,
            'province'=>$deliveries->province,
            'regency'=>$deliveries->regency,
            'district'=>$deliveries->district,
           ]);
        

    }

    public function updateCheckout(Request $request)
    {
        $book_id = $request->input('book_id');
        $book_qty = $request->input('book_qty');

        if (Auth::check())
        {
            if (Cart::where('book_id', $book_id)->where('user_id', Auth::id())->exists())
            {
                $cart = Cart::where('book_id', $book_id)->where('user_id', Auth::id())->first();
                $cart->book_qty = $book_qty;
                $cart->update();

                return response()->json(['status' => 'Jumlah Produk Berhasil di Tambah']);
            }
        }
    }

    public function cekOngkir(Request $request)
    {
        $code = $request->input('code');
        // $code = 'jne';
        $delivery = Delivery::where('user_id', Auth::id())->first();
        $cart = Cart::where('user_id', Auth::id())->get();
        // dd($cart);
        $total_weight = 0;
        foreach ($cart as $data) {
           $total_weight +=  $data->book_qty * $data->book->weight;
        }

        $cost = RajaOngkir::ongkosKirim([
            'origin'        => '444', // ID kota/kabupaten asal
            'destination'   => $delivery->regency_id, // ID kota/kabupaten tujuan
            'weight'        =>  $total_weight, // berat barang dalam gram
            'courier'       => $code // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        // dd($cost);

        foreach ($cost as $data) {
            foreach ($data['costs'] as $item) {
                foreach ($item['cost'] as $cost) { 
                    return response()->json([
                        'data'=>$data,
                        'item'=>$item,
                        'cost'=>$cost,
                    ]);
                    // dd($item);
                }
            }
        }

            // $response = Http::withHeaders(['key' => 'd0b5eb8064ee167cefe0c6e4a1f8439d'])
            // ->post('https://api.rajaongkir.com/starter/cost', [
            //     'origin'=> 501,
            //     'destination'=> 114,
            //     'weight'=>1700,
            //     'courier'=>'jne',
            // ]);

            // return $response->json();
        
        

        return view('testing.cekongkir');
    }

    public function checkout_post(Request $request)
    {
        return $request;
    }

}

@extends('layouts.admin')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


{{-- <p style="margin-top: 97px; margin-left: 280px;"><b>Barang yang dipesan: </b></p>
<div class="order-product"></div>
<div class="card border" style="margin-top:25px; margin-left: 270px;">
    <div class="card-body">
      Singa Putih
    </div>
</div> --}}

<div class="d-flex" style="margin-top: 97px">
    <div class="order-history-left" style="width: 40%; margin-left: 280px">
        <h5 style="font-size: 16px"><b>Rincian barang</b></h5>
        <div class="card mt-3">
          @foreach ($buku_array as $item)
           {{-- @foreach ($order->order_detail as $detail) --}}
          <div class="card-body d-flex">
            <img src="{{ asset('coverimage') }}/{{ $item->cover }}" alt="buku1" style="width: 60px; height: 90px" />
            <div class="harga-pemesanan d-flex" style="width: 500px; justify-content: space-between">
              <div class="text-pemesanan ps-3">
                <span style="font-size: 14px">{{ $item->title }}</span><br />
                <span class="text-muted" style="font-size: 12px">1 barang</span>
                <p class="m-0 text-muted" style="font-size: 12px; font-family: 'Nunito', sans-serif">@currency($item->price)</p>
              </div>
              <div class="pemesanan" style="margin-top: 30px">
                <span class="text-primary" style="font-size: 14px; font-family: 'Nunito', sans-serif">@currency($item->price)</span>
              </div>
            </div>
          </div>
          {{-- @endforeach --}}
          @endforeach
        </div>
    </div>
    <div class="order-history-right">
        <div class="info-pemesanan">
            <b class="ps-4">Info Pemesanan</b>
            <div class="card ms-3 mt-2 me-4" style="margin-right: 100px; width: 500px;">
              <div class="card-body">
                <p class="m-0">Status Transaksi</p>
        
                @if ($order->status == "settlement")
                  <span class="ps-2 pe-2 status-pemesanan text-light" style="background-color: #0f5132">
                  Pembayaran Berhasil
                  </span>
                @elseif ($order->status == "capture")  
                  <span class="ps-2 pe-2 status-pemesanan text-light" style="background-color: #0f5132">
                  Pembayaran Berhasil
                  </span>
                @elseif ($order->status == "completed")  
                  <span class="ps-2 pe-2 status-pemesanan text-light" style="background-color: #0f5132">
                  Pesanan Selesai
                  </span>
                @elseif ($order->status == "pending")  
                  <span class="ps-2 pe-2 status-pemesanan text-muted"  style="margin-left: 10px;font-family: 'Nunito', sans-serif;font-weight: 600;height: 30px; background-color: #eaff00">
                  Menunggu Pembayaran
                  </span>
                @else
                  <span class="ps-2 pe-2 status-pemesanan text-light" style="background-color: #721c24">
                  Pesanan Dibatalkan
                  </span>
                @endif
        
                {{-- <span class="ps-2 pe-2 status-pemesanan text-muted">Menunggu Pembayaran</span> --}}
                <p class="pt-3 m-0">No. Transaksi</p>
                <span style="font-size: 13px">{{ $order->transaction_id }}</span>
                <p class="pt-3 m-0">No. Pemesanan</p>
                <span id="transaction_id" style="font-size: 13px">{{ $order->order_id }}</span>
                <i class="bi bi-files text-primary" onclick="copyToClipboard('#transaction_id')"></i>
                <p class="pt-3 m-0">Tanggal Pemesanan</p>
                <span style="font-size: 13px">{{ $order->created_at->format('d-m-Y') }}</span>
              </div>
            </div>
          </div>


          <div class="rincian-pembayaran mt-2 me-6">
            <b class="ps-4">Rincian Pembayaran</b>
            <div class="card ms-3 mt-2 me-4">
              <div class="card-body">
                <div class="jumlah-harga pb-3 d-flex" style="justify-content: space-between"> 
                   {{-- @foreach ($order->order_detail as $detail)  --}}
                   <div class="jumlah">
                    <p class="m-0">Total biaya {{ $order->order_detail->qty }} barang</p>
                    <p class="m-0 mt-2">Total biaya pengiriman</p>
                    <p class="m-0 mt-2">Potongan diskon/voucher</p>
                  </div>
                  <div class="harga">
                    <p class="m-0">@currency($order->total_price - $order->ongkir_price)</p>
                    <p class="m-0 mt-2">@currency($order->ongkir_price)</p>
      
                    @if ($order->coupon != null) 
                      @if ($order->coupon->value != null)
                      <p class="ms-0 mt-2 text-danger" style="font-weight: 600">({{ $order->coupon->code }}) -@currency($order->coupon->value)</p>
                      @else
                      <p class="ms-0 mt-2 text-danger" style="font-weight: 600">({{ $order->coupon->code }}) -{{ $order->coupon->percent_off }}%</p>
                      @endif
                    @endif
      
                  </div> 
                   {{-- @endforeach  --}}
                 </div>
                <div class="total-biaya d-flex pt-3 pb-3" style="justify-content: space-between">
                  <div class="total">
                    <p class="m-0">Total Biaya Belanja</p>
                  </div>
                  <div class="biaya">
                    @if ($order->coupon != null)
                      @if ($order->coupon->value != null)
                      <p class="m-0">@currency($order->total_price - $order->coupon->value)</p>
                      @elseif ($order->coupon->percent_off != null)
                      @php
                          $price_disc = ($order->coupon->percent_off / 100) * $order->total_price;
                      @endphp   
                      <p class="m-0">@currency($order->total_price - $price_disc)</p>   
                      @endif
                    @endif
                  </div>
                </div> 
                 <div class="account-pembayaran pt-4 pb-4">
                  <b>Virtual Account BCA (Otomatis)</b>
                </div> 
                 <div class="nomor-virtual d-flex" style="justify-content: space-between"> 
                   <div class="nomor">
                    <p class="m-0" style="font-size: 12px">Nomor Virtual Account</p>
                    <b style="font-size: 14px">39176574267</b>
                  </div>
                  <div class="virtual">
                    <b class="text-primary" style="font-size: 14px">Salin</b>
                  </div>
                </div>
                <div class="total-belanja d-flex pt-3 pb-3" style="justify-content: space-between">
                  <div class="totall">
                    <p class="m-0" style="font-size: 12px">Total Biaya Belanja</p>
                    <b class="text-primary" style="font-size: 14px">@currency($order->total_price)</b>
                  </div>
                  <div class="belanja">
                    <b class="text-primary" style="font-size: 14px">Salin</b>
                  </div> 
                </div>
                @if ($order->status == 'capture')
      
                @elseif($order->status == 'settlement')
      
                @else
                <span><b>Produk ini belum terbayar</b></span>
                 <div class="btn btn-outline-primary rounded-pill pembayaran mt-2" style="width: 100%; font-family: 'Nunito', sans-serif">Lihat Cara Pembayaran</div>
                @endif 
              </div>
            </div>
          </div>
          <div class="rincian-pengiriman mt-2">
            <b class="ps-3">Rincian Pengiriman</b>
            <div class="card ms-3 mt-3 me-4">
              <div class="card-body">
                <div class="metode-pengiriman pb-3">
                  <p class="text-secondary mb-1">Metode Pengiriman</p>
                  <p class="mb-1" style="font-weight: 600">{{ $order->expedition }}</p>
                  <p class="m-0">Perkiraan sampai 22-12-2022 - 23-12-2022</p>
                </div>
                <div class="alamat-tujuan pt-3">
                  <div class="icon-truck d-flex">
                    <i class="bi bi-truck pe-2"></i>
                    <p class="mb-2" style="font-weight: 600">Alamat Tujuan Pengiriman</p>
                  </div>
                  <p class="mb-2">{{ $delivery->receiver }} | +62{{ $delivery->phone }}</p>
                  <p>{{ $delivery->address }}</p>
                </div>
              </div>
            </div>
          </div>


    </div>
</div>
<div class="button" style="margin-left: 280px;">
  <a href="#" onclick="deleteorder({{ $order->id }})" class="btn btn-danger" type="button" style="width: 101%;">Hapus Pesanan</a>
  @if ($order->status == 'capture')
    <a href="#" onclick="completeOrder({{ $order->id }})" class="btn btn-success" type="button" style="width: 101%;">Selesaikan Pesanan</a>
  @elseif ($order->status == 'settlement')
    <a href="#" onclick="completeOrder({{ $order->id }})" class="btn btn-success" type="button" style="width: 101%;">Selesaikan Pesanan</a>
  @endif
</div>

{{-- <div class="rincian-barang d-flex" style="padding-top: 97px; margin-left: 280px; margin-right: 600px;">
    <div class="product-order">
        
    </div> --}}
    {{-- <div class="order-info">
       
    </div>
  </div>
  <div class="order-history-right">
    <div class="rincian-pembayaran mt-3">
      <b class="ps-5">Rincian Pembayaran</b>
      <div class="card ms-5 mt-3" style="width: 500px">
        <div class="card-body">
          <div class="jumlah-harga pb-3 d-flex" style="justify-content: space-between"> --}}
            {{-- @foreach ($order->order_detail as $detail) --}}
            {{-- <div class="jumlah">
              <p class="m-0">Total biaya {{ $order->order_detail->qty }} barang</p>
              <p class="m-0 mt-2">Total biaya pengiriman</p>
              <p class="m-0 mt-2">Potongan diskon/voucher</p>
            </div>
            <div class="harga">
              <p class="m-0">@currency($order->total_price - $order->ongkir_price)</p>
              <p class="m-0 mt-2">@currency($order->ongkir_price)</p>

              @if ($order->coupon != null) 
                @if ($order->coupon->value != null)
                <p class="ms-0 mt-2 text-danger" style="font-weight: 600">({{ $order->coupon->code }}) -@currency($order->coupon->value)</p>
                @else
                <p class="ms-0 mt-2 text-danger" style="font-weight: 600">({{ $order->coupon->code }}) -{{ $order->coupon->percent_off }}%</p>
                @endif
              @endif

            </div> --}}
            {{-- @endforeach --}}
          {{-- </div>
          <div class="total-biaya d-flex pt-3 pb-3" style="justify-content: space-between">
            <div class="total">
              <p class="m-0">Total Biaya Belanja</p>
            </div>
            <div class="biaya">
              @if ($order->coupon != null)
                @if ($order->coupon->value != null)
                <p class="m-0">@currency($order->total_price - $order->coupon->value)</p>
                @elseif ($order->coupon->percent_off != null)
                @php
                    $price_disc = ($order->coupon->percent_off / 100) * $order->total_price;
                @endphp   
                <p class="m-0">@currency($order->total_price - $price_disc)</p>   
                @endif
              @endif
            </div>
          </div> --}}
          {{-- <div class="account-pembayaran pt-4 pb-4">
            <b>Virtual Account BCA (Otomatis)</b>
          </div> --}}
          {{-- <div class="nomor-virtual d-flex" style="justify-content: space-between"> --}}
            {{-- <div class="nomor">
              <p class="m-0" style="font-size: 12px">Nomor Virtual Account</p>
              <b style="font-size: 14px">39176574267</b>
            </div>
            <div class="virtual">
              <b class="text-primary" style="font-size: 14px">Salin</b>
            </div>
          </div>
          <div class="total-belanja d-flex pt-3 pb-3" style="justify-content: space-between">
            <div class="totall">
              <p class="m-0" style="font-size: 12px">Total Biaya Belanja</p>
              <b class="text-primary" style="font-size: 14px">@currency($order->total_price)</b>
            </div>
            <div class="belanja">
              <b class="text-primary" style="font-size: 14px">Salin</b>
            </div> --}}
          {{-- </div>
          @if ($order->status == 'capture')

          @elseif($order->status == 'settlement')

          @else
          <span><b>Produk ini belum terbayar</b></span>
           <div class="btn btn-outline-primary rounded-pill pembayaran mt-2" style="width: 100%; font-family: 'Nunito', sans-serif">Lihat Cara Pembayaran</div>
          @endif 
        </div>
      </div>
    </div>
    
  </div> --}}


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    
<script>
  function completeOrder(id) {
    
    var order_id = $('#order_id').val();
    var dropdownElement = $("#dropdownElement")

    $.ajax({
      type: "POST",
      url: `/order/complete/${id}`,
      data: {
        id: id
      },
      // dataType: "dataType",
      success: function (response) {
        // $(`#${id}`).html(`Pesanan Selesai`);
        toastr.success('Berhasil menyelesaikan pesanan', 'Success !');
        window.location.href = "/order";
      }
    });
    
  }

  function deleteOrder(id) {
    $.ajax({
      type: "post",
      url: `/order/delete/${id}`,
      data: {
        id: id,
      },
      success: function (response) {
        toastr.warning('Berhasil menghapus pesanan', 'Success !');
        window.location.href = "/order";
        
      }
    });
  }
</script>

@endsection
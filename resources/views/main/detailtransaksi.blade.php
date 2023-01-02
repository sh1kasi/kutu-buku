@extends('layouts.main')

@section('title')
    {{ 'Detail Transaksi' }}
@endsection

@section('container')

{{-- Midtrans --}}
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-YtOg3gLwJxp89NO3">
</script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    
<div class="container" style="margin-top: 100px">
    <h4 class="text-detail-transaksi">Detail Transaksi</h4>
    <div class="d-flex">
      <div class="order-history-left" style="width: 60%">
        <div class="card counting-days text-center">
          @if ($order->status == 'capture')
           <p id="counting-days" class="text-primary pt-2" style="font-size: 24px">Produk Sudah Terbayar</p>  
           @elseif ($order->status == 'settlement')
           <p id="counting-days" class="text-primary pt-2" style="font-size: 24px">Produk Sudah Terbayar</p>
           @else  
           <p style="font-size: 20px; padding-top: 20px">Harap Bayar Sebelum</p>
           <p id="counting-days" class="text-primary" style="font-size: 24px">{{ $endtime }}</p>
          @endif
        </div>
        <div class="rincian-barang pt-3">
          <p>Rincian barang</p>
          <div class="card">
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
      </div>
      <div class="order-history-right">
        <div class="info-pemesanan">
          <b class="ps-5">Info Pemesanan</b>
          <div class="card ms-5 mt-3" style="width: 500px">
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
        <div class="rincian-pembayaran mt-3">
          <b class="ps-5">Rincian Pembayaran</b>
          <div class="card ms-5 mt-3" style="width: 500px">
            <div class="card-body">
              <div class="jumlah-harga pb-3 d-flex" style="justify-content: space-between">
                {{-- @foreach ($order->order_detail as $detail) --}}
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
                {{-- @endforeach --}}
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
              {{-- <div class="account-pembayaran pt-4 pb-4">
                <b>Virtual Account BCA (Otomatis)</b>
              </div> --}}
              <div class="nomor-virtual d-flex" style="justify-content: space-between">
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
              </div>
              @if ($order->status == 'capture')

              @elseif($order->status == 'settlement')

              @else
               <div class="btn btn-outline-primary rounded-pill pembayaran" style="width: 100%; font-family: 'Nunito', sans-serif">Lihat Cara Pembayaran</div>
              @endif 
            </div>
          </div>
        </div>
        <div class="rincian-pengiriman mt-3">
          <b class="ps-5">Rincian Pengiriman</b>
          <div class="card ms-5 mt-3" style="width: 500 px">
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
  </div>

  <form action="{{ route('payment') }}" id="submit_form" method="post">
    @csrf
    <input type="hidden" name="json" id="json_callback">
    <input type="hidden" name="total_price" id="payment_total_price">
    <input type="hidden" name="harga_ongkir" id="payment_harga_ongkir">
    <input type="hidden" name="nama_ongkir" id="payment_nama_ongkir">
    <input type="hidden" name="snaptoken" id="snaptoken">
    <input type="hidden" name="id_order" id="id_order">
  </form>

  <script>
    // Set the date we're counting down to
    // var countDownDate = new Date('Dec 21, 2022 11:35:00').getTime();

    // // Update the count down every 1 second
    // var x = setInterval(function () {
    //   // Get today's date and time
    //   var now = new Date().getTime();

    //   // Find the distance between now and the count down date
    //   var distance = countDownDate - now;

    //   // Time calculations for days, hours, minutes and second
    //   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    //   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    //   var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    //   // Output the result in an element with id="demo"
    //   document.getElementById('counting-days').innerHTML = hours + ' ' + ':' + ' ' + minutes + ' ' + ':' + ' ' + seconds;

    //   // If the count down is over, write some text
    //   if (distance < 0) {
    //     clearInterval(x);
    //     document.getElementById('counting-days').innerHTML = 'EXPIRED';
    //   }
    // }, 1000);

    function copyToClipboard(element) {
      var $temp = $('<input>');
      $('body').append($temp);
      $temp.val($(element).text()).select();
      document.execCommand('copy');
      $temp.remove();
    }

    $(".pembayaran").click(function (e) { 
      e.preventDefault();
      // window.location.href = '/buku/checkout';
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay("{{ $order->snaptoken }}", {
        onSuccess: function(result){
          /* You may add your own implementation here */
          console.log(result);
          send_response_to_for(result)
        },
        onPending: function(result){
          /* You may add your own implementation here */
          console.log(result);
          send_response_to_for(result)
        },
        onError: function(result){
          /* You may add your own implementation here */
          console.log(result);
          send_response_to_for(result)
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })  
      function send_response_to_for(result) {
        // var total_price = $("#harga_total").val();
        // var harga_ongkir = $("#harga_ongkir").val();
        // var nama_ongkir = $("#nama_ongkir").val();
        document.getElementById('json_callback').value = JSON.stringify(result);
        $("#submit_form").submit();
      }
      
    });

  </script>

@endsection
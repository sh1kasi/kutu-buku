@extends('layouts.main')

@section('title')
    {{ 'Riwayat Pembelian' }}
@endsection

@section('container')
    
     <!-- riwayat pembelian -->

    @if ($order->count() != 0)
    <div class="container" style="margin-top: 100px">
      <h4 class="text-riwayat-pembelian">Daftar Transaksi</h4>

      @foreach ($order as $data)
        <div class="card mb-3">
          <div class="card-header pt-3 pb-3 d-flex" style="font-size: 13px">
            <span class="pe-2 pt-2" style="border-right: 1px solid #dddcdc">{{ $data->created_at->format('Y-m-d H:i:s') }}</span>
            <span class="ps-2 pt-2">No. Pemesanan {{ $data->order_id }}</span>

            @if ($data->status == "settlement")
              <span class="ps-2 pt-1 alert alert-success status-pembayaran">
              Pembayaran Berhasil
              </span>
            @elseif ($data->status == "capture")  
              <span class="ps-2 pt-1 alert alert-success status-pembayaran">
              Pembayaran Berhasil
              </span>
            @elseif ($data->status == "completed")  
              <span class="ps-2 pt-1 alert alert-success status-pembayaran">
              Pesanan Selesai
              </span>
            @elseif ($data->status == "pending")  
              <span class="ps-2 pt-1 alert alert-warning"  style="margin-left: 10px;font-family: 'Nunito', sans-serif;font-weight: 600;height: 30px;">
              Menunggu Pembayaran
              </span>
            @else
              <span class="ps-1 pt-1 alert alert-danger status-pembayaran">
              Pesanan Dibatalkan
              </span>
            @endif

            
          </div>
          {{-- @foreach ($data->order_detail as $item) --}}
              {{-- @foreach ($buku_array as $item)   
                <div class="card-body d-flex">
                  <img src="{{ asset('coverimage') }}/{{ $item->cover }}" alt="buku1" style="width: 60px; height: 90px" />
                  <div class="text-pembelian ps-3">
                    <span style="font-size: 14px">{{ $item->title }}</span><br/>
                    <span class="text-muted" style="font-size: 12px">1 barang</span>
                  </div>
                </div>
              @endforeach --}}
            <div class="card-footer d-flex" style="justify-content: space-between; font-size: 14px; font-family: 'Nunito', sans-serif">
              <a href="/buku/detail-transaksi/{{ $data->id }}" class="pt-2 text-decoration-none" style="font-weight: 600">Lihat Detail Pesanan</a>
              <p class="pt-2">Total Pesanan :  <b>{{ $data->order_detail->qty }} Produk</b></p>
            </div>
            @if ($data->status == 'pending')
            <div class="card-footer d-flex" style="justify-content: space-between; font-size: 14px;">
              <p class="pt-3" style="font-family: 'Nunito', sans-serif">Metode Pembayaran: <b>Virtul Account BCA (Otomatis)</b></p>
              <a href="/buku/detail-transaksi/{{ $data->id }}" type="button" class="btn btn-primary" style="padding-top: 15px;">Bayar Sekarang</a>
            </div>
            @endif
          {{-- @endforeach --}}
        </div>
      @endforeach
    </div>
    @else
      <script>
        window.location.href = "http://project-book.test/buku";
      </script>
    @endif

     
  
      <!--  tutup riwayat pembelian -->

@endsection
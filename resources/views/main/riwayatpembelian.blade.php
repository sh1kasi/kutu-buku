@extends('layouts.main')

@section('container')
    
     <!-- riwayat pembelian -->
     <div class="container" style="margin-top: 100px">
        <h4 class="text-riwayat-pembelian">Daftar Transaksi</h4>
  
        <div class="card">
          <div class="card-header pt-3 pb-3 d-flex" style="font-size: 13px">
            <span class="pe-2 pt-2" style="border-right: 1px solid #dddcdc">20 Desember 2022, 11:35:45</span>
            <span class="ps-2 pt-2">No. Pemesanan FL2022FGGTOH75</span>
            <span class="ps-2 pt-2 status-pembayaran text-muted">Menunggu Pembayaran</span>
          </div>
          <div class="card-body d-flex">
            <img src="{{ asset('custom/image/book1.jpg') }}" alt="buku1" style="width: 60px; height: 90px" />
            <div class="text-pembelian ps-3">
              <span style="font-size: 14px">Love from A to Z</span><br />
              <span class="text-muted" style="font-size: 12px">1 barang</span>
            </div>
          </div>
          <div class="card-footer d-flex" style="justify-content: space-between; font-size: 14px; font-family: 'Nunito', sans-serif">
            <a href="detailtransaksi.html" class="pt-2 text-decoration-none" style="font-weight: 600">Lihat Detail Pesanan</a>
            <p class="pt-2">Total Pesanan <b>Rp 130.000</b></p>
          </div>
          <div class="card-footer d-flex" style="justify-content: space-between; font-size: 14px">
            <p class="pt-3" style="font-family: 'Nunito', sans-serif">Metode Pembayaran: <b>Virtul Account BCA (Otomatis)</b></p>
            <button type="button" class="btn btn-primary">Bayar Sekarang</button>
          </div>
        </div>
      </div>
  
      <!--  tutup riwayat pembelian -->

@endsection
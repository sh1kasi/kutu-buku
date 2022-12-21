@extends('layouts.main')

@section('container')

{{-- Midtrans --}}
<!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-YtOg3gLwJxp89NO3">
</script>
<!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->


<h4 class="title-checkout" style="padding-top: 100px; padding-left: 50px">Checkout</h4>
<div class="alamat">
    <div class="d-flex">
        <div class="card shadow-sm" style="width: 725px">
            <div class="card-body">
                @if ($delivery === null)
                <div class="ubah-alamat"></div>
                <div class="label-alamat"></div>
                <div class="name-calling"></div>
                <div class="full-address"></div>
                <p class="text-alamat alamat-judul text-muted p-3"><i class="bi bi-geo-alt-fill me-1"></i>Alamat Tujuan
                    Pengiriman</p>
                <p class="ps-3 alamat-gaada" style="font-size: 14px">Belum ada alamat yang terdaftar</p>
                <div class="btn-alamat">
                    <button type="button" class="btn btn-outline-primary buat rounded" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="bi bi-plus-lg"></i>
                        Buat Alamat Pengiriman</button>
                    <button type="button" class="btn btn-primary ngirim" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop"><i class="bi bi-truck pe-2"></i>Opsi Pengiriman</button>
                </div>
                @else
                <div class="d-flex" style="justify-content: space-between">
                    <b class="text-alamat text-muted p-3"><i class="bi bi-geo-alt-fill me-1"></i>Alamat Tujuan
                        Pengiriman</b>
                    <a type="button" class="text-alamat p-3" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        style="text-decoration: none">Ubah Alamat</a>
                </div>
                <b class="ps-3" style="font-size: 15px">{{ $delivery->label_address }}</b>
                <div class="ps-3 name-calling d-flex"
                    style="font-size: 14px; font-family: 'Nunito', sans-serif; padding-top: 10px">
                    <p class="pe-2" style="border-right: 1px solid #000000">{{ $delivery->receiver }}</p>
                    <p class="ps-2">+62{{ $delivery->phone }}</p>
                </div>
                <div class="placement ps-3" style="font-size: 14px; font-family: 'Nunito', sans-serif">
                    <p>{{ $delivery->address }}, {{ $delivery->district->name }}, {{ $delivery->regency->name }},
                        {{ $delivery->province->name }}.</p>
                </div>
                @endif


            </div>
        </div>
        @include('main.modal.alamatCheckout')





        <div class="metode-pembayaran ms-3">
            <div class="card shadow-sm" style="width: 500px; height: 225px">
                <div class="card-body">
                    <div class="judul-pengiriman d-flex justify-content-between">
                        <p class="text-metode p-3">Metode Pengiriman</p>
                        <p type="button" class="text-primary text-metode ubah p-3" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop"></p>
                    </div>
                    <div class="pengiriman d-flex justify-content-between" style="font-family: 'Nunito', sans-serif">
                        <p class="p-3 nama_ongkir"></p>
                        <p class="p-3 harga_ongkir"></p>
                    </div>
                    <div class="opsi-pengiriman ps-3 pe-3">
                        <button type="button" class="btn btn-primary w-100 rounded-pill opsi" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop"><i class="bi bi-truck pe-2"></i>Opsi
                            Pengiriman</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pesanan-checkout d-flex" style="padding-top: 20px">
        <div class="card cart shadow-sm p-3 bg-body rounded" style="width: 725px">
            <div class="img-deskripsi">
                <div class="card-body">
                    <a style="font-family: 'Nunito', sans-serif; font-weight: 600; color: #5a5a5a">Pesanan 1</a>
                </div>
                @php
                $total = 0;
                $total_weight = 0;
                @endphp
                @foreach ($cart as $data)
                <div class="img-pesanan"
                    style="padding-bottom: 10px; padding-top: 10px; border-bottom: 1px solid #c1c1c1;">
                    <div class="d-flex" style="justify-content: space-between;">
                        <div class="image-title d-flex">
                            @php
                                $total_weight += $data->book->weight;      
                            @endphp         
                            <img src="{{ asset('coverimage') }}/{{ $data->book->cover }}" alt=""
                                style="width: 85px; height: 130px; padding-left: 20px; padding-bottom: 30px" />
                            <div class="text" style="max-width: 190px">
                                <p class="title-pesanan ms-1" style="font-size: 16px">{{ $data->book->title }}</p>
                                <p class="title-pesanan ms-1 text-muted" style="font-size: 11px">{{ $data->book_qty }} Barang ({{ $total_weight }} gr)</p>
                                <b class="price ms-1" style="font-size: 16px">@currency($data->book->price)</b>
                            </div>
                        </div>
                        <div class="price-total" style="padding-top: 13px; padding-left: 90px">
                            <p style="font-size: 14px; color: #0060ae"><b>@currency($data->book->price *
                                    $data->book_qty)</b></p>
                            <a style="font-size: 14px"><i class="bi bi-trash3 ms-1"></i>Hapus</a>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $data->book->id }}" class="book_id">
                    {{-- <div class="quantity d-flex product_qty">
                        <div class="minus" style="font-size: 20px; padding-left: 60px; padding-top: 20px">
                            <button id="minus" class="decrement-btn change"
                                style="border-bottom: 1px solid; padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i
                                    class="bi bi-dash-circle"></i></button>
                        </div>
                        <div class="input" style="padding-top: 20px">
                            <input id="input" class="input-qty" type="number" value="{{ $data->book_qty }}"
                                style="padding-top: 3px; padding: left 8px; padding-bottom: 10px; background-color: transparent; border: none; width: 40px" />
                        </div>
                        <div class="plus" style="font-size: 20px; padding-top: 20px">
                            <button id="plus" class="increment-btn change"
                                style="padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i
                                    class="bi bi-plus-circle"></i></button>
                        </div>
                    </div> --}}
                    
                </div>

                @php
                $total += $data->book->price * $data->book_qty;
                $total_weight += $data->book->weight;
                @endphp
                <input type="hidden" name="weight" value="{{ $total_weight }}">
                {{-- @dump($total_weight) --}}
                @endforeach
                {{-- <div class="img-pesanan d-flex" style="padding-top: 40px; padding-bottom: 50px; justify-content: space-between">
              <img src="assets/image/book1.jpg" alt="" style="width: 85px; height: 130px; padding-left: 20px; padding-bottom: 30px" />
              <div class="text">
                <p class="title-pesanan ms-1">Love From A to Z</p>
                <b class="price ms-1">Rp 93.000</b>
              </div>
              <div class="quantity d-flex">
                <div class="minus" style="font-size: 20px; padding-left: 60px; padding-top: 20px">
                  <button id="minus2" style="border-bottom: 1px solid; padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i class="bi bi-dash-circle"></i></button>
                </div>
                <div class="input" style="padding-top: 20px">
                  <input id="input2" type="number" style="padding-top: 3px; padding: left 8px; padding-bottom: 10px; background-color: transparent; border: none; width: 40px" />
                </div>
                <div class="plus" style="font-size: 20px; padding-top: 20px">
                  <button id="plus2" style="padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i class="bi bi-plus-circle"></i></button>
                </div>
              </div>
              <div class="price-total" style="padding-top: 13px; padding-left: 90px">
                <p style="font-size: 14px; color: #0060ae"><b>Rp 93.000</b></p>
                <a style="font-size: 14px"><i class="bi bi-trash3 ms-1"></i>Hapus</a>
              </div>
            </div> --}}
            </div>
            <div class="total-pesanan d-flex"
                style="padding-top: 10px; border-top: 1px solid #6e6e6e; justify-content: space-between">
                <p>Total Pesanan <b>1</b></p>
                <p><b>@currency($total)</b></p>
            </div>
        </div>
        <div class="detail-pesanan ms-3">
            <div class="card shadow-sm p-3 bg-body rounded" style="width: 500px">
                <h2 class="title-detail">Rincian Belanja</h2>
                <!-- <div class="kode-promo d-flex p-3" style="justify-content: space-between">
              <p>Masukkan Kode Promo?</p>
              <a href="#" style="text-decoration: none">Lihat promo</a>
            </div>
            <div class="input-group mb-3 px-3">
              <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" />
              <span class="input-group-text text-muted" id="inputGroup-sizing-default" style="font-size: 14px">Gunakan</span>
            </div> -->
                <div class="total-biaya px-3 pt-5">
                    <p>Total Biaya Belanja</p>
                </div>
                <div class="total-belanja d-flex px-3" style="justify-content: space-between">
                    <p>Total Belanja</p>
                    <b>@currency($total)</b>
                    <input type="hidden" id="" name="total" value="{{ $total }}">
                </div>
                <div class="biaya-pengiriman d-flex px-3" style="justify-content: space-between">
                    @php $ongkir = 0; @endphp
                    <p>Biaya Pengiriman</p>
                    <b id="pengiriman">@currency($ongkir)</b>
                </div>
                <div class="seluruh-total d-flex px-3 pt-3" style="justify-content: space-between">
                    <b>Total</b>
                    <b id="total" style="color: #0060ae">@currency($total + $ongkir)</b>
                </div>
                <div class="bayar-pesanan" style="margin: 20px 20px 0px 20px">
                    <button type="button" class="btn btn-outline-primary rounded-pill w-100 payment"
                        id="pay-button">Bayar Sekarang</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('main.modal.opsiPengiriman')

{{-- {{ session()->get('snapToken') }} --}}
{{-- @dump($snapToken); --}}

<script>
    $(".increment-btn").click(function (e) {
        e.preventDefault();

        var inc_value = $(this).closest(".product_qty").find('.input-qty').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;

        if (value < 10) {
            value++;
            $(this).closest(".product_qty").find('.input-qty').val(value);
        }

    });

    $(".decrement-btn").click(function (e) {
        e.preventDefault();

        var dec_value = $(this).closest(".product_qty").find('.input-qty').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).closest(".product_qty").find('.input-qty').val(value);
        }

    });

    $(".change").click(function (e) {
        e.preventDefault();
        var book_id = $(this).closest('.product_qty').find('.book_id').val();
        // alert(book_id);
        var book_qty = $(this).closest('.product_qty').find('.input-qty').val();


        var data = {
            'book_id': book_id,
            'book_qty': book_qty,
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/checkout-update",
            data: data,
            success: function (response) {
                window.location.reload();
            }
        });

    });

</script>


@endsection

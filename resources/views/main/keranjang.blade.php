@extends('layouts.main')

@section('title') {{ "Keranjang" }} @endsection

@section('container')



{{-- @dump($cartitems->count()) --}}



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <form>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input style="border: none; border-bottom: 1px solid" type="email" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" />
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input style="border: none; border-bottom: 1px solid" type="password" class="form-control"
                        id="myInputPw" />
                </div>
                <input type="checkbox" onclick="myFunction()" />Show Password
                <div class="mb-3 text-center">
                    <a href="#">Lupa Kata Sandi</a>
                </div>
                <button type="submit" class="btn btn-primary w-100 text-center">Masuk</button>
                <div class="mb-3 mt-3">
                    <p class="text-center">Belum mendaftar? <a href="daftar.html">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($cartitems->count() == '0')
<div class="keranjang-kosong container" style="margin-top: 100px; padding-top: 50px; padding-bottom: 100px">
    <div class="empty-cart" style="display: flex; justify-content: center">
        <img src="{{ asset('custom/image/empty-cart.png') }}" alt="empty cart" />
        <div class="isi-empty-cart" style="padding-left: 20px">
            <div class="title-empty-cart" style="padding-top: 70px; padding-bottom: 10px">
                <b style="font-size: 25px; font-family: 'Nunito', sans-serif">Tas Belanja Kamu Berdebu!</b>
            </div>
            <div class="text-empty-cart" style="padding-bottom: 10px">
                <p class="text-muted" style="font-family: 'Nunito', sans-serif">
                    Tas belanja kamu masih kosong lho! <br />
                    Mulai belanja sekarang dan dapatkan barang yang <br />
                    kamu inginkan hanya di Gramedia.
                </p>
            </div>
            <div class="mulai-belanja" style="font-family: 'Nunito',sans-serif;">
                <a href="{{ route('view.index') }}"><button class="btn w-100 text-light btn-primary" type="button">Mulai
                        Belanja</button></a>
            </div>
        </div>
    </div>
</div>
@else
<div class="container">
    <h4 class="text-keranjang">Keranjang</h4>
</div>
<div class="">
    <div class="delete-keranjang" style="padding-left: 115px; padding-bottom: 20px">
        <div class="cart card card-body shadow-sm d-flex bg-body rounded">
            {{-- <div class="beberapa mr-auto p-2">
                <a href="#" class="card-link beberapa"
                style="text-decoration: none; color: #000; font-family: 'Nunito', sans-serif; padding-right: 50px; font-weight: 600; font-size: 14px">Hapus
                beberapa</a>
            </div>
            <div class="checkbox p-2" style="margin-right: 420px">
                <input class="checkbox mt-3" type="checkbox" name="" id="">
            </div> --}}
            <div class="d-flex">
                <div class="mr-auto me-1">
                    <input class="checkboxAll mt-4 chkbox d-none" id="cb-all" type="checkbox" name="">
                </div>
                <div class="mt-3  delete-multiple" style="padding-left: 400px; margin-left: 70px">
                    <a href="#" class="card-link beberapa" onclick="multipleSelect()"
                        style="text-decoration: none; color: #000; font-family: 'Nunito', sans-serif; padding-right: 50px; font-weight: 600; font-size: 14px">Hapus
                        beberapa
                    </a>
                </div>
                {{-- <div class="mt-2 class" hidden id="delete-button" style="padding-left: 350px">
                    <div class="mt-2 ms-5 btn btn-light border btn-sm" id="deleteAllRecords">Hapus</div>
                    <div class="mt-2 ms-1 btn btn-primary btn-sm" onclick="dismissMultipleSelect()" id="dismissMultipleSelect">Batalkan</div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="pesanan d-flex" style="padding-bottom: 100px; border-bottom: 1px solid #a5a5a5">
    <div class="card cart shadow-sm p-3 bg-body rounded">
        <div class="img-deskripsi">
            @php $total = 0; @endphp
            @php
            $total_qty = 0;
            @endphp
            @foreach ($cartitems as $data)
            {{-- @foreach ($item->book as $data) --}}
            {{-- @dd($item->book_id) --}}
            <div class="card-body">
                <a style="font-family: 'Nunito', sans-serif; font-weight: 600; color: #5a5a5a">Pesanan
                    {{ $loop->iteration }}</a>
            </div>
            <div class="img-pesanan book_data d-flex" style="padding-bottom: 10px; border-bottom: 1px solid #c1c1c1">
                <input type="checkbox" class="checkbox_book chkbox d-none" onclick="onSelect({{ $data->book_id }})"
                    id="checkbox_book" style="margin-bottom: 110px" value="{{ $data->book->id }}" name="ids">
                <img src="{{ asset('coverimage') }}/{{ $data->book->cover }}" alt=""
                    style="width: 85px; height: 130px; padding-left: 20px; padding-bottom: 30px" />
                <div class="text" style="max-width: 190px">
                    <p class="title-pesanan ms-1">{{ $data->book->title }}</p>
                    <b class="price ms-1">@currency($data->book->price)</b>
                </div>
                <input type="hidden" id="price" value="{{ $data->book->price }}">
                <input type="hidden" value="{{ $data->book->id }}" class="book_id">
                @php
                $book_id = $data->book->id;
                $cart_id = $data->id;
                @endphp
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
                <div class="price-total" style="padding-top: 13px; padding-left: 90px">
                    <p style="font-size: 14px; color: #0060ae"><b id="total1">@currency($data->book->price * $data->book_qty)</b>
                    </p>
                    <button class="btn delete-item" type="button" onclick="delete_cart({{ $data->book->id }})"
                        style="font-size: 14px"><i class="bi bi-trash3 ms-1"></i>Hapus</button>
                </div>
            </div>
            @php
            $total += $data->book->price * $data->book_qty;
            $total_qty += $data->book_qty;
            @endphp
            {{-- @endforeach --}}

            @endforeach
        </div>


        {{-- <div class="card-body">
            <a style="font-family: 'Nunito', sans-serif; font-weight: 600; color: #5a5a5a">Pesanan 2</a>
        </div>
        <div class="img-pesanan d-flex" style="padding-top: 40px">
          <img src="{{ asset('custom') }}/image/book1.jpg" alt="" style="width: 85px; height: 130px; padding-left:
        20px; padding-bottom: 30px" />
        <div class="text">
            <p class="title-pesanan ms-1">Love From A to Z</p>
            <b class="price ms-1">Rp 93.000</b>
        </div>
        <div class="minus2" style="font-size: 20px; padding-left: 60px; padding-top: 20px">
            <button id="minus2"
                style="border-bottom: 1px solid; padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i
                    class="bi bi-dash-circle"></i></button>
        </div>
        <div class="input2" style="padding-top: 20px">
            <input id="input2" type="number"
                style="padding-top: 3px; padding: left 8px; padding-bottom: 10px; background-color: transparent; border: none; width: 40px" />
        </div>
        <div class="plus2" style="font-size: 20px; padding-top: 20px">
            <button id="plus2"
                style="padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i
                    class="bi bi-plus-circle"></i></button>
        </div>
        <div class="price-total" style="padding-top: 13px; padding-left: 90px">
            <p style="font-size: 14px; color: #0060ae"><b>Rp 93.000</b></p>
            <a style="font-size: 14px"><i class="bi bi-trash3 ms-1"></i>Hapus</a>
        </div>
    </div> --}}




    <div class="total-pesanan d-flex"
        style="padding-top: 10px; border-top: 1px solid #6e6e6e; justify-content: space-between">

        <p>Total Pesanan <b>{{ $total_qty }}</b></p>
        <p><b id="total2">@currency($total
        )</b></p>
    </div>
</div>
<div class="detail-pesanan ms-3">
    <div class="card shadow-sm p-3 bg-body rounded" style="width: 500px">
        <h2 class="title-detail">Rincian Belanja</h2>
        <div class="harga d-flex" style="justify-content: space-between">
            <p class="text-detail"><b>Total Biaya Belanja</b></p>
            <p class="harga-detail" id="total3">Rp {{ $total }}</p>
        </div>
        <div class="btn-detail" style="padding-top: 30px">
            <form action="{{ route('cartCheckout') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="cart_id" value="{{ $cart_id }}">
                <input type="hidden" name="book_id" id="book_id" value="{{ $book_id }}">
                <input type="hidden" name="subtotal" value="{{ $total }}">
                <button class="rounded-pill btn btn-primary w-100" type="submit">Lanjut ke Halaman Checkout</button>
            </form>
        </div>
    </div>
</div>
</div>

@endif

<script>

    function multipleSelect() {
        var button = $('#delete-button').html();
        $(".delete-multiple").attr('style', 'padding-left: 350px');
        $(".delete-multiple").html(`<div class="mt-2 ms-5 btn btn-light border btn-sm" id="deleteAllRecords">Hapus</div>
                                    <div class="mt-2 ms-1 btn btn-primary btn-sm" onclick="dismissMultipleSelect()" id="dismissMultipleSelect">Batalkan</div>
                                    `);
        $(".chkbox").removeClass('d-none');

        
     }

    function dismissMultipleSelect() {
        $(".delete-multiple").attr('style', 'padding-left: 400px; margin-left: 70px');
        $(".delete-multiple").html(`<a href="#" class="card-link beberapa"
                                        onclick="multipleSelect()" style="text-decoration: none; color: #000; font-family: 'Nunito', sans-serif; padding-right: 50px; font-weight: 600; font-size: 14px">Hapus
                                        beberapa
                                    </a>`);
        $(".chkbox").addClass('d-none');
    }

    var selectedId = [];
    function onSelect(id) {
        $("#deleteAllRecords").click(function (e) {
            e.preventDefault();
            
            
            var val = $(this).val();
            
            $(`input:checkbox[value=${id}]`).each(function () {
                selectedId.push($(this).val());
            });
            
            if (selectedId.length > 0) {     
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type: "DELETE",
                    url: "/cart/massdelete",
                    data: {
                        selectedId: selectedId
                    },
                    dataType: "dataType",
                    success: function (response) {
                        document.location.reload(true);
                    }
                });

            } else {
                alert('pilih minimal 1 produk untuk dihapus');
            }

        })
    }


    



    $(document).ready(function () {


        var selectedId = [];
        $(document).on('click', '#cb-all', function () {
            $(".checkbox_book").prop('checked', $(this).prop('checked'));
            
            $("#deleteAllRecords").click(function (e) {
                e.preventDefault();
                
                var val = $(this).val();

                $(`input:checkbox[name=ids]`).each(function () {
                    selectedId.push($(this).val());
                });

                if (selectedId.length > 0) {

                    $.ajaxSetup({
                        headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                $.ajax({
                    type: "DELETE",
                    url: "/cart/massdelete",
                    data: {
                        selectedId: selectedId
                    },
                    dataType: "dataType",
                    success: function (response) {
                        document.location.reload(true);
                    }
                }); 
                                   
                } else {
                    alert('Pilih minimal 1 produk untuk dihapus')
                }


            });

        });

    });



    // if ('#book_delete:checked') {
    //     alert('ke-ceklis');
    // } else {
    //     alert('ga ke-ceklis');
    // }

    // $(document).on('click', '#checkbox_book', function () {
    //     var selectedId = [];

    //     $("#deleteAllRecords").click(function (e) { 
    //         e.preventDefault();
    //         selectedId.push($("#checkbox_book:selected").val());
    //         console.log(selectedId);
    //     });

    // });
    //     var id = [];


    //     $.each("#book_delete:checked", function () { 
    //          id.push($(this).val());
    //         });

    //     if (id.length > 0) {
    //         $.ajax({
    //             type: "get",
    //             url: "url",
    //             data: {
    //                 id: id
    //             },
    //             success: function (response) {

    //             }
    //         });
    //     } else {
    //         alert("Pilih minimal 1 item untuk dihapus");
    //     }

    //     console.log('ke click');
    // });

    // $("#book_delete").click(function (e) { 
    //         e.preventDefault();


    //     });

    $(".increment-btn").click(function (e) {
        e.preventDefault();

        var inc_value = $(this).closest('.book_data').find('.input-qty').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.book_data').find('.input-qty').val(value);
        }
    });

    $(".decrement-btn").click(function (e) {
        e.preventDefault();

        var dec_value = $(this).closest('.book_data').find('.input-qty').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.book_data').find('.input-qty').val(value);
        }
    });

    $(".change").click(function (e) {
        e.preventDefault();

        var book_id = $(this).closest('.book_data').find('.book_id').val();
        var book_qty = $(this).closest('.book_data').find('.input-qty').val();
        var price = $(this).closest('.book_data').find('#price').val()
        var total_price = price * book_qty;

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
            url: "/cart-update",
            data: data,
            success: function (response) {
                window.location.reload();
                // console.log(total_price);
                // $(this).closest('.book_data').find('#total1').html(`Rp ${total_price}`);
                // $(this).closest('.book_data').find('#total2').html(`Rp ${total_price}`);
                // $(this).closest('.book_data').find('#total3').html(`Rp ${total_price}`);
                // $("#total2").html(`Rp ${total_price}`);
                // $("#total3").html(`Rp ${total_price}`);
            }
        });

    });



    function delete_cart(id) {



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/delete-item",
            data: {
                'book_id': id,
            },
            success: function (response) {
                window.location.reload()
                swal("", response.status, 'success');
            }
        });

    }

    // function checked_box(id){

    //     var id_book = $('.checkbox_book').val();
    //     var book_id = [];


    //     $("#hapus").click(function (e) { 
    //         e.preventDefault();

    //         $.each(id_book, function (indexInArray, valueOfElement) { 

    //         });

    //         if("#checkbox_book:checked") {
    //             console.log(book_id);
    //         } else {
    //             console.log('b');
    //         }
    //     });


    // }


    // $(".checkbox_book").click(function (e) { 
    //     e.preventDefault();

    //     book_id = $(this).val();
    //     id = [];



    //     if ("#checkbox_book:checked") {
    //         $("#hapus").click(function (e) { 
    //             e.preventDefault();

    //             id.push(book_id);
    //             if (id.length > 0) {

    //                 $.ajax({
    //                     type: "get",
    //                     url: "/cart/massdelete",
    //                     data: {
    //                         id: id
    //                     },
    //                     dataType: "dataType",
    //                     success: function (response) {

    //                     }
    //                 });

    //             } else {
    //                 alert('Pilih minimal 1 produk untuk dihapus!');
    //             }


    //             // console.log(book_id);        
    //         });

    //     }

    //     console.log(book_id);

    // });

</script>

@endsection

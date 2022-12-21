@extends('layouts.main')

@section('container')
    
  <link rel="stylesheet" href="{{ asset('custom') }}/css/style.css">

          <!-- account -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content p-3">
                <form action="{{ route('login.store') }}" method="post" >
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input style="border: none; border-bottom: 1px solid" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input style="border: none; border-bottom: 1px solid" name="password" type="password" class="form-control" id="exampleInputPassword1" />
                  </div>
                  <div class="mb-3 text-center">
                    <a href="#">Lupa Kata Sandi</a>
                  </div>
                  <button type="submit" class="btn btn-secondary w-100 text-center">Masuk</button>
                  <div class="mb-3 mt-3">
                    <p class="text-center">Belum mendaftar? <a href="{{ url('buku/register') }}">Daftar</a></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
  
  <!-- tutup account -->

    <!-- isi-buku1 -->
    <div class="buku1 row row-cols-1 row-cols-md-3 g-1">
      <div class="col-1" style="padding-top: 120px; padding-left: 0px">
        <div class="card shadow-sm p-3 mb-5 bg-light rounded" style="width: 215px">
          <img src="{{ asset("coverimage") }}/{{ $b->cover }}" style="height: 320px; width: 180px" alt="..." />
        </div>
      </div>
          <div class="col judul" style="padding-top: 125px; padding-left: 30px">
        <p class="author-buku1">{{ $b->author->name ?? '-' }}</p>
        <p class="judul-buku1" id="desk">{{ $b->title }}</p>
        <div class="daftar-format d-flex" style="justify: space-betwwen; font-size: 15px">
          <div class="deskripsi">
            <a href="#desk" class="link"><p>Deskripsi Buku</p></a>
          </div>
          <div class="detail ms-2">
            <a href="#detail" class="link"><p style="font-size: 15px">Detail Buku</p></a>
          </div>
        </div>
        <div class="desc pt-3">
          <h6><b>Deskripsi Buku</b></h6>
          <p id="detail" class="isi-desc" style="font-size: 14px">{{ $b->description }}</p>
        </div>
        <div class="detail d-flex" style="justify-content: space-between">
          <div class="detail1">
            <h6><b>Detail</b></h6>
            <span><b>Jumlah Halaman</b></span>
            <p>{{ $b->page }}</p>
            <span><b>Tanggal Terbit</b></span>
            <p>14 Jun 2022</p>
            {{-- <span><b>ISBN</b></span>
            <p>9786232791244</p> --}}
            <span><b>Bahasa</b></span>
            <p>{{ $b->language }}</p>
          </div>
          <div class="detail2" style="padding-top: 25px; padding-bottom: 20px">
            <span><b>Penerbit</b></span>
            <p class="text-primary">{{ $b->publisher->name }}</p>
            <span><b>Berat</b></span>
            <p>{{ $b->weight }}</p>
            <span><b>Lebar</b></span>
            <p>{{ $b->width }}</p>
            <span><b>Panjang</b></span>
            <p>{{ $b->length }}</p>
          </div>
        </div>
      </div>
      <div class="col pembayaran" style="padding-top: 105px; width: 18rem; height: 100px">
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">Ingin beli berapa?</h6>
          <input type="hidden" value="{{ $b->id }}" class="book_id">
          <p class="card-text" style="font-weight: 500">Jumlah Barang</p>
          <div class="quantity d-flex" style="border-bottom: 1px solid rgb(214, 214, 214)">
            <div class="minus" style="font-size: 20px">
              <button id="minus" class="decrement-btn" style="border-bottom: 1px solid; padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i class="bi bi-dash-circle"></i></button>
            </div>
            <div class="input">
              <input id="book_qty" class="qty-input" class="qty_input" value="1" type="number" style="padding-top: 3px; padding-right: none; padding-left 8px; background-color: transparent; padding-bottom: 10px; width: 55px" />
            </div>
            <div class="plus" style="font-size: 20px">
              <button id="plus" class="increment-btn" style="padding-bottom: 10px; border: none; background-color: transparent; color: #0060ae"><i class="bi bi-plus-circle"></i></button>
            </div>
          </div>
          <div class="subtotal pt-3" style="color: #6d6d6d">
            <h6>Subtotal</h6>
            <div class="harga">
              <p style="color: #0060ae"><b class="total">Rp {{ $b->price }}</b></p>
            </div>
            <input type="hidden" name="subtotal" id="subtotal" value="{{ $b->price }}">
          </div>
          <div class="row row-cols-1 row-cols-md-3 g-5">
            <div class="col keranjang">
              <button type="button" id="addCart" class="btn btn-outline-primary" style="width: 140px; height: 45px"><i class="bi bi-basket2 me-2"></i>Keranjang</button>
            </div>
            <div class="col beli-sekarang">
              <button class="btn btn-primary rounded" id="buyNow" type="button" style="width: 140px; height: 45px">Beli Sekarang</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  @include('main.modal.Addcart')    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function () {
        $(".increment-btn").click(function (e) { 
          e.preventDefault();
          
          var inc_value = $('.qty-input').val();
          var value = parseInt(inc_value, 10);
          var subtotal = $("#subtotal").val();

          value = isNaN(value) ? 0 : value;
          if (value < 10) {
            value++;
            $('.qty-input').val(value);
          }

          var item_total = value * subtotal;
          $(".total").html(`Rp ${item_total}`);
          $("#total_item").html(`Rp ${item_total}`);

        });

        $(".decrement-btn").click(function (e) { 
          e.preventDefault();

          var dec_value = $('.qty-input').val();
          var value = parseInt(dec_value, 10);
          var subtotal = $("#subtotal").val();

          value = isNaN(value) ? 0 : value;
          if (value > 1) {
            value--;
            $('.qty-input').val(value);
          }
          var item_total = value * subtotal;
          $(".total").html(`Rp ${item_total}`);
          $("#total_item").html(`Rp ${item_total}`);
        
        });

      });

      $(document).ready(function () {



        $("#addCart").click(function (e) { 
          e.preventDefault();

          var book_id = $(this).closest(".buku1").find(".book_id").val();
          var book_qty = $(this).closest(".buku1").find(".qty-input").val();
          
          $.ajaxSetup({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             statusCode: {
              401: function(){
                $('#exampleModal').modal('show');
              }
             }
          });

          $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
              'book_id': book_id,
              'book_qty': book_qty,
            },
            success: function (response) {
              console.log(response);
              if (response.status == 201) {
                // alert('buku telah ditambahkan!');
                $('#cartModal').modal('show')  
              } else if (response.status == 200) {
                // alert(`${response.message}`)
                  $('#cartModal').modal('show')  
              } else {
                alert('login o dulu!');
              }
            }
          });

        });
      });

    </script>

@endsection
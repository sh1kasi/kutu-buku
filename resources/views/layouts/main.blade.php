<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <!-- my css -->
    <link rel="stylesheet" href="{{ asset('custom/css/style.css') }}" />

    <!-- my js -->
    <link rel="stylesheet" href="{{ asset('custom/js/script.js') }}" />

    <title>Halaman Utama | Kutu Buku</title>
  </head>
  <body>
    <img class="wa-icon fixed-bottom" src="{{ asset('custom/image/icon-wa-removebg-preview (1).png') }}" alt="" />
    <!-- navbar -->
    <nav class="row navbar-light shadow mb-5 bg-body rounded fixed-top">
      <div class="col-md-3" style="padding-top: 15px; padding-bottom: 15px">
        <a class="merk navbar-brand" href="#">
          <i class="icon-buku bi bi-book d-inline-block align-text-top ms-5">KUTU BUKU</i>
        </a>
      </div>
      <div class="col-md-2" style="padding-top: 15px">
        <!-- <button class="btn-kategori dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Kategori</button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul> -->
        <button class="btn-kategori" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Kategori <i class="bi bi-chevron-down"></i></button>
        <div class="collapse" id="collapseExample">
          <div class="container">
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis eius, exercitationem cumque dignissimos explicabo iusto saepe provident iure quam porro placeat veniam deserunt nostrum ea expedita, corrupti, molestias
            necessitatibus nesciunt?
          </div>
        </div>
      </div>
      <div class="col-md-5" style="padding-top: 15px">
        <form class="form-search">
          <input class="searching form-control me-2" type="search" placeholder="Cari Produk, Judul Buku, Penulis" aria-label="Search" />
        </form>
      </div>
      
      @auth
      {{-- <div class="col-md-1 mt-2" style="padding-top: 15px"> --}}
        <div class="dropdown col-md-1" style="padding-top: 15px">
          <a class="dropdown" id="dropdownMenuButton1" data-bs-toggle="dropdown"> <i class="akun bi bi-person-circle"></i> </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1" style="border-radius: 10px">
            <li class="dropdown-item disabled text-dark"><strong style="font-size: 22px">Hi, {{ auth()->user()->name }}</strong></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <div class="dropdown-divider"></div>

            @if (auth()->user()->is_admin == 1)
                <a class="dropdown-item" href="{{ route('category.index') }}">Admin Panel</a>
            @endif

            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i data-feather="log-out"></i>Keluar</a>                             
          </ul>
        </div>
        @else
         <div class="col-md-1" style="padding-top: 25px">
            <a href="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" style="color: #155183; text-decoration:none; font-size:18px;"><strong>Masuk</strong></a>
          </div>
        @endauth  

        {{-- @if (auth()->user()->is_admin = 0)
            
        @else
           
        @endif    --}}
      </div>
      <div class="col-md-1" style="padding-top: 15px">
        <i class="keranjang bi bi-cart2"></i>
      </div>
    </nav>
    <!-- tutup navbar -->

    @yield('container')

    <!-- footer -->
    <div class="footer-top">
        <div class="subscribe">
          <p style="padding-top: 40px; padding-left: 40px; padding-bottom: 40px">Kejutan spesial dari kami hanya untukmu</p>
        </div>
        <div class="subscribe-box">
          <input style="height: 40px; width: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; border: none" type="text" id="fname" name="fname" />
          <span style="height: 40px; background-color: #0060ae" class="daftar text-light" id="basic-addon2">Daftar</span>
        </div>
      </div>
  
      <div class="footer-bottom row-cols-md-5">
        <div class="belanja col">
          <h6 style="color: #155183; font-size: 18px; margin-bottom: 23px">Belanja</h6>
          <p style="font-size: 15px">Berbelanja</p>
          <p style="font-size: 15px">pembayaran</p>
          <p style="font-size: 15px">Pengiriman</p>
        </div>
        <div class="tentang-kami col">
          <h6 style="color: #155183; font-size: 18px; margin-bottom: 23px">Tentang Kutu Buku</h6>
          <p style="font-size: 15px">Tentang Kami</p>
          <p style="font-size: 15px">Toko Kami</p>
          <p style="font-size: 15px">Kerjasama</p>
        </div>
        <div class="lainnya col">
          <h6 style="color: #155183; font-size: 18px; margin-bottom: 23px">Lainnya</h6>
          <p style="font-size: 15px">Syarat & Ketentuan</p>
          <p style="font-size: 15px">Kebijakan & Privasi</p>
          <p style="font-size: 15px">Bantuan</p>
          <p style="font-size: 15px">Hubungi Kami</p>
        </div>
        <div class="aplikasi-seluler col-md-2">
          <h6 style="color: #155183; font-size: 18px; margin-bottom: 23px">Aplikasi Seluler Kami</h6>
          <p style="font-size: 15px">Download aplikasi <b>project.book-test</b> yang tersedia di seluruh perangkat iOS dan Android</p>
          <img src="{{ asset('custom/image/play-store.png') }}" alt="" style="width: 90px" />
          <img src="{{ asset('custom/image/app-store.png') }}" alt="" style="width: 90px" />
        </div>
      </div>
      <!-- tutup footer -->
  
      <!-- footer sosmed -->
      <div class="footer-sosmed">
        <div class="logo">
          <i class="icon-buku bi bi-book d-inline-block align-text-top ms-5"><b>KUTU BUKU</b></i>
        </div>
        <div class="text-footer-sosmed">
          <h5 style="margin-top: 8px; color: #6e6e6e">Toko buku online terbesar, terlengkap dan terpercaya di Indonesia</h5>
        </div>
        <div class="icon-sosmed">
          <img src="{{ asset('custom/image/icon-sosmed.png') }}" class="icon-sosmed" alt="" style="width: 30px; height: 30px" />
          <img src="{{ asset('custom/image/icon-sosmed2.png') }}" class="icon-sosmed" alt="" style="width: 30px; height: 30px" />
          <img src="{{ asset('custom/image/icon-sosmed3.png') }}" class="icon-sosmed" alt="" style="width: 30px; height: 30px" />
        </div>
      </div>
      <!-- tutup footer sosmed -->

  
      <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
  </html>
  
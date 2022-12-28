@extends('layouts.main')

@section('container')

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

<!-- carousel -->
<div  class="carousel d-flex">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('custom/image/carousel1.jpg') }}" class="d-block" alt="carousel1" style="height: 350px; width: 100%" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('custom/image/carousel2.jpg') }}" class="d-block w-100" alt="carousel2" style="height: 350px" />
    </div>
    <div class="carousel-item">
      <img src="{{ asset('custom/image/carousel3.jpg') }}" class="d-block w-100" alt="carrousel3" style="height: 350px" />
    </div>
  </div>
  <button class="carousel-control-prev pt-5" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next pt-5" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="without-carousel">
  <img class="img1" src="{{ asset('custom/image/without-carousel1.jpg') }}" alt="" />
  <img class="img1-2" src="{{ asset('custom/image/without-carousel2.jpg') }}" alt="" />
</div>
</div>
<!-- tutup carousel -->

<!-- icon -->
<div class="icon-kategori">
<div class="buku-pilihan">
  <a style="text-decoration: none;" href="{{ route('view.bukuPilihan') }}"><img src="{{ asset('custom/image/Icon-bukupilihan.png') }}" alt="" style="padding-right: 20px; padding-left: 20px" />
  <h6 class="text-icon text-center">Buku Pilihan</h6></a>
</div>
<div class="ebook">
  <img src="{{ asset('custom/image/Icon-ebook.png') }}" alt="" style="padding-right: 20px; padding-left: 20px" />
  <h6 class="text-icon text-center">Ebook</h6>
</div>
<div class="alat-tulis">
  <img src="{{ asset('custom/image/Icon-alattulis.png') }}" alt="" style="padding-right: 20px; padding-left: 20px" />
  <h6 class="text-icon text-center">Alat Tulis</h6>
</div>
<div class="mainan">
  <img src="{{ asset('custom/image/Icon-mainan.png') }}" alt="" style="padding-right: 20px; padding-left: 20px" />
  <h6 class="text-icon text-center">Mainan</h6>
</div>
</div>

<!-- tutup icon -->

<!-- rekomendasi -->
<p class="text-recommend">Rekomendasi Kutu Buku Untukmu</p>
<div class="recommended">
  <div class="row row-cols-1 row-cols-md-6 g-3">
    @foreach ($book as $data)   
    <a href="/buku/products/{{ $data->slug }}" style="text-decoration: none">
      <div class="col">
        <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
          <img src="{{ asset('coverimage') }}/{{ $data->cover }}" class="card-img-top" alt="..." style="height: 200px"/>
          <div class="card-body">
            <p class="card-text" style="font-size: 12px; color: #212529">{{ $data->author->name ?? '-' }}</p>
            <h5 class="card-title" style="font-size: 14px; color: #212529">{{ $data->title }}</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>@currency($data->price)</b></h5>
          </div>
        </div>
      </div>
    </a>
  @endforeach
  </div>
</div>





  {{-- <div class="col">
    <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book2.jpg') }}" class="card-img-top" alt="..." style="height: 200px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Gosho Aoyama</p>
        <h5 class="card-title" style="font-size: 14px">Detectif Conan</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 68.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book3.jpg') }}" class="card-img-top" alt="..." style="height: 200px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Haruichi Furudate</p>
        <h5 class="card-title" style="font-size: 14px">Haikyu S4</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 60.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book4.jpeg') }}" class="card-img-top" alt="..." style="height: 200px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Gege Akutami</p>
        <h5 class="card-title" style="font-size: 14px">Jujutsu Kaisen 0</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 70.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book5.jpg') }}" class="card-img-top" alt="..." style="height: 200px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Gege Akutami</p>
        <h5 class="card-title" style="font-size: 14px">Jujutsu Kaisen 1</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 75.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book6.jpg') }}" class="card-img-top" alt="..." style="height: 200px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Masashi Kishimoto</p>
        <h5 class="card-title" style="font-size: 14px">Naruto</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 50.000</b></h5>
      </div>
    </div>
  </div>
</div>
</div> --}}
<!-- tutup dari rekomendasi -->

<!-- buku terpopuler -->
{{-- <h4 class="text-popular">Buku - Buku Terpopuler</h4>
<div class="popular">
<div class="row row-cols-1 row-cols-md-5 g-4" style="justify-content: space-between">
  <div class="banner1">
    <img src="{{ asset('custom/image/banner1.png') }}" class="img-banner1" alt="" />
  </div>
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-popular.jpg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">James Clear</p>
        <h5 class="card-title" style="font-size: 14px">Atomic Habits</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 97.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-popular2.jpeg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Henry Manampiring</p>
        <h5 class="card-title" style="font-size: 14px">Filosofi Teras</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 78.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-popular3.jpg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Yoon Hong Gyun</p>
        <h5 class="card-title" style="font-size: 14px">How To Respect My Self</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 77.000</b></h5>
      </div>
    </div>
  </div>  
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-popular4.jpg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">DR. Carol S Dweck</p>
        <h5 class="card-title" style="font-size: 14px">Mindset</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 83.000</b></h5>
      </div>
    </div>
  </div>
</div>
</div> --}}

<!-- buku novel terpopuler -->
{{-- <h4 class="text-popular-novel">Novel Paling Laris</h4>
<div class="popular-novel">
<div class="row row-cols-1 row-cols-md-5 g-4" style="justify-content: space-between">
  <div class="banner1">
    <img src="{{ asset('custom/image/banner2.png') }}" class="img-banner1" alt="" />
  </div>
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-novel1.jpg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Tere Liye</p>
        <h5 class="card-title" style="font-size: 14px">Hujan</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 89.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-novel2.jpg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Tere Liye</p>
        <h5 class="card-title" style="font-size: 14px">Matahari Minor</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 95.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-novel3.jpg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Tere Liye</p>
        <h5 class="card-title" style="font-size: 14px">Bumi</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 103.000</b></h5>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
      <img src="{{ asset('custom/image/book-novel4.jpg') }}" class="card-img-top" alt="..." style="height: 220px" />
      <div class="card-body">
        <p class="card-text" style="font-size: 12px">Mommy ASF</p>
        <h5 class="card-title" style="font-size: 14px">Layangan Putus</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 75.000</b></h5>
      </div>
    </div>
  </div>
</div>
</div> --}}
<!-- Novel terpopuler -->

@if (session('success'))
    <script>
      toastr.success("{!! session('success') !!}");
    </script>
@endif

    <!-- tutup Novel terpopuler -->
@endsection
    

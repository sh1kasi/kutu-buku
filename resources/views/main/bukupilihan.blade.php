@extends('layouts.main')

@section('container')
    
<!-- buku pilihan -->
<div class="container">
  <div class="title-bukupilihan text-center">
    <p style="font-weight: 700">Buku Pilihan</p>
    <p style="font-size: 15px; color: #6e6e6e">Periode</p>
    <p style="font-size: 17px; padding-bottom: 20px; border-bottom: #dad6d6 1px solid">25 Mei 2021 - 31 Desember 2022</p>
  </div>
</div>
<div class="container product-filter" style="display: flex; justify-content: space-between;">
  <div class="filter">
    <p style="font-family: 'Nunito', sans-serif; font-size: 25px; font-weight: 700">Filter</p>
    <p style="font-size: 20px; font-weight: 600">Kategori</p>

    <div class="kategori">
      <p>
        <a class="btn btn-buku " data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample"> Buku </a>
      </p>
      <div class="collapse" id="collapseExample1">
        <div class="card-body">Non-fiksi</div>
        <div class="card-body">Kamus</div>
        <div class="card-body">Pendidikan</div>
        <div class="card-body">Bisnis & Ekonomi</div>
      </div>
      <p>
        <a class="btn btn-buku2 text-start" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample"> Referensi Sekolah </a>
      </p>
      <div class="collapse" id="collapseExample2">
        <div class="card-body">Non-fiksi</div>
        <div class="card-body">Kamus</div>
        <div class="card-body">Pendidikan</div>
        <div class="card-body">Bisnis & Ekonomi</div>
      </div>
      <p>
        <a class="btn btn-buku3 text-start" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample"> Kesehatan & Kecantikan </a>
      </p>
      <div class="collapse" id="collapseExample3">
        <div class="card-body">Non-fiksi</div>
        <div class="card-body">Kamus</div>
        <div class="card-body">Pendidikan</div>
        <div class="card-body">Bisnis & Ekonomi</div>
      </div>
    </div>
    <div class="harga">
      <p style="font-size: 20px; font-weight: 600">Harga</p>
      <form>
        <label style="font-size: 13px; margin-bottom: 5px" for="fname">Minimum:</label><br />
        <input style="margin-bottom: 10px; height: 45px; width: 250px; font-size: 15px" type="text" id="fname" name="fname" placeholder="Rp 0" /><br />
        <label style="font-size: 13px; margin-bottom: 5px" for="lname">Maksimum:</label><br />
        <input style="height: 45px; width: 250px; font-size: 15px" type="text" id="lname" name="lname" placeholder="Rp 200.000" />
      </form>
    </div>
    <div class="stok">
      <p style="font-size: 20px; font-weight: 600; margin-top: 20px">Filter berdasarkan stok</p>
      <div class="form-check mb-3">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
        <label class="form-check-label" for="flexRadioDefault1"> Semua </label>
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
        <label class="form-check-label" for="flexRadioDefault1"> Tersedia </label>
      </div>
    </div>
    <div class="reset mb-5">
      <button style="width: 100px" type="button" class="btn btn-outline-primary">Reset</button>
    </div>
  </div>
  <div class="product">
    <div class="form-out text-end" style="padding-bottom: 25px">
      <select class="form select2 p-2" aria-label="Default select example">
        <option class="text-dark py-2" selected >Terbaru</option>
        <option class="text-dark py-2" value="1">Terpopuler</option>
        <option class="text-dark py-2" value="2">Harga Terendah</option>
        <option class="text-dark py-2" value="3">Harga Tertinggi</option>
      </select>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4 ps-5 pb-5">
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel1.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Hujan</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 89.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel2.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Matahari Minor</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 95.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel3.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Bumi</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 103.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel4.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Mommy ASF</p>
            <h5 class="card-title" style="font-size: 14px">Layangan Putus</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 75.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel1.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Hujan</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 89.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel2.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Matahari Minor</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 95.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel3.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Bumi</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 103.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel4.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Mommy ASF</p>
            <h5 class="card-title" style="font-size: 14px">Layangan Putus</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 75.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel1.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Hujan</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 89.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel2.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Matahari Minor</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 95.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel3.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Tere Liye</p>
            <h5 class="card-title" style="font-size: 14px">Bumi</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 103.000</b></h5>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel4.jpg" class="card-img-top" alt="..." style="height: 220px" />
          <div class="card-body">
            <p class="card-text" style="font-size: 12px">Mommy ASF</p>
            <h5 class="card-title" style="font-size: 14px">Layangan Putus</h5>
            <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>Rp 75.000</b></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
</div>
<!-- tutup buku pilihan -->
@endsection
  


    
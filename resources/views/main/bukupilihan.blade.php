@extends('layouts.main')

@section('container')

{{-- @if (!empty($min_harga && $max_harga))
    @dd('a')
@endif --}}
<!-- account -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input style="border: none; border-bottom: 1px solid" name="email" type="email" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" />
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input style="border: none; border-bottom: 1px solid" name="password" type="password"
                        class="form-control" id="exampleInputPassword1" />
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

<!-- buku pilihan -->
<div class="container">
    <div class="title-bukupilihan text-center">
        <p style="font-weight: 700">Buku Pilihan</p>
        <p style="font-size: 15px; color: #6e6e6e">Periode</p>
        <p style="font-size: 17px; padding-bottom: 20px; border-bottom: #dad6d6 1px solid">25 Mei 2021 - 31 Desember
            2022</p>
    </div>
</div>
<div class="container product-filter">
    <div class="filter">
        <p style="font-family: 'Nunito', sans-serif; font-size: 25px; font-weight: 700">Filter</p>
        <p style="font-size: 20px; font-weight: 600">Kategori</p>

        <div class="kategori">
            <p>
                <a class="btn btn-buku " data-bs-toggle="collapse" href="#collapseExample1" role="button"
                    aria-expanded="false" aria-controls="collapseExample"> Buku </a>
            </p>
            <div class="collapse" id="collapseExample1">
                @foreach ($category as $data)
                <a href="{{ route('view.bukuPilihan', ["category"=>$data->id, "q"=>request()->q, "min"=>request()->min, "max"=>request()->max]) }}"
                    class="link text-decoration-none">
                    <div class="card-body">{{ $data->name }}</div>
                </a>
                @endforeach
            </div>
            <p>
                {{-- <a class="btn btn-buku2 text-start" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample"> Referensi Sekolah </a>
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
      </div> --}}
        </div>
        <div class="harga">
            <p style="font-size: 20px; font-weight: 600">Harga</p>
            <form method="get" action="buku-pilihan">
                <label style="font-size: 13px; margin-bottom: 5px" for="min">Minimum:</label><br />
                <input style="margin-bottom: 10px; height: 45px; width: 250px; font-size: 15px" value="" type="number"
                    id="min" name="min" placeholder="Rp 0" /><br />
                <label style="font-size: 13px; margin-bottom: 5px" for="max">Maksimum:</label><br />
                <input style="height: 45px; width: 250px; font-size: 15px" type="number" id="max" value="" name="max"
                    placeholder="Rp 50.000" />
        </div>
        <div class="reset mt-3">
            <button style="width: 100px" type="sumbit" class="btn btn-outline-primary">Cari</button>
            <a href="{{ url('buku/buku-pilihan') }}"><button style="width: 100px" type="button"
                    class="btn btn-outline-primary">Reset</button></a>
        </div>
        </form>
    </div>
    <div class="product">
        <div class="form-out text-end" style="padding-bottom: 25px">
            <select class="form select2 p-2" aria-label="Default select example">
                <option class="text-dark py-2" selected>Terbaru</option>
                <option class="text-dark py-2" value="1">Terpopuler</option>
                <option class="text-dark py-2" value="2">Harga Terendah</option>
                <option class="text-dark py-2" value="3">Harga Tertinggi</option>
            </select>
        </div>
        <div class="ps-5 pb-5" style="padding-right: 650px">

            {{-- @if ($list === null)
        @foreach ($book as $data)
          <div class="col">
            <div class="card shadow-sm p-3 mb-5 bg-body rounded" style="height: 350px">
              <img src="{{ asset('coverimage/' . $data->cover) }}" class="card-img-top" alt="..." style="height: 220px"
            />
            <div class="card-body">
                <p class="card-text" style="font-size: 12px">{{ $data->author->name }}</p>
                <h5 class="card-title" style="font-size: 14px">{{ $data->title }}</h5>
                <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>@currency($data->price)</b></h5>
            </div>
        </div>
    </div>
    @endforeach
    @elseif (!empty($min_harga && $max_harga)) --}}
    @forelse ($book as $data)
    <a href="/buku/products/{{ $data->slug }}" style="text-decoration: none">
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
                <img src="{{ asset('coverimage') }}/{{ $data->cover }}" class="card-img-top" alt="..."
                    style="height: 200px;" />
                <div class="card-body">
                    <p class="card-text" style="font-size: 12px; color: #212529">{{ $data->author->name ?? '-' }}</p>
                    <h5 class="card-title" style="font-size: 14px; color: #212529">{{ $data->title }}</h5>
                    <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>@currency($data->price)</b></h5>
                </div>
            </div>
        </div>
    </a>
    @empty
    Buku Tidak Ditemukan
    @endforelse
    {{-- @else
        @forelse ($list->book as $data)
        <a href="/buku/products/{{ $data->slug }}" style="text-decoration: none">
    <div class="col">
        <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
            <img src="{{ asset('coverimage') }}/{{ $data->cover }}" class="card-img-top" alt="..."
                style="height: 200px;" />
            <div class="card-body">
                <p class="card-text" style="font-size: 12px; color: #212529">{{ $data->author->name ?? '-' }}</p>
                <h5 class="card-title" style="font-size: 14px; color: #212529">{{ $data->title }}</h5>
                <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>@currency($data->price)</b></h5>
            </div>
        </div>
    </div>
    </a>
    @empty
    <h5>Buku Dalam Kategori ini Kosong</h5>
    @endforelse
    @endif --}}

    {{-- @if ($list === null)
      @foreach ($book as $data)
      <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('coverimage/' . $data->cover) }}" class="card-img-top" alt="..." style="height: 220px" />
    <div class="card-body">
        <p class="card-text" style="font-size: 12px">{{ $data->author->name }}</p>
        <h5 class="card-title" style="font-size: 14px">{{ $data->title }}</h5>
        <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>{{ $data->price }}</b></h5>
    </div>
</div>
</div>
@endforeach

@elseif(!empty($search))
@foreach ($pencarian as $datas)
<a href="/buku/products/{{ $datas->slug }}" style="text-decoration: none">
    <div class="col">
        <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
            <img src="{{ asset('coverimage') }}/{{ $datas->cover }}" class="card-img-top" alt="..."
                style="height: 200px;" />
            <div class="card-body">
                <p class="card-text" style="font-size: 12px; color: #212529">{{ $datas->author->name ?? '-' }}</p>
                <h5 class="card-title" style="font-size: 14px; color: #212529">{{ $datas->title }}</h5>
                <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>@currency($datas->price)</b></h5>
            </div>
        </div>
    </div>
</a>
@endforeach
@else
@forelse ($list->book as $data)
<a href="/buku/products/{{ $data->slug }}" style="text-decoration: none">
    <div class="col">
        <div class="card shadow p-3 mb-5 bg-body rounded" style="height: 350px">
            <img src="{{ asset('coverimage') }}/{{ $data->cover }}" class="card-img-top" alt="..."
                style="height: 200px;" />
            <div class="card-body">
                <p class="card-text" style="font-size: 12px; color: #212529">{{ $data->author->name ?? '-' }}</p>
                <h5 class="card-title" style="font-size: 14px; color: #212529">{{ $data->title }}</h5>
                <h5 class="card-title" style="font-size: 15px; color: #0060ae"><b>@currency($data->price)</b></h5>
            </div>
        </div>
    </div>
</a>
@empty
gaada
@endforelse
@endif --}}
{{-- @if ($list->book->count() == '0')
          gaada
      @endif --}}


{{-- <div class="col">
        <div class="card shadow-sm p-3  bg-body rounded" style="height: 350px">
          <img src="{{ asset('custom') }}/image/book-novel2.jpg" class="card-img-top" alt="..." style="height: 220px"
/>
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
</div> --}}
</div>
</div>
</div>
</div>
</div>
<!-- tutup buku pilihan -->
@endsection

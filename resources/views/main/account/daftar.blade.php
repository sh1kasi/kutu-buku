<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <!-- my css -->
    <link rel="stylesheet" href="{{ asset('custom') }}/css/style.css" />

    <!-- my js -->
    <link rel="stylesheet" href="{{ asset('custom') }}/js/script.js" />

    <title>Daftar | KutuBuku</title>
  </head>
  <body>
    <img class="wa-icon fixed-bottom" src="{{ asset('custom') }}/image/icon-wa-removebg-preview (1).png" alt="" />
    <!-- navbar -->
    <nav class="row navbar-light shadow mb-5 bg-body rounded fixed-top">
      <div class="col-md-3" style="padding-top: 15px; padding-bottom: 15px">
        <a class="merk navbar-brand" href="#">
          <i class="icon-buku bi bi-book d-inline-block align-text-top ms-5">KUTU BUKU</i>
        </a>
      </div>
    </nav>
    <!-- tutup navbar -->

    <!-- title navbar -->
    <div class="title-daftar">
      <p class="text-center" style="padding-top: 100px; color: #0060ae; font-size: 40px">Daftar</p>
    </div>

    <form action="{{ route('register.store') }}" method="POST">
      @csrf
      <div class="mb-3 container" style="width: 45%">
        <label for="text">Nama Lengkap</label>
        <input style="border: none; border-bottom: 1px solid" class="form-control" name="name" type="text" aria-label="default input example" />
      </div>
      <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input style="border: none; border-bottom: 1px solid" type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" />
      </div>
      <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputPassword1" class="form-label">Password</label>
       <input style="border: none; border-bottom: 1px solid" type="password" class="form-control" name="password" id="exampleInputPassword1" />
      </div>
      <div class="container" style="display: flex; justify-content: center">
        <button type="submit" class="btn btn-secondary text-center" style="width: 30%">Daftar</button>
      </div>
    </form>
    
    <div class="mt-3">
      <p class="text-center">Sudah terdaftar? <a href="login.html">Masuk</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
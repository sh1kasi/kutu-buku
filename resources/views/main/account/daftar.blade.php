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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>Daftar | KutuBuku</title>
  </head>
  <body>
    <img class="wa-icon fixed-bottom" src="{{ asset('custom') }}/image/icon-wa-removebg-preview (1).png" alt="" />
    <!-- navbar -->
    <nav class="row navbar-light shadow mb-5 bg-body rounded fixed-top">
      <div class="col-md-3" style="padding-top: 15px; padding-bottom: 15px">
        <a class="merk navbar-brand" href="{{ route('view.index') }}">
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
        <input style="border: none; border-bottom: 1px solid" @error('name') is-invalid @enderror value="{{ old('name') }}" class="form-control" name="name" type="text" aria-label="default input example" />
        @error('name')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input style="border: none; border-bottom: 1px solid" @error('email') is-invalid @enderror value="{{ old('email') }}" type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" />
        @error('email')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
        @enderror
      </div>


      <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <i class="bi bi-eye toggle-password" id="eye_icon" type="button" style="position: absolute; top: 345px; left: 950px; font-size: 20px" onclick="myFunction()"></i>
        <input style="border: none; border-bottom: 1px solid" type="password" class="form-control" id="myInputPw2" />
        @error('password')
       <div class="text-danger mt-2">
         {{ $message }}
       </div>
       @enderror
      </div>
      <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
        <i class="bi bi-eye" id="eyeye" type="button" style="position: absolute; top: 425px; left: 950px; font-size: 20px" onclick="myFunction2()"></i>
        <input style="border: none; border-bottom: 1px solid" type="password" class="form-control" id="myInputPw3" />
        @error('password_confirmation')
       <div class="text-danger mt-2">
         {{ $message }}
       </div>
       @enderror
      </div>


      @php
        $min = 1;
        $max = 30;
        $num1 = rand($min, $max);
        $num2 = rand($min, $max);
        $sum = $num1 + $num2; 
      @endphp
     <div class="captcha container" style="width: 45%">
      <div class="mb-3" >
        {{-- <div class="label"  style=" background-color: #0d6efd; width:200px; border: #0d6efd 2px solid">
          <label for="quiz" class="form-label text-light mt-2 ms-1" style="width: 200px; ">
            {{ $num1 . ' + ' . $num2 . ' =' }}
          </label>
        </div>
        <input type="text" class="form quiz_input" name="quiz" id="quiz" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid; border-left: #000000 1px solid"> --}}
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}
        @error('g-recaptcha-response')
        <div class="text-danger mt-2">
         {{ $message }} 
        </div>
       @enderror  
      </div>
     </div>

      <div class="container" style="display: flex; justify-content: center">
        <button type="submit" id="button_submit" data-res="{{ $sum }}" class="btn btn-primary text-center"  style="width: 52%">Daftar</button>
      </div>

      
      
      {{-- <div class="mb-3 container">
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}
      </div> --}}
      </form>
    
    <div class="mt-3">
      <p class="text-center">Sudah terdaftar? <a href="{{ route('view.login') }}">Masuk</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->


    <script>
      function myFunction() {
        var x = document.getElementById('myInputPw2');
        if (x.type === 'password') {
          x.type = 'text';
          $(this).click(function (e) { 
            e.preventDefault();
            $("#eye_icon").addClass('bi-eye-slash').removeClass('bi-eye');
          });
        } else {
          x.type = 'password';
          $(this).click(function (e) { 
            e.preventDefault();
            $("#eye_icon").addClass('bi-eye').removeClass('bi-eye-slash');            
          });
        }
      }
      function myFunction2() {
        var x = document.getElementById('myInputPw3');
        if (x.type === 'password') {
          x.type = 'text';
          $(this).click(function (e) { 
            e.preventDefault();
            $("#eyeye").addClass('bi-eye-slash').removeClass('bi-eye');            
          });
        } else {
          x.type = 'password';
          $(this).click(function (e) { 
            e.preventDefault();
            $("#eyeye").addClass('bi-eye').removeClass('bi-eye-slash');            
          });
        }
      }

        // const submitButton = document.getElementById('button_submit');
        //   const quizInput = document.getElementById('quiz');
        //   quizInput.addEventListener("input", function(e) {
        //     const res = submitButton.getAttribute("data-res");
        //     if ( this.value == res ) {
        //     submitButton.removeAttribute("disabled");
        //     } else {
        //       submitButton.setAttribute("disabled", "");
        //     }
        //   });

        // $(document).ready(function () {
        //   var show = {
        //   '1':  $('#input_pw').val(),
        //   '2':  $('#password_confirmation').val(),
        //   };

        //   $('#show_pass').click(function (e) { 
        //     e.preventDefault();
        //     $(this).is(':checked')
        //     if ($('#input_pw').attr('type:password')) {
        //       $('#input_pw').attr('type', 'text');
        //     } else {
        //        $('#input_pw').attr('type:password');
        //     }
        //     // $(this).is(':checked') ? $(+show+).attr('type', 'text') : $(+show+).attr('type', 'password');
        //   });
        // });

    </script>


  </body>
</html>
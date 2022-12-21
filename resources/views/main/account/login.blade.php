@extends('layouts.main')

@section('container')



{{-- <div class="alert alert-danger" style="padding-top: 80px">
  <h5>a</h5>
</div> --}}

    <div class="title-daftar">
      <p class="text-center" style="padding-top: 100px; color: #0060ae; font-size: 40px">Masuk</p>
    </div>


    <form action="{{ route('login.store') }}" method="POST">
      @csrf
      <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input style="border: none; border-bottom: 1px solid" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
        @error('email')
            <div class="text-danger mt-2">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input style="border: none; border-bottom: 1px solid" name="password" type="password" class="form-control" id="input_pw" />
        @error('password')
          <div class="text-danger mt-2">
            {{ $message }}
          </div>
      @enderror
      </div>
      {{-- <div class="mb-3 container" style="width: 45%">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input style="border: none; border-bottom: 1px solid" name="password_confirmation" type="password" class="form-control" id="input_pw" />
        @error('password_confirm')
          <div class="text-danger mt-2">
            {{ $message }}
          </div>
      @enderror
      </div> --}}
      <div class="showpassword mt-4"><input type="checkbox" onclick="myFunction()" />Show Password</div>
      @if(Session()->has('error'))
        <div class="alert alert-danger mt-3" style="width: 600px; margin-left: 380px">
          {!! Session()->get('error') !!}
        </div>               
      @endif  
      <div class="container" style="display: flex; justify-content: center">
        <button type="submit" class="btn btn-primary text-center mt-3" style="width: 30%">Masuk</button>
      </div>
    </form>
    <div class="mt-3">
      <p class="text-center">Belum mendaftar? <a href="{{ route('view.register') }}">Daftar</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("input_pw");
        // var y = document.getElementById("input_pw2");
        if (x.type === 'password') {
          x.type = 'text';
          // y.type = 'text';
        } else {
          x.type = 'password';
          // y.type = 'password';
        }
      }
    </script>

    {{-- @if (session()->has('logerror'))
        <script>
          toastr.error("{!! Session('logerror') !!}")
        </script>
    @endif --}}


  <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
@if (session()->has('success'))
    <script>
      toastr.success('{!! session("success") !!}');
    </script>
@endif

@endsection

    



    {{-- <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html> --}}
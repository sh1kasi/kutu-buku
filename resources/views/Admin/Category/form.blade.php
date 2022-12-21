@extends('layouts.admin')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <ul>
                                <li>{{ $error }}</li>
                            </ul>
                        @endforeach
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Kategori</h5>
                        <form action="{{ route('category.store') }}" method=post>
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                              <input type="text" id="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama kategori" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Slug</label>
                              <input type="text" id="slug" name="slug" value="" class="form-control" placeholder="Masukkan Slug" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#name').bind('keypress keyup blur', function() {
        $('#slug').val($(this).val());
    });
</script>
    
@endsection
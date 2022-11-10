@extends('layouts.admin')

@section('content')

<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Author</h5>
                        <form action="{{ route('author.store') }}" method=post>
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nama Author</label>
                              <input type="text" id="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama author" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Alamat</label>
                              <input type="text" id="slug" name="slug" value="" class="form-control" placeholder="Masukkan alamat" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
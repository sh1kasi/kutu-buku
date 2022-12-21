@extends('layouts.admin')

@section('content')

<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Author</h5>

                        {{-- @dd($category) --}}

                        <form action="{{ url('/author/' . $author->id) }}" method=post>
                            @csrf
                            @method('put')
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Nama Author</label>
                              <input type="text" id="name" name="name" class="form-control" value="{{ $author->name }}" id="exampleInputEmail1" placeholder="Masukkan nama author" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Alamat</label>
                              <input type="text" id="address" name="address" class="form-control" value="{{ $author->address }}" placeholder="Masukkan alamat" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
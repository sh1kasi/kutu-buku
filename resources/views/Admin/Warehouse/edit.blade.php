@extends('layouts.admin')

@section('content')

<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Warehouse</h5>

                        {{-- @dd($category) --}}

                        <form action="{{ url('/warehouse/' . $warehouse->id) }}" method=post>
                            @csrf
                            @method('put')
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Code Warehouse</label>
                              <input type="text" id="name" name="code" class="form-control" value="{{ $warehouse->code }}" id="exampleInputEmail1" placeholder="Masukkan code warehouse" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">No. Telepon</label>
                              <input type="text" id="slug" name="phone" class="form-control" value="{{ $warehouse->phone }}" placeholder="Masukkan nomor telepon warehouse" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Alamat</label>
                              <input type="text" id="slug" name="address" class="form-control" value="{{ $warehouse->address }}" placeholder="Masukkan alamat warehouse" id="exampleInputPassword1">
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
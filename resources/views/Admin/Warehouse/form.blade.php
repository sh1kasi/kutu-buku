@extends('layouts.admin')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Warehouse</h5>
                        <form action="{{ route('warehouse.store') }}" method=post>
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Code Warehouse</label>
                              <input type="text" id="name" name="code" class="form-control" id="exampleInputEmail1" placeholder="Masukkan code warehouse" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">No. Telepon Warehouse</label>
                              <input type="text" id="slug" name="phone" value="" class="form-control" placeholder="Masukkan nomor telepon warehouse" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Alamat Warehouse</label>
                              <input type="text" id="slug" name="address" value="" class="form-control" placeholder="Masukkan alamat warehouse" id="exampleInputPassword1">
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
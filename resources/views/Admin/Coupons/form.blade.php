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
                        <h5 class="card-title">Tambah Voucher Diskon</h5>
                        <form action="{{ route('coupon.store') }}" method=post>
                            @csrf
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Code Voucher</label>
                              <input type="text" id="name" name="code" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Code Voucher" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Tipe Potongan</label> <br>
                              <select class="form-select" name="type" id="type">
                                  <option value="0">Pilih Tipe</option>
                                  <option value="percent">Dalam Bentuk Persen</option>
                                <option value="value">Dalam Bentuk Potongan</option>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                                <input type="text" id="name" name="value" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Julah Potongan" aria-describedby="emailHelp">
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
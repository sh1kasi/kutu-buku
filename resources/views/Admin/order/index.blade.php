@extends('layouts.admin')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- <div class="alert alert-success">
    {{ session('success') }}
</div> --}}

<div class="page-content">
    <div class="main-wrapper">
      <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order</h5>
                  {{-- <a href="/author/form" class="btn btn-success mb-3"><i data-feather="plus-square"></i> Tambah</a>  --}}
                    <div class="line" style="padding-top: 20px; border-top: 1px solid #5b5b5b">
  
                    <table id="Tables123" class="table table-striped table-bordered" style="font-size: 12px; text-align: center;">
                      <thead>
                    <tr>
                      <th style="text-align: center;">No</th>
                      <th style="text-align: center;">Order ID</th>
                      <th style="text-align: center;">Total Product</th>
                      <th style="text-align: center;">Date</th>
                      <th style="text-align: center;">Price</th>
                      <th style="text-align: center;">Status</th>
                      <th style="text-align: center;" width="15%">Detail</i></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($order as $data)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>#{{ $data->order_id }}</td>
                      <td>{{ $data->order_detail->qty }}</td>
                      <td>{{ $data->created_at->format('d-m-Y') }}</td>
                      <td>@currency($data->total_price)</td>
                      <td>
                        @if ($data->status == 'delivered')
                            <p class="alert alert-success">Delivered</p>
                        @elseif ($data->status == 'capture')
                            <p class="alert alert-success">Order Success</p>
                        @endif
                      </td>
                      {{-- <td><i data-feather="list"></i></td> --}}
                      <td>
                        <div class="dropdown">
                            <i data-feather="list" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown button
                            </i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="/order/detail/{{ $data->id }}">Detail Order</a>
                              <a class="dropdown-item alert alert-success" href="#">Selesaikan Pesanan</a>
                              {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
                            </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready( function () {
    $('#Tables123').DataTable();
} );
</script>    
@endsection
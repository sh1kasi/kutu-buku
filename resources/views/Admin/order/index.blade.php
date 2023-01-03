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
                        @if ($data->status == 'completed')
                            <p class="alert alert-success">Pesanan Selesai
                            </p>
                        @elseif ($data->status == 'capture')
                            <p class="alert alert-success" id="{{ $data->id }}">Pembayaran Selesai</p>
                        @elseif ($data->status == 'settlement')
                            <p class="alert alert-success" id="{{ $data->id }}">Pembayaran Selesai</p>
                        @elseif ($data->status == 'pending')
                            <p class="alert alert-warning" id="{{ $data->id }}">Pembayaran Tertunda</p>
                        @endif
                      </td>
                      {{-- <td><i data-feather="list"></i></td> --}}
                      <td>
                        <div class="dropdown" id="dropdownElement">
                            <i data-feather="list" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Dropdown button
                            </i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="/order/detail/{{ $data->order_id }}">Detail Order</a>
                                @if ($data->status == 'capture')
                                  <p class="dropdown-item alert alert-success" type="button" id="{{ $data->order_id }}" onclick="completeOrder({{ $data->id }})">Selesaikan Pesanan</p>
                                @elseif ($data->status == 'settlement')
                                  <p class="dropdown-item alert alert-success" type="button" id="{{ $data->order_id }}" onclick="completeOrder({{ $data->id }})">Selesaikan Pesanan</p>
                                @endif
                                <p class="dropdown-item alert alert-danger" type="button" onclick="deleteOrder({{ $data->id }})">Hapus Transaksi</p>
                              <input type="hidden" name="order_id" id="order_id" value="{{ $data->order_id }}">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>

<script>

  function completeOrder(id) {
    
    var order_id = $('#order_id').val();
    var dropdownElement = $("#dropdownElement")

    $.ajax({
      type: "POST",
      url: `/order/complete/${id}`,
      data: {
        id: id
      },
      // dataType: "dataType",
      success: function (response) {
        // $(`#${id}`).html(`Pesanan Selesai`);
        toastr.success('Berhasil menyelesaikan pesanan', 'Success !');
        window.location.reload();
      }
    });
    
  }

  function deleteOrder(id) {
    $.ajax({
      type: "post",
      url: `/order/delete/${id}`,
      data: {
        id: id,
      },
      success: function (response) {
        toastr.warning('Berhasil menghapus pesanan', 'Success !');
        window.location.reload();
      }
    });
  }

$(document).ready( function () {
    $('#Tables123').DataTable();
} );
</script>    
@endsection
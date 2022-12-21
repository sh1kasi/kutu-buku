@extends('layouts.admin')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="alert alert-success">
    {{ session('success') }}
</div>

<div class="page-content">
    <div class="main-wrapper">
      <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Author</h5>
                  {{-- <a href="/author/form" class="btn btn-success mb-3"><i data-feather="plus-square"></i> Tambah</a>  --}}
                    <div class="line" style="padding-top: 20px; border-top: 1px solid #5b5b5b">
  
                    <table id="Tables123" class="table table-striped table-bordered">
                      <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      {{-- <th width="15%"><i data-feather="settings"></i></th> --}}
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($user as $data)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $data->name }}</td>
                      <td>{{ $data->email }}</td>
                      <td>
                        @if ($data->is_admin == 1)
                            Admin
                        @else
                            User
                        @endif
                      </td>
                      {{-- <td>
                        @if ($data->is_admin == 1)
                            <a href="{{ url('/user/role/' . $data->id) }}" class="btn btn-success" style="font-size: 13px">Set User</a>
                        @else
                            <a href="{{ url('/user/role/' . $data->id) }}" class="btn btn-success" style="font-size: 13px">Set Admin</a> 
                        @endif
                        <a href="#" id="delete" data-id="{{ $data->id }}" data-name="{{ $data->name }}" class="btn btn-danger">Hapus</a>
                      </td> --}}
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

@if (session()->has('success'))
<script>
  toastr.success("{!! Session('success') !!}");
</script>
@endif

<script>
    $('a#delete').on("click", function(){
        //  console.log('haha');
         var id = $(this).attr('data-id')
         var name = $(this).attr('data-name')
         swal({
                 title: "Kamu yakin?",
                 text: "User dengan nama " +name+" akan terhapus!",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
                 })
                 .then((willDelete) => {
                 if (willDelete) {
                     window.location = "/user/delete/"+id+""
                     swal("user "+name+" berhasil terhapus" , {
                     icon: "success",
                     buttons: false,
                     });
                     
                 }
             });
     })
</script>


<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    
@endsection
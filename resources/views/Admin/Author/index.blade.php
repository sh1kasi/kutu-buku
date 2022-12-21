@extends('layouts.admin')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

                <a href="/author/form" class="btn btn-success mb-3"><i data-feather="plus-square"></i> Tambah</a> 

                    
                  <div class="line" style="padding-top: 20px; border-top: 1px solid #5b5b5b">

                  <table id="Tables123" class="table table-striped table-bordered">
                    <thead>
                  <tr>
                    <th>No</th>
                    <th>Author</th>
                    <th>Alamat</th>
                    <th width="15%"><i data-feather="settings"></i></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($author as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->address }}</td>
                    <td>
                      <a href="{{ url('/author/edit/' . $data->id) }}"><i data-feather="edit"></i></a> &nbsp; | &nbsp;
                      <a href="#" id="delete" data-id="{{ $data->id }}" data-name="{{ $data->name }}"><i data-feather="trash-2"></i></a>
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
               text: "Author " +name+" akan terhapus!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
               })
               .then((willDelete) => {
               if (willDelete) {
                   window.location = "/author/delete/"+id+""
                   swal("Author "+name+" berhasil terhapus" , {
                   icon: "success",
                   buttons: false,
                   });
                   
               }
           });
   })
  </script>

    
@endsection
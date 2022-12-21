@extends('layouts.admin')

@section('content')

@foreach ($book as $item)
  
@endforeach

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
                  <h5 class="card-title">Book</h5>

                <a href="/book/form" class="btn btn-success mb-3"><i data-feather="plus-square"></i> Tambah</a> 

                    
                  <div class="line" style="padding-top: 20px; border-top: 1px solid #5b5b5b">

                  <table id="Tables123" class="table table-striped table-bordered">
                    <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th width="20%"><i data-feather="settings"></i></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($book as $data)
                  <tr>  
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->title }}</td>
                    {{-- @foreach ($data->category as $item) --}}
                      <td>{{ $data->category->name ?? '' }}</td>
                    {{-- @endforeach --}}
                    <td>{{ $data->author->name ?? '' }}</td>  
                    <td>{{ $data->publisher->name ?? '' }}</td>  
                    <td>{{ $data->year }}</td>
                    <td>@currency($data->price)</td>
                    <td>
                      <a href="{{ url('/book/edit/' . $data->id) }}"><i data-feather="edit"></i></a> &nbsp; | &nbsp;
                      <a href="#" id="delete" data-id="{{ $data->id }}" data-title="{{ $data->title }}"><i data-feather="trash-2"></i></a>
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
       var title = $(this).attr('data-title')
       swal({
               title: "Kamu yakin?",
               text: "Book " +title+" akan terhapus!",
               icon: "warning",
               buttons: true,
               dangerMode: true,
               })
               .then((willDelete) => {
               if (willDelete) {
                   window.location = "/book/delete/"+id+""
                   swal("Book "+title+" berhasil terhapus" , {
                   icon: "success",
                   buttons: false,
                   });
                   
               }
           });
   })
  </script>
    
@endsection
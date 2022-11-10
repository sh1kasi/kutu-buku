@extends('layouts.admin')



@section('content')

<style>



</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">


<div class="page-content">
  <div class="main-wrapper">
    <div class="row">
      <div class="col">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Publisher</h5>

                <a href="/publisher/form" class="btn btn-success mb-3"><i data-feather="plus-square"></i> Tambah</a> 

                    
                  <div class="line" style="padding-top: 20px; border-top: 1px solid #5b5b5b">

                  <table id="Tables123" class="table table-striped table-bordered">
                    <thead>
                  <tr>
                    <th>No</th>
                    <th>Publisher</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th><i data-feather="settings"></i></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($publisher as $data)
                  <tr>
                    <td style="width: 5%">{{ $loop->iteration }}</td>
                    <td style="width: 10%">{{ $data->name }}</td>
                    <td style="width: 20%; font-size: 14px">{{ $data->address }}</td>
                    <td style="width: 15%">{{ $data->phone }}</td>
                    <td style="width: 10%">
                        <a href="{{ url('/publisher/edit/' . $data->id) }}"><i data-feather="edit"></i></a> &nbsp; | &nbsp;
                        <a href="{{ url('/publisher/delete/' . $data->id) }}"><i data-feather="trash-2"></i></a>
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

  <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>


  <script>
    $(document).ready( function () {
      $('#Tables123').DataTable();
    } );
  </script>
    
@endsection
@extends('layouts.admin')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">


<div class="page-content">
  <div class="main-wrapper">
    <div class="row">
      <div class="col">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Warehouse</h5>

                <a href="/warehouse/form" class="btn btn-success mb-3"><i data-feather="plus-square"></i> Tambah</a> 

                    
                  <div class="line" style="padding-top: 20px; border-top: 1px solid #5b5b5b">

                  <table id="Tables123" class="table table-striped table-bordered">
                    <thead>
                  <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th width="15%"><i data-feather="settings"></i></th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($warehouse as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->code }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>{{ $data->address }}</td>
                    <td>
                      <a href="{{ url('/warehouse/edit/' . $data->id) }}"><i data-feather="edit"></i></a> &nbsp; | &nbsp;
                      <a href="{{ url('/warehouse/delete/' . $data->id) }}"><i data-feather="trash-2"></i></a>
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
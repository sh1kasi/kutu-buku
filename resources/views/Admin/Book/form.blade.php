@extends('layouts.admin')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">

                <div id="success_message"></div>
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
                        <h5 class="card-title">Tambah Buku</h5>


        

                        <form id="form2" action="{{ route('book.store') }}" method=post enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Judul Buku</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" id="exampleInputEmail1" placeholder="Masukkan judul buku" aria-describedby="emailHelp">
                            </div>
                              <div class=" d-flex">
                                <div class="kategori col-md-4 mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kategori &nbsp;<a href="#" data-bs-toggle="modal" data-bs-target="#modalCategory"><i style="width: 20px; height: 20px;" data-feather="plus-circle"></i></a></label>
                                       <select class="form-select" id="category" name="category_id" aria-label="Default select example">
                                           <div class="option" id="option">
                                               <option class="123" id="item" selected value="">Pilih Kategori</option>
                                               @foreach ($category as $cate)
                                                   <option id="item" data-name="{{ $cate->name }}" data-value="{{ $cate->id }}" value="{{ $cate->id }}" {{ old('category_id') == $cate->id ? 'selected' : '' }} >{{ $cate->name }}</option>
                                               @endforeach
                                           </div>
                                       </select>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tahun</label>
                                <input type="text" id="title" name="year" class="form-control" value="{{ old('year') }}" placeholder="Masukkan tahun buku" id="exampleInputPassword1">
                              </div>
                                <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Author  &nbsp;<a href="#" data-bs-toggle="modal" data-bs-target="#modalAuthor"><i style="width: 20px; height: 20px;" data-feather="plus-circle"></i></a></label>
                                    <select class="form-select" id="author" name="author_id" aria-label="Default select example">
                                        <option selected value="">Pilih Author</option>
                                        @foreach ($author as $aut)
                                        <option value="{{ $aut->id }}" {{ old('author_id') == $aut->id ? 'selected' : '' }}>{{ $aut->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Publisher &nbsp;<a href="#" data-bs-toggle="modal" data-bs-target="#modalPublisher"><i style="width: 20px; height: 20px;" data-feather="plus-circle"></i></a></label>
                                    <select class="form-select" name="publisher_id" id="publisher" aria-label="Default select example">
                                        <option selected>Pilih Publisher</option>
                                        @foreach ($publisher as $pub)
                                            <option value="{{ $pub->id }}" {{ old('publisher_id') == $pub->id ? 'selected' : '' }}>{{ $pub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Harga</label>
                                <input type="text" id="title" name="price" value="{{ old('pricee') }}" class="form-control" placeholder="Masukkan harga buku">
                              </div>
                                <div class="row g-3">
                                    <div class="w-50" style="margin-bottom: 50px">
                                        <label for="cover" class="form-label">Gambar Cover Buku</label>
                                        <input type="file" id="cover" name="cover" class="form-control" placeholder="Upload cover buku" onchange="previewImage()">
                                        <img id="img-preview" class="img-preview img-fluid mt-4" style="margin-left: 100px" width="250">
                                    </div>
                                    
                                    <div class="col md-3">
                                        <label class="mt-0" for="text">Bahasa</label>
                                        <input type="text" value="{{ old('language') }}" name="language" style="width: 455px" class="form-control mt-2" placeholder="Bahasa buku">
                                    <div class="row mt-3">
                                        <div class="col-md-6" style="width: 238.5px">
                                            <label for="text">Jumlah Halaman</label>
                                            <input type="text" value="{{ old('page') }}" name="page" class="form-control mt-2" placeholder="Total Halaman">
                                            <label class="mt-3" for="text">Berat</label>
                                            <div class="input-group">
                                                <input type="number" value="{{ old('weight') }}" name="weight" class="form-control mt-2" placeholder="Berat buku">
                                                <div class="input-group-text mt-2">gr</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="width: 238.5px">
                                            <label for="text">Lebar</label>
                                            <div class="input-group">
                                                <input type="text" value="{{ old('width') }}" name="width" class="form-control mt-2" placeholder="Lebar buku">
                                                <div class="input-group-text mt-2">cm</div>
                                            </div>
                                            <label class="mt-3" for="text">Panjang</label>
                                            <div class="input-group">
                                                <input type="number" value="{{ old('length') }}" name="length" class="form-control mt-2" placeholder="Panjang buku">
                                                <div class="input-group-text mt-2">cm</div>
                                            </div>
                                        </div>
                                        <label for="textarea" class="form-label mt-3">Deskripsi</label>
                                        <textarea class="form-control" name="description" id="textarea" cols="50" rows="10">{{ old('description') }}</textarea>        
                                    </div>
                                </div>
                                  <button type="submit" form="form2" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Admin.modal.create-category')
@include('Admin.modal.create-author')
@include('Admin.modal.create-publisher')



<script>

    function previewImage() {
        const image = document.querySelector('#cover');
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }


    $('#category').click(function (e) { 
        e.preventDefault();
        var id = $('#category option:selected').val();
        // var data = {
        //     'name': $('.item').data(),
        // };

            console.log(id);
        // $('#category').load(window.location.href + ' #item');


        });

    // $("#refresh123").click(function (e) { 
    //     e.preventDefault();
    //     $('#category').load(window.location.href + ' #item');
        
        
    // });

        // console.log(name);

    // $('#formSubmit').click(function () {

    //     var id = $(this).attr('data-id');
    //     var name= $(this).attr('data-name');

    //     // $('#item').empty();
    //     var newItem = $("<option value="+id+">"+name+"</option>")
    //     $('#item').append(newItem);
    //     $('#item').trigger("change");
    // });

</script>


{{-- <script type="text/javascript">
    $('input[type="file"][name="cover"]').val('');
    $('input[type="file"][name="cover"]').on('change', function(){
        var img_path = $(this)[0].value;
        var img_holder = $('.img-holder')
        var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
        
        if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
            if(typeof(FileReader) != 'undefined'){
                img_holder.empty();
                var reader = new FileReader();
                reader.onload = function(e){
                    $('<img/>',{'src':e.target.result, 'class':'img-fluid','style':'max-width:200px; margin-top: 60px; margin-left: 100px'}).
                    appendTo(img_holder);
                }
                img_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                $(img_holder).html('Browser ngga support');
            }
        } else {
            $(img_holder).empty();
        }
    })
</script> --}}


@endsection
@extends('layouts.admin')

@section('content')

{{-- @if ($book->author_id == null)
   @dd('ahah')                              
@endif --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  
<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Book</h5>

                        {{-- @dump($array_kosong) --}}

                        <form action="{{ url('/book/' . $book->id) }}" method=post enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Judul Buku</label>
                              <input type="text" id="title" name="title" class="form-control" value="{{ $book->title }}" id="exampleInputEmail1" placeholder="Masukkan judul buku" aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                 <select class="form-select" name="category_id" aria-label="Default select example">
                                  @if ($book->category_id == null)
                                  <option value="" selected>Pilih Category</option>
                                  @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                  @endforeach
                                @else
                                @foreach ($category as $cat)
                                  <option value="{{ $cat->id }}"
                                    @if ($book->category->id == $cat->id)
                                        selected
                                    @endif
                                  >{{ $cat->name }}</option>
                                @endforeach
                              @endif
                                 </select>
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Tahun</label>
                              <input type="text" id="title" name="year" class="form-control" value="{{ $book->year }}" placeholder="Masukkan tahun buku" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Author</label>
                              <select class="form-select" name="author_id" aria-label="Default select example">
                                  @if ($book->author_id == null)
                                      <option value="" selected>Pilih Author</option>
                                      @foreach ($author as $aut)
                                        <option value="{{ $aut->id }}">{{ $aut->name }}</option>
                                      @endforeach
                                    @else
                                    @foreach ($author as $aut)
                                      <option value="{{ $aut->id }}"
                                        @if ($book->author->id == $aut->id)
                                            selected
                                        @endif
                                      >{{ $aut->name }}</option>
                                    @endforeach
                                  @endif
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Publisher</label>
                                <select class="form-select" name="publisher_id" aria-label="Default select example">
                                  @if ($book->publisher_id == null)
                                  <option value="" selected>Pilih Publisher</option>
                                  @foreach ($publisher as $pub)
                                    <option value="{{ $pub->id }}">{{ $pub->name }}</option>
                                  @endforeach
                                @else
                                @foreach ($publisher as $pub)
                                  <option value="{{ $pub->id }}"
                                    @if ($book->publisher->id == $pub->id)
                                        selected
                                    @endif
                                  >{{ $pub->name }}</option>
                                @endforeach
                              @endif
                                </select>
                            </div>       
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Harga</label>
                              <input type="text" id="title" name="price" class="form-control" value="{{ $book->price }}" placeholder="Masukkan harga buku" id="exampleInputPassword1">
                            </div>
                            <div class="row g-3">
                              <div class="w-50" style="margin-bottom: 50px">
                                  <label for="cover" class="form-label">Gambar Cover Buku</label>
                                  <input type="file" id="cover" name="cover" class="form-control" placeholder="Upload cover buku" id="exampleInputPassword1" onchange="previewImage()">
                                  @if ($book->cover)
                                    <img src="{{ asset('coverimage/' . $book->cover) }}" id="img-preview" class="img-preview img-fluid mt-4" style="margin-left: 100px" width="250">
                                  @else
                                    <img id="img-preview" class="img-preview img-fluid mt-4" style="margin-left: 100px" width="250">
                                  @endif
                                  {{-- <div id="img-holder" class="img-holder" class="mt-3"></div> --}}
                                  {{-- <img class="mt-3" src="{{ asset('coverimage/welcome-to-the-jungle.jpg') }}" width="150px" alt=""> --}}

                              </div>
                              

                              
                              <div class="col md-3">
                                  <label class="mt-0" for="text">Bahasa</label>
                                  <input value="{{ $book->language }}" type="text" name="language" style="width: 455px" class="form-control mt-2" placeholder="Bahasa buku">
                              <div class="row mt-3">
                                  <div class="col-md-6" style="width: 238.5px">
                                      <label for="text">Jumlah Halaman</label>
                                      <input value="{{ $book->page }}" type="text" name="page" class="form-control mt-2" placeholder="Total Halaman">
                                      <label class="mt-3" for="text">Berat</label>
                                      <div class="input-group">
                                        <input value="{{ $book->weight }}" type="text" name="weight" class="form-control mt-2" placeholder="Berat buku">
                                        <div class="input-group-text mt-2">gr</div>
                                      </div>
                                  </div>
                                  <div class="col-md-6" style="width: 238.5px">
                                      <label for="text">Lebar</label>
                                      <div class="input-group">
                                        <input value="{{ $book->width }}" type="number" name="width" class="form-control mt-2" placeholder="Lebar buku">
                                        <div class="input-group-text mt-2">cm</div>
                                      </div>
                                      <label class="mt-3" for="text">Panjang</label>
                                      <div class="input-group">
                                        <input value="{{ $book->length }}" type="number" name="length" class="form-control mt-2" placeholder="Panjang buku">
                                        <div class="input-group-text mt-2">cm</div>
                                      </div>
                                    </div>
                                    <label for="textarea" class="form-label mt-3">Deskripsi</label>
                                    <textarea class="form-control" name="description" id="textarea" cols="50" rows="10">{{ $book->description }}</textarea>
                              </div>
                          </div>

                          
                        {{-- <div class="col-md-4 mb-3">
                          <a href="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" style="color: #155183; text-decoration:none; font-size:14px;">
                              <strong>Tambahkan Deskripsi dan Detail Buku</strong>
                          </a>   --}}


                          {{-- MODAL MODAL MODAL MODAL MODAL MODAL --}}
                          {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content p-4"> --}}
                                  
                            <button type="submit" class="btn btn-primary">Save</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
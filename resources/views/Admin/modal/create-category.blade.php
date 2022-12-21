
      
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <div class="modal fade" id="modalCategory" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content p-3">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalCreateLabel">Tambah Kategori</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <ul id="saveform_errlist"></ul>

                {{-- <form id="form99" action="{{ route('category.modalStore') }}" method="post" enctype="multipart/form-data" > --}}
                  {{-- @csrf --}}
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
                    <input type="text" id="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama kategori" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" value="" class="form-control" placeholder="Masukkan Slug" id="exampleInputPassword1">
                  </div>
                  {{-- <button id="formSubmit" form="form99" data-bs-dismiss="modal" type="submit" class="btn btn-secondary w-100 text-center form-submit">Simpan</button> --}}
                  <button id="formSubmit" type="button" class="btn btn-secondary w-100 text-center form-submit">Simpan</button>
                {{-- </form> --}}
              </div>
            </div>
          </div>

<script>
$('#name').bind('keypress keyup blur', function() {
      $('#slug').val($(this).val());
});

   $(document).ready(function () {
        $(document).on('click', '.form-submit', function (e) {
            e.preventDefault();
            var id = $('#category option:selected').val();
            var data = {
              'name': $('#name').val(),
             'slug': $('#slug').val(),
          }
           console.log(id);


           $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
           });


           $.ajax({
              type: "post",
             url: '/category/modalstore',
             data: data,
             dataType: "json",
             success: function (response) {
                console.log(response);
                if (response.status == 400) {

                  $('#saveform_errlist').html("");
                  $('#saveform_errlist').addClass("alert alert-danger");
                  $.each(response.errors, function (key, err_values) { 
                     $('#saveform_errlist').append(`<li style="margin-left: 15px">${err_values}</li>`)
                  });
                } else {
                  $('#saveform_list').html("");
                  $('#success_message').addClass('alert alert-success');
                  $('#success_message').text(response.message); 
                  $('#modalCategory').modal('hide'); 
                  $('#category').append(`<option value='${response.data.id}'>${data.name}</option>`);
                  $('#modalCategory').find('input').val(""); 
                  console.log(id);
                  console.log(response.data);
                }
            }
          })
      })
  })

</script>
      
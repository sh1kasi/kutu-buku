
      
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <div class="modal fade" id="modalAuthor" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content p-3">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalCreateLabel">Tambah Author</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <ul id="saveform_errlist_author"></ul>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Author</label>
                    <input type="text" id="name_author" name="name_author" value="" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama author" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Alamat</label>
                    <input type="text" id="address" name="address" value="" class="form-control" placeholder="Masukkan alamat author" id="exampleInputPassword1">
                  </div>
                  <button id="formSubmit" type="button" class="btn btn-secondary w-100 text-center form-submit_author">Simpan</button>
              </div>
            </div>
          </div>

<script>

   $(document).ready(function () {
        $(document).on('click', '.form-submit_author', function (e) {
            e.preventDefault();
            var id_author = $('#author option:selected').val();
            var data = {
              'name_author': $('#name_author').val(),
             'address': $('#address').val(),
          }
           console.log(data);


           $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });


           $.ajax({
              type: "post",
             url: '/author/modalstore',
             data: data,
             dataType: "json",
             success: function (response) {
                console.log(response);
                if (response.status == 400) {

                  $('#saveform_errlist_author').html("");
                  $('#saveform_errlist_author').addClass("alert alert-danger");
                  $.each(response.errors, function (key, err_values_author) { 
                     $('#saveform_errlist_author').append('<li style="margin-left: 15px">'+err_values_author+'</li>')
                  });
                } else {
                  $('#saveform_list_author').html("");
                  $('#success_message').addClass('alert alert-success');
                  $('#success_message').text(response.message); 
                  $('#modalAuthor').modal('hide'); 
                  $('#author').append(`<option value='${response.data.id}'>${data.name_author}</option>`);
                  $('#modalAuthor').find('input').val(""); 
                  console.log(id_author);
                  console.log(response.data);
                }
            }
          })
      })
  })

</script>
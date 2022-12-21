
      
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <div class="modal fade" id="modalPublisher" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content p-3">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalCreateLabel">Tambah Publisher</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <ul id="saveform_errlist_publisher"></ul>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Publisher</label>
                    <input type="text" id="name_publisher" name="name_publisher" value="" class="form-control" id="exampleInputEmail1" placeholder="Masukkan nama publisher" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Alamat</label>
                    <input type="text" id="address_publisher" name="address_publisher" value="" class="form-control" placeholder="Masukkan alamat publisher" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">No. Telepon Publisher</label>
                    <input type="text" id="phone" name="phone" value="" class="form-control" placeholder="Masukkan No. telepon publisher" id="exampleInputPassword1">
                  </div>
                  <button id="formSubmit" type="button" class="btn btn-secondary w-100 text-center form-submit_publisher">Simpan</button>
              </div>
            </div>
          </div>

<script>

   $(document).ready(function () {
        $(document).on('click', '.form-submit_publisher', function (e) {
            e.preventDefault();
            var id_publisher = $('#publisher option:selected').val();
            var data = {
              'name_publisher': $('#name_publisher').val(),
             'address_publisher': $('#address_publisher').val(),
             'phone': $('#phone').val(),
          }
           console.log(data);


           $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });


           $.ajax({
              type: "post",
             url: '/publisher/modalstore',
             data: data,
             dataType: "json",
             success: function (response) {
                console.log(response);
                if (response.status == 400) {

                  $('#saveform_errlist_publisher').html("");
                  $('#saveform_errlist_publisher').addClass("alert alert-danger");
                  $.each(response.errors, function (key, err_values_publisher) { 
                     $('#saveform_errlist_publisher').append('<li style="margin-left: 15px">'+err_values_publisher+'</li>')
                  });
                } else {
                  $('#saveform_list_publisher').html("");
                  $('#success_message').addClass('alert alert-success');
                  $('#success_message').text(response.message); 
                  $('#modalPublisher').modal('hide'); 
                  $('#publisher').append(`<option value='${response.data.id}'>${data.name_publisher}</option>`);
                  $('#modalPublisher').find('input').val(""); 
                //   console.log(id_publisher);
                  console.log(response.data);
                }
            }
          })
      })
  })

</script>
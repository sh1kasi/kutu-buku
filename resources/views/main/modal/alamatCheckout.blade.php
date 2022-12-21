<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat Pengiriman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <ul id="err_list"></ul>

          <form>
            <input type="hidden" name="user_id" class="user_id" value="{{ Auth::id() }}">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Label Alamat</label>
              <input type="text" name="label_address" class="form-control label_address" id="exampleFormControlInput1" placeholder="Cth : (Rumah, Kantor)" style="background: transparent" />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Nama Penerima</label>
              <input type="text" name="receiver" class="form-control receiver" id="exampleFormControlInput1" placeholder="Masukkan Nama Penerima" style="background: transparent" />
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">No. Handphone</label>
              <div class="input-group">
                <div class="input-group-text">+62</div>
                <input type="number" name="phone" class="form-control phone" id="exampleFormControlInput1" placeholder="Masukkan No. Handphone" style="background: transparent" />
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Provinsi</label>
              <div class="col-12">
                <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                <select class="form-select province" name="province" id="inlineFormSelectPref">
                  <option selected value="0">Pilih Provinsi</option>
                  @foreach ($province as $data)
                      <option value="{{ $data['province_id'] }}">{{ $data['province'] }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Kota/Kabupaten</label>
              <div class="col-12">
                <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                <select class="form-select regency" name="regency" id="inlineFormSelectPref">
                  <option selected>Pilih Kota/Kabupaten</option>

                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Kecamatan</label>
              <div class="col-12">
                <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                <select class="form-select district" name="district" id="inlineFormSelectPref">
                  <option selected>Pilih Kecamatan</option>

                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Alamat Lengkap</label>
              <input type="text" name="address" class="form-control address" id="exampleFormControlInput1" placeholder="Masukkan Alamat Lengkap" style="background: transparent" />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="submit-btn btn btn-primary w-100">Simpan Alamat</button>
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function () {

        
      $(".province").change(function (e) { 
        e.preventDefault();

        $.ajaxSetup({
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });

        var province_id = $(".province").val();
        
        
        $.ajax({
          type: "POST",
          url: "{{ route('province') }}",
          data: {province_id: province_id},
          cache: false,
           
          success: function (msg) {
            $(".regency").html(msg);
          },
          error: function (data) {
            console.log('error:' ,data)
          },


        });
      });

      $(".regency").change(function (e) { 
        e.preventDefault();

        $.ajaxSetup({
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
        });

        var regency_id = $(".regency").val();

        
        $.ajax({
          type: "POST",
          url: "{{ route('regency') }}",
          data: {regency_id: regency_id},
          cache: false,
           
          success: function (msg) {
            $(".district").html(msg),
            console.log(msg); 
          },
          error: function (data) {
            console.log('error:' ,data)
          },


        });
      });
    });

    $(".submit-btn").click(function (e) { 
        e.preventDefault();
        
       

        var data = {
           'id': $(".user_id").val(),
           'label_address': $(".label_address").val(),
           'receiver': $(".receiver").val(),
           'phone': $(".phone").val(),
           'province': $(".province").val(),
           'regency': $(".regency").val(),
           'district': $(".district").val(),
           'address': $(".address").val(),
        };

        console.log(data);
        
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
          type: "POST",
          url: "/address",
          data: data,
          dataType: "json",
          success: function (response) {
            if (response.status == 400) {
              $("#err_list").html("");
              $("#err_list").addClass("alert alert-danger");
              $.each(response.errors, function (key, err_values) { 
                 $("#err_list").append(`<li style="margin-left: 15px;">${err_values}</li>`);
              });
            } else {
              toastr.success('Alamat pengiriman berhasil tersimpan', 'Success !');
              $(".alamat-judul").remove();
              $(".alamat-gaada").remove();
              $(".buat").remove();
              $(".ngirim").remove();
              $("#exampleModal").modal('hide')
              $(".ubah-alamat").html(`<div class="d-flex" style="justify-content: space-between">
                <b class="text-alamat text-muted p-3"><i class="bi bi-geo-alt-fill me-1"></i>Alamat Tujuan Pengiriman</b>
                <a type="button" class="text-alamat p-3" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: none">Ubah Alamat</a>
              </div>`);
              $(".label_alamat").html(`<b class="ps-3" style="font-size: 15px">${response.data.label_address}</b>`);
              $(".name-calling").html(` <div class="ps-3 name-calling d-flex"
                style="font-size: 14px; font-family: 'Nunito', sans-serif; padding-top: 10px">
                <p class="pe-2" style="border-right: 1px solid #000000">${response.data.receiver}</p>
                <p class="ps-2">+62${response.data.phone}</p>
              </div>`);
              $(".full-address").html(`<div class="placement ps-3" style="font-size: 14px; font-family: 'Nunito', sans-serif">
                <p>${response.data.address}, ${response.district.name}, ${response.regency.name},
                ${response.province.name}.</p>
                </div>`);
             


              // <b class="ps-3" style="font-size: 15px">${response.data.label_address}</b>
              //   <div class="ps-3 name-calling d-flex"
              //       style="font-size: 14px; font-family: 'Nunito', sans-serif; padding-top: 10px">
              //       <p class="pe-2" style="border-right: 1px solid #000000">${response.data.receiver}</p>
              //       <p class="ps-2">+62${response.data.phone}</p>
              //   </div>
              //   <div class="placement ps-3" style="font-size: 14px; font-family: 'Nunito', sans-serif">
              //       <p>${response.data.address}, ${response.data.district.name}, ${response.data.regency.name},
              //           ${response.data.province.name}.</p>
              //       </div>
            }
          }
        });

        
    });
</script>
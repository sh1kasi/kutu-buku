
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-dialog-scrollable">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Opsi Pengiriman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left: 200px"></button>
      </div>
      <div class="body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
          @foreach ($kurir as $couriers)
          <div class="accordion-item mb-2">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button mb-2 collapsed kurir" name="code" data-name="{{ $couriers->name }}" value="123" type="button" data-bs-toggle="collapse" data-card="{{ $couriers->code }}" data-code-id="{{ $couriers->code }}" data-bs-target="#{{ $couriers->code }}" aria-expanded="false" aria-controls="flush-collapseOne">{{ $couriers->name }}</button>
              </h2> 
              <div id="{{ $couriers->code }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="ongkir_price" id="ongkir_price">


<form action="{{ route('payment') }}" id="submit_form" method="post">
  @csrf
  <input type="hidden" name="json" id="json_callback">
  <input type="hidden" name="total_price" id="payment_total_price">
  <input type="hidden" name="harga_ongkir" id="payment_harga_ongkir">
  <input type="hidden" name="nama_ongkir" id="payment_nama_ongkir">
  <input type="hidden" name="snaptoken" id="snaptoken">
  <input type="hidden" name="coupon" id="coupon">
</form>


<script>

  $(document).ready(function () {
    
    
    // $(".paket").hide();  
    
    $(".kurir").click(function (e) { 

      e.preventDefault();
    var code = $(this).attr('data-code-id');
    var cardId = $(this).attr('data-card');
    var name = $(this).attr('data-name');
    var harga = $(this).attr("data-harga");

    console.log(name);
    //  $('#'+cardId).toggle(300);


     
     $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });


     $.ajax({
      type: "POST",
      url: "/cekongkir",
      data: {code: code},
      dataType: "json",
      success: function (response) {
        // $("#"+cardId).toggle();
        $("#"+cardId).html("");
        $.each(response.data.costs, function(key, item) {
          $.each(item.cost, function (key, data) {   
            // console.log(item);

            $("#"+cardId).append(`<div class="accordion-body service" style="border-bottom: 1px solid #e2e2e2;"><a class="text-dark" id="layanan" data-layanan="${item.description}" data-harga="${data.value}" style="text-decoration: none">${item.description} (Rp ${data.value.toLocaleString("id-ID")})</a><br />
            <a class="text-secondary" id="layanan" data-layanan="${item.description}" data-harga="${data.value}" style="font-size: 14px; text-decoration: none">Dikirim dihari yang sama sebelum pukul 14:00</a></div>`);
            });
          });

          $("a#layanan").click(function (e) { 
            e.preventDefault();

            var hasil = $(this).attr("data-layanan");
            var harga = $(this).attr("data-harga");
            var total = $("#harga-total").val();
            var total_semua = Number(harga) + Number(total);


            // $(".isi-pengiriman").html(`<b>${name}</b> - (${hasil}) Rp ${harga}`);
            $("#staticBackdrop").modal("hide");
            $("#pengiriman").html(`Rp ${parseInt(harga).toLocaleString("id-ID")}`);
            $("#total").html(`Rp ${total_semua.toLocaleString("id-ID")}`);
            $("#total").append(`<input type="hidden" value="${total_semua}" name="harga_total" id="harga_total">`);
            $("#total").append(`<input type="hidden" value="${harga}" name="harga_ongkir" id="harga_ongkir">`);
            $("#ongkir_price").val(harga);
            $("#total").append(`<input type="hidden" value="${hasil}" name="nama_ongkir" id="nama_ongkir">`);

            console.log(hasil);
            
          });


          $("a#layanan").click(function (e) { 
            e.preventDefault();
            console.log($("#nama_ongkir").val());
            
            
            var total_price = $("#harga_total").val();
            var harga_ongkir = $("#harga_ongkir").val();
            var nama_ongkir = $("#nama_ongkir").val();
            var inputCode = $(".code").val();

            console.log(total_price);

              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

            $.ajax({
              type: "post",
              url: "/cart-checkout-update",
              data: { 
                total_price: total_price,
                harga_ongkir: harga_ongkir,
                nama_ongkir: name,
                inputCode: inputCode
              },
              dataType: "json",
              success: function (response) {
                console.log('sabi');
                $(".opsi").remove();
                $('.code').prop("disabled", false);
                $(".use_code").removeClass("disabled");
                $(".payment").removeClass("disabled");
                $(".ubah").html(`Ubah Metode`);
                $(".nama_ongkir").html(`<b>${name}</b> - (${nama_ongkir})`);
                $(".harga_ongkir").html(`Rp ${harga_ongkir.toLocaleString("id-ID")}`);
                $("#payment_total_price").val(total_price.toLocaleString("id-ID"));
                $("#payment_harga_ongkir").val(harga_ongkir.toLocaleString("id-ID"));
                $("#payment_nama_ongkir").val(`(${name}) ${nama_ongkir}`);
                $("#snaptoken").val(response.snaptoken);

                $(".payment").click(function (e) { 
                  e.preventDefault();

                  var coupon = $(".code").val();

                  $.ajax({
                    type: "post",
                    url: "/cart-midtranspay",
                    data: {

                    },
                    dataType: "json",
                    success: function (response) {

                      $("#snaptoken").val(response.snaptoken);
                      $("#coupon").val(coupon);
                      
                      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                       window.snap.pay(`${response.snaptoken}`, {
                         onSuccess: function(result){
                           /* You may add your own implementation here */
                           console.log(result);
                           send_response_to_for(result)
                         },
                         onPending: function(result){
                           /* You may add your own implementation here */
                           console.log(result);
                           send_response_to_for(result)
                         },
                         onError: function(result){
                           /* You may add your own implementation here */
                           console.log(result);
                           send_response_to_for(result)
                         },
                         onClose: function(){
                           /* You may add your own implementation here */
                           alert('you closed the popup without finishing the payment');
                         }
                       })
                   
                       function send_response_to_for(result) {
                         // var total_price = $("#harga_total").val();
                         // var harga_ongkir = $("#harga_ongkir").val();
                         // var nama_ongkir = $("#nama_ongkir").val();
                         document.getElementById('json_callback').value = JSON.stringify(result);
                         $("#submit_form").submit();
                       }

                    }
                  });


                });

              
              }
            });
          });

          

      }
     });
    
    });

    
    $(".use_code").click(function (e) { 
        e.preventDefault();

        var code = $(".code").val();
        var harga_total = $("#harga_total").val();

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        $.ajax({
            type: "post",
            url: "/coupon/check",
            data: {
                harga_total: harga_total,
                code: code,
            },
            dataType: "json",
            success: function (response) {
            var total_price = $("#harga_total").val();

                if (response.status == 0) {
                    toastr.error(`${response.message}`);
                    $(".use_code").removeClass('disabled');
                    $('#diskon').html(`-`);
                } else if (response.status == 1) {
                    toastr.success(`${response.message}`);
                    $('#diskon').html(`(${response.code} - ${response.off}%) - Rp${response.percent.toLocaleString("id-ID")} `);
                    // var disc = (response.off / 100) * response.harga_total;
                    // var after_disc = response.harga_total - disc;
                    console.log(response.harga_total);
                    $('#total').html(`Rp ${response.harga_total.toLocaleString("id-ID")}`);
                    $(".use_code").addClass("disabled");
                } else if (response.status == 2) {
                    toastr.success(`${response.message}`);
                    $('#diskon').html(`(${response.code}) -Rp ${response.off.toLocaleString("id-ID")}`);
                    // var after_disc = response.harga_total - response.off;
                    console.log(response.harga_total);
                    $('#total').html(`Rp ${response.harga_total.toLocaleString("id-ID")}`);
                    $(".use_code").addClass("disabled");
                }

            } 
        });
        
    });

    $('input[type=search]').on('search', function () {

        $(".use_code").removeClass("disabled");
        var product_price = $("#harga-total").val();  
        var shipment_price = $("#ongkir_price").val();
        var before_disc = Number(product_price) + Number(shipment_price);

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
        
      $.ajax({
        type: "post",
        url: "/coupon-cancel",
        data: {
          before_disc: before_disc
        },
        dataType: "json",
        success: function (response) {
          $("#diskon").html(` - `);
          $("#total").html(`Rp ${before_disc.toLocaleString("id-ID")}`);
        }
      });

       
    });

    

  });



</script>
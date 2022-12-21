
<div class="rounded modal fade" id="cartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Berhasil Dimasukkan ke Tas Belanja!</h5>
            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body d-flex" style="padding: 15px">
                    <div class="gambar">
                        <img src="{{ asset("coverimage") }}/{{ $b->cover }}" style="height: 100px; width: 63px" alt="..." />
                    </div>
                    <div class="deskripsi">
                        <h6 style="margin-left: 10px; font-family: 'Nunito',serif; font-size: 15px; color: #6d6d6d">{{ $b->author->name }}</h6>
                        <h6 style="margin-left: 10px; margin-bottom: 35px;  font-family: 'Nunito',serif; font-size: 18px; ">{{ $b->title }}</h6>
                        <span style="  font-family: 'Nunito',serif; font-size: 15px; color:#0060ae; padding-left: 287px;"><b style="margin-top: 100px;" id="total_item">Rp {{ $b->price }}</b><span>
                    </div>
                </div>
            </div>
        </div>
        <div class="button" style="padding-left: 16px; padding-right: 16px; padding-bottom:10px;">
            <a href="{{ route('cartView') }}"><button type="button" class="rounded-pill btn text-center w-100 btn-outline-primary">Lihat Tas Belanja</button></a>
        </div>
        <div class="button" style="padding-left: 16px; padding-right: 16px; padding-bottom:10px;">  
            <a href="{{ route('checkoutView') }}?orderid={{ $order_id }}"><button type="button" class="rounded-pill text-center btn w-100 btn-primary">Lanjut ke Pembayaran</button></a>
        </div>
      </div>
    </div>
  </div>


   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <div class="card-title">Lakukan Pembayaran</div>

                  <form method="post" action="{{ route('bayar.store',$siswa->id) }}">
                     @csrf

                     <div class="form-group">
                        <label>NISN Siswa</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ $siswa->nisn }}" readonly>
                        <span class="text-danger">@error('nisn') {{ $message }} @enderror</span>
                     </div>
                     <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" value="{{ $siswa->nama }}" readonly>
                        <span class="text-danger">@error('nisn') {{ $message }} @enderror</span>
                     </div>

                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <label class="input-group-text">
                              SPP Bulan
                           </label>
                        </div>
                        <select class="custom-select @error('spp_bulan') is-invalid @enderror" name="spp_bulan">
                            <option value="">--Pilih bulan--</option>
                            @php
                                $times = $siswa->spp->tahun.'-07-15';
                                $no = 1;
                            @endphp
                            @for ($i=0 ;$i < 11; $i++)
                                    @php
                                        $due_dates[] = $times;
                                         $time = date('F Y', strtotime('+1 month', strtotime($times)));
                                         $month = date('Y-m-d', strtotime('+1 month', strtotime($times)));
                                         $times = $time;
                                     @endphp
                                <option value="{{$month}}">{{$times}}</option>
                            @endfor
                       </select>
                     </div>
                     <span class="text-danger">@error('spp_bulan') {{ $message }} @enderror</span>


                     <div class="form-group">
                       <label>Jumlah Harus DiBayarkan</label>
                       <input type="text" class="form-control " value="@rupiah($siswa->spp->nominal)" readonly>
                    </div>
                     <div class="form-group">
                       <label>Jumlah DiBayarkan</label>
                       <input type="text" class="form-control @error('jumlah_bayar') is-invalid @enderror" id="jumlah-bayar" name="jumlah_bayar">
                       <span class="text-danger">@error('jumlah_bayar') {{ $message }} @enderror</span>
                    </div>
                   <a href="{{ url('dashboard/pembayaran') }}" class="btn btn-primary btn-rounded">
                     <i class="mdi mdi-chevron-left"></i>Kembali
                   </a>
                   <button type="submit" class="btn btn-success btn-rounded float-right">
                     <i class="mdi mdi-check"></i> Simpan
                   </button>

                </form>

            </div>
         </div>

      </div>
   </div>
@section('js')

var rupiah = document.getElementById('jumlah-bayar');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
}
@endsection


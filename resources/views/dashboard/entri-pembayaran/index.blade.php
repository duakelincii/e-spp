@extends('layouts.dashboard')

@section('breadcrumb')
   <li class="breadcrumb-item">Dashboard</li>
   <li class="breadcrumb-item active">Pembayaran</li>
@endsection

@section('content')

   <div class="row">
      <div class="col-md-12">

         <div class="card">
            <div class="card-body">
               <div class="card-title">Entri Pembayaran</div>

                <form method="post" action="{{route('filter.pembayaran')}}">
                  @csrf
                     <div class="form-group">
                        <label>NISN Siswa</label>
                        <select name="nisn" class="form-control" id="search">
                            <option value="">--Pilih Nisn--</option>
                            @foreach ($siswa as $sis )
                                <option value="{{$sis->nisn}}">{{$sis->nisn}} / {{$sis->nama}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('nisn') {{ $message }} @enderror</span>
                     </div>

                       <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <label class="input-group-text">
                             Kelas
                           </label>
                        </div>
                        <select class="custom-select @error('kelas') is-invalid @enderror" name="id_kelas">
                            <option value="">--Pilih Kelas--</option>
                            @foreach ($kelas as $kel )
                                <option value="{{$kel->id}}">{{$kel->nama_kelas}}</option>
                            @endforeach
                       </select>
                     </div>
                     <span class="text-danger">@error('kelas') {{ $message }} @enderror</span>

                     {{-- <div class="form-group">
                       <label>Jumlah Bayar</label>
                       <input type="text" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar">
                       <span class="text-danger">@error('jumlah_bayar') {{ $message }} @enderror</span>
                    </div> --}}
                    {{-- <div class="input-group mb-3">
                        <div class="input-group-prepend">
                           <label class="input-group-text">
                              SPP Bulan
                           </label>
                        </div>
                        <select class="custom-select @error('status') is-invalid @enderror" name="status">

                              <option value="">Silahkan Pilih Status Pembayaran</option>
                                 <option value="Bayar">Bayar</option>
                                 <option value="Belum Bayar">Belum Bayar</option>
                       </select>
                     </div>
                     <span class="text-danger">@error('status') {{ $message }} @enderror</span> --}}

                   <button type="submit" class="btn btn-success btn-rounded float-right">
                     <i class="mdi mdi-check"></i> Cari
                   </button>

                </form>

            </div>
         </div>

      </div>
   </div>


   <!-- Main Content -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <div id="page" class="p-2"></div>
           </div>
       </div>
   </div>
</div>

   <div class="row">
      <div class="col-md-12">

         <div class="card">
            <div class="card-body">
               <div class="card-title">Data Pembayaran</div>

                  <div class="table-responsive mb-3">

                        <table class="table" id="table-siswa">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NISN SISWA</th>
                                        <th scope="col">NAMA SISWA</th>
                                        <th scope="col">KELAS</th>
                                        <th scope="col">SPP</th>
                                        <th scope="col">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($pembayaran))
                                        @foreach ($pembayaran as $value )
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$value->nisn}}</td>
                                                <td>{{$value->nama}}</td>
                                                <td>{{$value->kelas->nama_kelas}}</td>
                                                <td>{{$value->spp->tahun}}</td>
                                                <td>
                                                    <button onclick="status({{ $value->id }})" class="btn btn-success btn-sm"><i class="ti-money"></i>Status Pembayaran </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                        </table>
                    </div>

                            <! -- Pagination -->
                            @if (!empty($pembayaran))
					@if($pembayaran->lastPage() != 1)
						<div class="btn-group float-right">
						   <a href="{{ $pembayaran->previousPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-left"></i>
						    </a>
						    @for($i = 1; $i <= $pembayaran->lastPage(); $i++)
								<a class="btn btn-success {{ $i == $pembayaran->currentPage() ? 'active' : '' }}" href="{{ $pembayaran->url($i) }}">{{ $i }}</a>
						    @endfor
					        <a href="{{ $pembayaran->nextPageUrl() }}" class="btn btn-success">
								<i class="mdi mdi-chevron-right"></i>
							</a>
					   </div>
					@endif
                    @endif
					<!-- End Pagination -->

                    @if (!empty($pembayaran))
					   @if(count($pembayaran) == 0)
				  			<div class="text-center">Tidak ada data!</div>
					   @endif
                    @endif

            </div>
         </div>

      </div>
   </div>


@endsection

@section('sweet')

   function deleteData(id){
      Swal.fire({
               title: 'PERINGATAN!',
               text: "Yakin ingin menghapus data SPP?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal',
            }).then((result) => {
               if (result.value) {
                     $('#delete'+id).submit();
                  }
               })
   }
    $('#nisn').select2({
        placeholder: "Pilih Siswa",
        allowClear: true
    });
@endsection
<script>
    // Untuk modal halaman edit show
    function status(id) {
            $.get("{{ url('/dashboard/pembayaran/status/pembayaran') }}/" + id, {}, function(data, status) {
                $("#exampleModalLabel").html('Status Pembayaran')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }
</script>

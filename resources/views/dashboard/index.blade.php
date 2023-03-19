@extends('layouts.dashboard')

@section('breadcrumb')
	<li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('content')

   <div class="alert alert-success text-center"><b>Selamat Datang</b> di aplikasi pembayaran SPP Sekolah</div>

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div class="card-title">Histori Terbaru</div>
               <div class="comment-widgets scrollable">

                              <!--  Row -->
                              @foreach($pembayaran as $history)
                                <div class="d-flex flex-row comment-row">
                                    <i class="mdi mdi-account display-3"></i>
                                    <div class="comment-text active w-100">
                                    <hr>
                                    <span class="badge badge-success badge-rounded float-right">{{ $history->created_at->diffforHumans() }}</span>
                                        <h6 class="font-medium">{{ $history->siswa->nama }}</h6>
                                        <span class="m-b-15 d-block">
                                             <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Kelas {{ $history->siswa->kelas->nama_kelas }}</li>
                                                <li class="list-group-item">Jumlah Bayar Rp.{{ $history->jumlah_bayar }}</li>
                                                <li class="list-group-item">SPP Bulan <b  class="text-capitalize text-bold">{{ $history->spp_bulan }}</b></li>
                                               <li class="list-group-item"> Status Pembayaran
                                                @if ($history->status == 'Bayar')
                                                <span class="badge badge-success">Bayar</span>
                                                @else
                                                <span class="badge badge-danger">Belum Bayar</span>
                                                @endif
                                               </li>
                                           </ul>
                                        </span>
                                        <div class="comment-footer ">
                                            <span class="text-muted float-right">{{ $history->created_at->format('M d, Y') }}</span>
                                            <span class="action-icons active">
                                                    <a href="{{ url('dashboard/pembayaran/'. $history->id .'/edit') }}"><i class="ti-pencil-alt"></i></a>
                                                </span>
                                                @if ($history->status == 'Belum Bayar')
                                                    <a class="btn btn-success btn-sm ml-2" href="{{ url('dashboard/pembayaran/'. $history->id .'/bayar') }}"><i class="ti-money"></i> Lakukan Pembayaran </a>
                                                @endif
                                            </div>
                                    </div>
                                </div>
                                @endforeach
                                @if(count($pembayaran) == 0)
				  			   <div class="text-center"> Tidak ada histori!</div>
					         @endif

                            </div>

         </div>
      </div>
   </div>
</div>

@endsection

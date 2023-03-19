
<div class="row">
      <div class="col-md-12">

         <div class="card">
            <div class="card-body">
               <div class="card-title">Data Pembayaran</div>

                  <div class="table-responsive mb-3">

                        <table class="table" id="table-siswa">
                                <thead>
                                    <tr>
                                        <th scope="col">NISN SISWA</th>
                                        <th scope="col">NAMA SISWA</th>
                                        <th scope="col">KELAS</th>
                                        <th scope="col">SPP BULAN</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>

                                <tbody>
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
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$siswa->nisn}}</td>
                                            <td>{{$siswa->nama}}</td>
                                            <td>{{$times}}</td>
                                            <td>
                                                @if ($siswa->pembayaran->where('spp_bulan',$month))
                                                    @foreach ($siswa->pembayaran->where('spp_bulan',$month) as $bayar)
                                                        @if ($bayar->spp_bulan == $month)
                                                            <span class="badge badge-success">Sudah Bayar</span>
                                                        @else
                                                            <span class="badge badge-danger">Belum Bayar</span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="badge badge-danger">Belum Bayar</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <button onclick="bayar({{ $siswa->id}})" class="btn btn-success btn-sm"><i class="ti-money"></i>Bayar</button> --}}
                                            </td>
                                        </tr>
                                        @endfor
                                </tbody>
                        </table>
                    </div>
            </div>
         </div>

      </div>
   </div>

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
    function bayar(id) {
            $.get("{{ url('/dashboard/pembayaran/bayar') }}/" + id , {}, function(data, status) {
                $("#exampleModalLabel").html('Lakukan Pembayaran')
                $("#page").html(data);
                $("#exampleModal").modal('show');
            });
        }
</script>

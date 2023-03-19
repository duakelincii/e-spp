<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\User;
use App\Siswa;
use App\Kelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{

//    public function __construct(){
//          $this->middleware([
//             'auth',
//             'privilege:admin&petugas'
//          ]);
//     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $siswa = Siswa::all();
    //     $kelas = Kelas::all();
    //     return view('dashboard.entri-pembayaran.index', compact('siswa','kelas'));
    // }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];

        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            // 'jumlah_bayar' => 'required|numeric',
         ], $message);

         if(Siswa::where('nisn',$req->nisn)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
           return back();
            exit;
         endif;


         $siswa = Siswa::where('nisn',$req->nisn)->get();

         foreach($siswa as $val){
            $id_siswa = $val->id;
         }

        $bayar = Pembayaran::create([
            'id_petugas' => auth()->user()->id,
            'id_siswa' => $id_siswa,
            'spp_bulan' => $req->spp_bulan,
            'jumlah_bayar' => str_replace('.','',$req->jumlah_bayar),
            'status' => 'Belum Bayar'
         ]);

         Alert::success('Berhasil!', 'Pembayaran Berhasil di Tambahkan!');

         return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data = [
            'edit' => Pembayaran::find($id),
            'user' => User::find(auth()->user()->id)
         ];
        //  dd($id);
         return view('dashboard.entri-pembayaran.edit', $data);
    }
    public function bayar($id)
    {
        $data = [
            'edit' => Pembayaran::find($id),
            'user' => User::find(auth()->user()->id)
         ];

         return view('dashboard.entri-pembayaran.bayar', $data);
    }

    public function storebayar(Request $req, $id)
    {
         $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];

        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            // 'jumlah_bayar' => 'required',
         ], $message);

         $pembayaran = Pembayaran::find($id);

         $pembayaran->update([
             'spp_bulan' => $req->spp_bulan,
            // 'jumlah_bayar' => str_replace('.','',$req->jumlah_bayar),
            'status'    => 'Bayar'
         ]);
         if(Siswa::where('nisn',$req->nisn)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
           return back();
            exit;
         endif;

         if($req->nisn != $pembayaran->siswa->nisn) :
            $siswa = Siswa::where('nisn',$req->nisn)->get();

            foreach($siswa as $val){
               $id_siswa = $val->id;
            }

            $pembayaran->update([
               'id_siswa' => $id_siswa,
            ]);
         endif;

         Alert::success('Berhasil!', 'Pembayaran berhasil di Edit');
         if(Auth::user()->level != 'siswa')
         {
            return redirect(route('pembayaran.index'));
         }else{
            return redirect(route('dashboard'));
         }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
         $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];

        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            'jumlah_bayar' => 'required'
         ], $message);

         $pembayaran = Pembayaran::find($id);

         $pembayaran->update([
             'spp_bulan' => $req->spp_bulan,
            'jumlah_bayar' => str_replace('.','',$req->jumlah_bayar),
         ]);

         if(Siswa::where('nisn',$req->nisn)->exists() == false):
            Alert::error('Terjadi Kesalahan!', 'Siswa dengan NISN ini Tidak di Temukan');
           return back();
            exit;
         endif;

         if($req->nisn != $pembayaran->siswa->nisn) :
            $siswa = Siswa::where('nisn',$req->nisn)->get();

            foreach($siswa as $val){
               $id_siswa = $val->id;
            }

            $pembayaran->update([
               'id_siswa' => $id_siswa,
            ]);
         endif;

         Alert::success('Berhasil!', 'Pembayaran berhasil di Edit');
         return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Pembayaran::find($id)->delete()) :
            Alert::success('Berhasil!', 'Pembayaran Berhasil di Hapus!');
         else :
            Alert::success('Terjadi Kesalahan!', 'Pembayaran Gagal di Tambahkan!');
         endif;

         return back();
    }

    public function index(Request $request)
    {
        $nisn = $request->nisn;
        $kelas = $request->id_kelas;
        $data =[];
        // $data = [
        //     'pembayaran' => Siswa::with('pembayaran')
        //                     ->orderBy('id', 'DESC')->paginate(10),
        //     'user' => User::find(auth()->user()->id),
        // ];
        // dd($data['pembayaran']);
        if(!empty($nisn))
        {
            $data = [
                'pembayaran' => Siswa::with('pembayaran')
                                ->where('nisn',$nisn)
                                ->orderBy('id', 'DESC')->paginate(10),
                'user' => User::find(auth()->user()->id),
            ];
        }

        if(!empty($kelas))
        {
            $data = [
                'pembayaran' => Siswa::with('pembayaran')
                                ->where('id_kelas',$kelas)
                                ->orderBy('id', 'DESC')->paginate(10),
                'user' => User::find(auth()->user()->id),
            ];
        }
        if(!empty($kelas && $nisn))
        {
            $data = [
                'pembayaran' => Siswa::with('pembayaran')
                                ->where('id_kelas',$kelas)
                                ->where('nisn',$nisn)
                                ->orderBy('id', 'DESC')->paginate(10),
                'user' => User::find(auth()->user()->id),
            ];
        }
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        return view('dashboard.entri-pembayaran.index', compact('siswa','kelas'),$data);
    }

    public function status($id)
    {
        $siswa = Siswa::findOrFail($id);
        // dd($siswa->pembayaran);
        return view('dashboard.entri-pembayaran.status',compact('siswa'));
    }
    public function createpayment($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('dashboard.entri-pembayaran.bayar',compact('siswa'));
    }
    public function storepayment(Request $req, $id)
    {
        // dd($req->all());
         $message = [
            'required' => ':attribute harus di isi',
            'numeric' => ':attribute harus berupa angka',
            'min' => ':attribute minimal harus :min angka',
            'max' => ':attribute maksimal harus :max angka',
         ];

        $req->validate([
            'nisn' => 'required',
            'spp_bulan' => 'required',
            // 'jumlah_bayar' => 'required',
         ], $message);

         $pembayaran = Siswa::find($id);

         $store = Pembayaran::create([
            'id_siswa' => $pembayaran->id,
            'id_petugas' => Auth::user()->id,
            'spp_bulan' => $req->spp_bulan,
            'status'    => 'Sudah Bayar',
            'payment_at' => Carbon::now()->format('Y-m-d'),
            'jumlah_bayar' => $req->jumlah_bayar
         ]);
         Alert::success('Berhasil!', 'Pembayaran berhasil di Lakukan');
         if(Auth::user()->level != 'siswa')
         {
            return redirect(route('pembayaran.index'));
         }else{
            return redirect(route('dashboard'));
         }

    }
}

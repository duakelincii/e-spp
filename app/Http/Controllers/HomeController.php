<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Pembayaran;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->level != 'siswa')
        {
            $data = [
                'user' => User::find(auth()->user()->id),
                'pembayaran' => Pembayaran::orderBy('id', 'desc')->paginate(3),
            ];
        }else{
            $data = [
                'user' => User::find(auth()->user()->id),
                'pembayaran' => Pembayaran::where('id_siswa',Auth::user()->siswa->id)->orderBy('id', 'desc')->paginate(3),
            ];
        }

        return view('dashboard.index', $data);
      }
}

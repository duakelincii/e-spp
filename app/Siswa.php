<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
         'nisn', 'nis', 'nama', 'id_kelas', 'nomor_telp', 'alamat', 'id_spp','user_id'
    ];

   /**
   * Belongs To Siswa -> Spp
   *
   * @return void
   */
    public function spp()
    {
         return $this->belongsTo(Spp::class,'id_spp','id');
    }

   public function pembayaran(){
        return  $this->hasMany(Pembayaran::class,'id_siswa','id');
   }

    public function kelas(){
        return  $this->belongsTo(Kelas::class,'id_kelas');
   }

    public function user(){
        return  $this->belongsTo(User::class,'user_id','id');
   }
}

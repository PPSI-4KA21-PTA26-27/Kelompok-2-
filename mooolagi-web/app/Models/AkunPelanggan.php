<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AkunPelanggan extends Authenticatable
{
    protected $table = 'akun_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = ['kata_sandi'];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}

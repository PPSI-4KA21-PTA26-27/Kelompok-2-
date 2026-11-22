<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProfilKontak extends Model
{
    protected $table = 'profil_kontak';
    protected $primaryKey = 'id_profil';
    public $timestamps = false;
    protected $guarded = [];
}

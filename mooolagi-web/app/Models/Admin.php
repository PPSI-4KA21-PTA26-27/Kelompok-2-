<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = ['kata_sandi'];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}

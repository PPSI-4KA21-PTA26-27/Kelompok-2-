<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';
    protected $primaryKey = 'id_testimoni';
    public $timestamps = false;
    protected $guarded = [];
}


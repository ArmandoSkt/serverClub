<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model{
    protected $table = "clubes";

     protected $fillable = [
        'id', 'nombre',  'tipo', 'id_instructor',
        'imagen', 'video'
     ];

     public $timestamps = false;
}
<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clubalumno extends Model{
    protected $table = "club_alumnos";

     protected $fillable = [
         'id_alumno', 'clave_club'
     ];

     protected $hidden = [
        'created_at', 'updated_at'
    ];
}
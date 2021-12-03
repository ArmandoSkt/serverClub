<?php   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model{
    protected $table = "alumnos";

    
    protected $fillable = [
        'id','folio', 'nombre', 'apellidos',
        'carrera',
        'sexo',
        'edad',
        'telefono',
        'correo',
        'club_alternativo',
        'alergias',
        'situacion_medica',
        'clave_club'
    ];
  
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
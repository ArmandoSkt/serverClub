<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clubalumno;

class ClubalumnoController extends Controller{
    public function index(){
        return Clubalumno::all();
    }

    public function get($id){
        $result = Clubalumno::find($id);
        if($result)
            return $result;
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function create(Request $req){
        $this->validate($req, [
            'id_alumno'=>'required',
            'clave_club'=>'required']);

        $datos = new Clubalumno;
        $result = $datos->fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function update(Request $req, $id){
        $this->validate($req, [
            'id_alumno'=>'filled',
            'clave_club'=>'filled']);

        $datos = Clubalumno::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        $result = $datos->fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function destroy($id){
        $datos = Clubalumno::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        $result = $datos->delete();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }
}
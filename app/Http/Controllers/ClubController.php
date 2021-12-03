<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller{
   /* public function index(){
        return Club::all();
    }*/

    public function index(){
        $result=DB::table('instructores')
        ->join('clubes', 'instructores.id', '=', 'clubes.id_instructor')
        ->select('clubes.*', DB::raw('CONCAT(instructores.nombre, "  ", apellidos) as instructor'))
        ->get();
        if($result)
            return $result;
        else
         return response()->json(['status'=>'failed'], 404);
     }

     public function get($id){
        $result=DB::table('clubes')
        ->join('instructores', 'clubes.id_instructor', '=', 'instructores.id')
        ->select('clubes.*', DB::raw('CONCAT(instructores.nombre, " ", apellidos) as instructor'))
        ->where("clubes.id", "=", $id)
        ->get();
        if($result)
            return $result;
        else
         return response()->json(['status'=>'failed'], 404);
    }
    
    public function nombreClub(){
        $result = DB::select('SELECT nombre FROM clubes');
        if($result)
            return $result;
        else
         return response()->json(['status'=>'failed'], 404);
    }

    public function deportivo(){
        $result = DB::table('clubes')
        ->join('instructores', 'clubes.id_instructor', '=', 'instructores.id')
        ->select('clubes.*', DB::raw('CONCAT(instructores.nombre, " ", apellidos) as instructor'))
        ->where('tipo', 'deportivo')
        ->get();
        if($result)
            return $result;
        else
         return response()->json(['status'=>'failed'], 404);
    }

    public function academico(){
        $result = DB::table('clubes')
        ->join('instructores', 'clubes.id_instructor', '=', 'instructores.id')
        ->select('clubes.*', DB::raw('CONCAT(instructores.nombre, " ", apellidos) as instructor'))
        ->where('tipo', 'academico')
        ->get();
        if($result)
            return $result;
        else
         return response()->json(['status'=>'failed'], 404);
    }

    public function cultural(){
        $result = DB::table('clubes')
        ->join('instructores', 'clubes.id_instructor', '=', 'instructores.id')
        ->select('clubes.*', DB::raw('CONCAT(instructores.nombre, " ", apellidos) as instructor'))
        ->where('tipo', 'CULTURAL')
        ->get();
        if($result)
            return $result;
        else
         return response()->json(['status'=>'failed'], 404);
    }

    public function create(Request $req){
        $this->validate($req, [
            'nombre'=>'required',
            'tipo'=>'required',
            'id_instructor'=>'required', 
            'imagen'=>'required',
            'video'=>'required']);

        $datos = new Club;
        if($req->hasFile("imagen")){
            $nombreArchvo = $req->file("imagen")->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp."_".$nombreArchvo;
            $carpetaDes ="./upload/";
            $req->file("imagen")->move($carpetaDes, $nuevoNombre);

             $datos->nombre = $req->nombre;  
             $datos->tipo = $req->tipo;  
             $datos->id_instructor = $req->id_instructor;
             $datos->imagen = ltrim($carpetaDes,".").$nuevoNombre;
             $datos->video = $req->video;
             $result = $datos->save();
        }
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function update(Request $req, $id){
        /*$this->validate($req, [
            'nombre'=>'filled',
            'tipo'=>'filled',
            'id_instructor'=>'filled',
            'imagen'=>'filled' ]);*/

            $datos = Club::find($id);

            if($req->hasFile("imagen")){
                if($datos){
                    $ruta = base_path("public").$datos->imagen;
        
                    if(file_exists($ruta)){
                        unlink($ruta);
                    }
                    $datos->delete();
                }
                
                $nombreArchvo = $req->file("imagen")->getClientOriginalName();
                $nuevoNombre = Carbon::now()->timestamp."_".$nombreArchvo;
                $carpetaDes ="./upload/";
                $req->file("imagen")->move($carpetaDes, $nuevoNombre);
                                  
                $datos->imagen = ltrim($carpetaDes,".").$nuevoNombre;
                $datos->save();
            }
    
            if($req->input("nombre")){
                $datos->nombre = $req->input("nombre");
            }
            if($req->input("tipo")){
                $datos->tipo = $req->input("tipo");
            }
            if($req->input("id_instructor")){
                $datos->id_instructor = $req->input("id_instructor");
            }
            if($req->input("video")){
                $datos->video = $req->input("video");
            }
            //$datos->save();
    
            if(!$datos) return response()->json(['status'=>'failed'], 404);
            $result = $datos->save();
            if($result)
                return response()->json(['status'=>'success'], 200);
            else
                return response()->json(['status'=>'failed'], 404);
    }

    public function destroy($id){
        $datos = Club::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        if($datos){
            $ruta = base_path("public").$datos->imagen;
            if(file_exists($ruta)){
                unlink($ruta);
            }
            $result = $datos->delete();
        }
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }
}
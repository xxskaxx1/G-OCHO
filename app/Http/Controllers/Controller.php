<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $users = DB::table('users as u')
        ->select('u.id','u.name','u.documento','u.genero','u.telefono','rol.nombre as rol','e.nombre as eps',DB::Raw('TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE()) AS edad'))
        ->join('tb_roles as rol', 'rol.id', 'u.rol_id')
        ->join('tb_eps as e', 'e.id', 'u.eps_id')
        ->get();
        foreach($users as $key => $user){
            $users[$key]->color = '';
            if($users[$key]->edad>50) {
                $users[$key]->color = '#FA5858';
            }elseif($users[$key]->edad<18){
                $users[$key]->color = '#BCF5A9';
            }
        }
        $roles = DB::table('tb_roles')->get();
        $eps = DB::table('tb_eps')->get();
        return view('dashboard',compact('users','roles','eps'));
    }
    public function addUser(Request $request){
        if ($request->password == $request->password_c) {
            try{
                $tabla = new User;
                $tabla->name = $request->name; 
                $tabla->documento = $request->documento; 
                $tabla->genero = $request->genero; 
                $tabla->email = $request->email; 
                $tabla->telefono = $request->telefono; 
                $tabla->fecha_nacimiento = $request->fecha_nacimiento; 
                $tabla->eps_id = $request->eps_id; 
                $tabla->rol_id = $request->rol_id; 
                $tabla->password = Hash::make($request->password); 
                $tabla->save();
                return 1;
            }catch(\Exception $e){
                \DB::rollBack();
                return 'Error al guardar el registro: '.$e;
            }
        }else{
            return "Error, la contraseña no coincide";
        }
    }
    public function ediUser(Request $request){
        try{
            $tabla = User::find($request->id_usuario_edi);
            $tabla->name = $request->name;
            $tabla->documento = $request->documento;
            $tabla->genero = $request->genero;
            $tabla->email = $request->email;
            $tabla->telefono = $request->telefono;
            $tabla->fecha_nacimiento = $request->fecha_nacimiento;
            $tabla->eps_id = $request->eps_id;
            $tabla->rol_id = $request->rol_id;
            $tabla->save();
            return 1;
        }catch(\Exception $e){
            \DB::rollBack();
            return 'Error al editar el registro: '.$e;
        }
    }
    public function delUser(Request $request){
        //dd($request->id_usuario_del);
        try{
            $tabla = User::find($request->id_usuario_del);
            $tabla->delete();
            return 1;
        }catch(\Exception $e){
            \DB::rollBack();
            return 'Error al eliminar el registro: '.$e;
        }
    }
    public function actualiza(){
        $users = DB::table('users as u')
        ->select('u.id','u.name','u.documento','u.genero','u.telefono','rol.nombre as rol','e.nombre as eps',DB::Raw('TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE()) AS edad'))
        ->join('tb_roles as rol', 'rol.id', 'u.rol_id')
        ->join('tb_eps as e', 'e.id', 'u.eps_id')
        ->get();
        foreach($users as $key => $user){
            $users[$key]->color = '';
            if($users[$key]->edad>50) {
                $users[$key]->color = '#FA5858';
            }elseif($users[$key]->edad<18){
                $users[$key]->color = '#BCF5A9';
            }
        }
        return $users;
    }
    public function getUsuario(Request $request){
        $users = DB::table('users as u')
        ->select('u.id','u.name','u.documento','u.email','u.fecha_nacimiento','u.genero','u.telefono','rol.id as id_rol','rol.nombre as rol','e.id as id_eps','e.nombre as eps',DB::Raw('TIMESTAMPDIFF(YEAR,fecha_nacimiento,CURDATE()) AS edad'))
        ->join('tb_roles as rol', 'rol.id', 'u.rol_id')
        ->join('tb_eps as e', 'e.id', 'u.eps_id')
        ->where('u.id', $request->id_usuario)
        ->get();
        foreach($users as $key => $user){
            $users[$key]->color = '';
            if($users[$key]->edad>50) {
                $users[$key]->color = '#FA5858';
            }elseif($users[$key]->edad<18){
                $users[$key]->color = '#BCF5A9';
            }
        }
        return $users;
    }
}

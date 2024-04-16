<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserGroup;
use DragonCode\Support\Facades\Helpers\Arr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function list()
    {
        //all recuperar todos nuestris registros
        $users=User::all();
        return view('admin.admin.list',compact('users'));
    }
    public function add(){
        $rol=UserGroup::all();
        return view('admin.admin.created',compact('rol'));
    }
    public function insert(StoreUserRequest $request){
        try {
            DB::beginTransaction();
                //Verificar si se sube una imagen
                $user=new User();
                if($request->hasFile('image')){
                    $name=$user->hanbleUploadImage($request->file('image'));
                }else{
                    $name=null;
                }
                //Encriptar la contraseña
                $fieldHash=Hash::make($request->password);
                //Modificar el valor de password en nuestro request
                $request->merge(['password'=>$fieldHash]);

                $user->fill([
                     'dni'=>$request->dni,
                     'names'=>$request->names,
                     'surnames'=>$request->surnames,
                     'phone'=>$request->phone,
                     'email'=>$request->email,
                     'password'=>$fieldHash,
                     'user_level'=>$request->user_level,
                     'status'=>$request->status,
                     'image'=>$name
                ]);
                $user->save();
            DB::commit();
       } catch (Exception $e) {
            DB::rollBack();
       }
       return redirect('admin/admin/list')->with('success','Usuario Registrado'); 
    }
    public function consultarDNI(Request $request)
    {
        // Datos
        $token = 'apis-token-7996.PIiKyia80PyE1SFB7pFSdgtIclJJpaKj';
        $dni = $request->dni;
        
        // Llamar a la API
        $response = Http::withHeaders([
            'Referer' => 'https://apis.net.pe/consulta-dni-api',
            'Authorization' => 'Bearer ' . $token
        ])->get('https://api.apis.net.pe/v2/reniec/dni', [
            'numero' => $dni
        ]);

        // Retornar los datos en formato JSON
        return $response->json();
    }
    public function edit($id){
        $user= User::find($id);;
        $rol=UserGroup::all();
        //Para verificar si id de la ruta exita
        if(!empty($user)){
            //Si carga la vista con los datos
            return view('admin.admin.edit',compact('user','rol'));
        }else{
            //Error 404
            return view('admin.page.404');
        }
    }
    public function update($id,Request $request){
        //Valiadaciones
        request()->validate([
            'dni'=>'required|max:8|unique:users,dni,'.$id,
            'email'=>'required|email|max:255|unique:users,email,'.$id,
            'phone'=>'required|max:9|unique:users,phone,'.$id,
            'password'=>'same:password_confirm',
            'user_level'=>'required|integer|exists:user_groups,group_level',
            'status'=>'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        //Modelo user
        $user=User::find($id);
        //Editar al usuario
        if($request->hasFile('image')){
            $name=$user->hanbleUploadImage($request->file('image'));
            //Eliminar si existiese una img
            if(Storage::disk('public')->exists('perfiles/'.$user->imge_path)){
                Storage::disk('public')->delete('perfiles/'.$user->img_path);
            }
        }else{
            $name=$user->image;
        }
        //Comprobar el password y aplicar el Hash
        if(empty($request->password)){
            $requestData = Arr::except($request->all(), ['password']);
        } else {
            $fieldHash = Hash::make($request->password);
            $requestData = $request->all();
            $requestData['password'] = $fieldHash;
        }

        //Atributos Actualizar
            $user->phone = $requestData['phone'];
            $user->email = $requestData['email'];
            $user->status = $requestData['status'];
            $user->user_level = $requestData['user_level'];
            $user->image = $name;

        // Verificar si la clave 'password' está presente en $requestData antes de asignarla
        if (isset($requestData['password'])) {
            $user->password = $requestData['password'];
        }

        $user->save();
        return  redirect('admin/admin/list')->with('success','El Usuario '.$user->names.' fue actualizado');
    }
    public function delete($id){
        $user=User::find($id);
        $user->delete();
        return redirect('admin/admin/list')->with('success','El Usuario '.$user->names.' fue eliminado'); 
    }    

}

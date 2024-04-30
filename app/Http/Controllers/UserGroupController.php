<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserGroup;
use App\Models\User;
use App\Models\UserGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
    public function list()
    {
        //all recuperar todos nuestros registros
        $roles=UserGroup::orderBy('group_level','asc')->get();
        $admin=User::where('user_level',1)->count();
        $secretary=User::where('user_level',2)->count();
        $doctor=User::where('user_level',3)->count();
        return view('admin.rol.list',compact('roles','admin','secretary','doctor'));
    }
    public function add(){
        return view('admin.rol.created');
    }
    public function insert(StoreUserGroup $request){
        try {
            DB::beginTransaction();
                $usergroup=new UserGroup();
                $usergroup->fill([
                     'group_level'=>$request->group_level,
                     'group_status'=>$request->group_status,
                     'slug'=>$request->slug
                ]);
                $usergroup->save();
            DB::commit();
       } catch (Exception $e) {
            DB::rollBack();
       }
       return redirect('admin/rol/list')->with('success','Rol Registrado'); 
    }
    public function edit(UserGroup $usergroup){
        if(!empty($usergroup)){
            //Si carga la vista con los datos
            return view('admin.rol.edit',compact('usergroup'));
        }else{
            //Error 404
            return view('page.404');
        }
    }
    public function update(UserGroup $usergroup,Request $request){
        //Valiadaciones
        request()->validate([
            'group_level'=>'required|unique:user_groups,group_level,'.$usergroup->id,
            'group_status'=>'required',
            'slug'=>'required|max:10|unique:user_groups,slug,'.$usergroup->id
        ],[],[
            'group_level'=>'nivel de grupo',
            'slug'=>'enlace'
        ]);
        //Modelo user
        $usergroup->group_level=$request->group_level;
        $usergroup->group_status=$request->group_status;
        $usergroup->slug=$request->slug;
        $usergroup->save();
        return  redirect('admin/rol/list')->with('success','El rol '.$usergroup->slug. ' fue actualizado');
    }
    public function delete($id){
        $usergroup=UserGroup::find($id);
        $usergroup->delete();
        return redirect('admin/rol/list')->with('success','El rol fue eliminado'); 
    }    

}

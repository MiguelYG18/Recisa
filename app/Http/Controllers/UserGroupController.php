<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserGroup;
use App\Models\UserGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
    public function list()
    {
        //all recuperar todos nuestros registros
        $roles=UserGroup::all();
        return view('admin.rol.list',compact('roles'));
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
                ]);
                $usergroup->save();
            DB::commit();
       } catch (Exception $e) {
            DB::rollBack();
       }
       return redirect('admin/rol/list')->with('success','Rol Registrado'); 
    }
    public function edit($id){
        $usergroup= UserGroup::find($id);;
        if(!empty($usergroup)){
            //Si carga la vista con los datos
            return view('admin.rol.edit',compact('usergroup'));
        }else{
            //Error 404
            return view('admin.page.404');
        }
    }
    public function update($id,Request $request){
        //Valiadaciones
        request()->validate([
            'group_level'=>'required|unique:user_groups,group_level,'.$id,
            'group_status'=>'required'
        ]);
        //Modelo user
        $usergroup=UserGroup::find($id);
        $usergroup->group_level=$request->group_level;
        $usergroup->group_status=$request->group_status;
        $usergroup->save();
        return  redirect('admin/rol/list')->with('success','El rol fue actualizado');
    }
    public function delete($id){
        $usergroup=UserGroup::find($id);
        $usergroup->delete();
        return redirect('admin/rol/list')->with('success','El rol fue eliminado'); 
    }    

}

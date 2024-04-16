<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpecializationRequest;
use App\Models\Specialization;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecializationController extends Controller
{
    public function list(){

        $specializations=Specialization::all();
        return view('admin.specialization.specialization',compact('specializations'));
    }
    public function insert(StoreSpecializationRequest $request){
        try {
            DB::beginTransaction();
                $specialization=new Specialization();
                $specialization->fill([
                     'name'=>$request->name_insert,
                     'quantity_voucher'=>$request->quantity_voucher_insert,
                ]);
                $specialization->save();
            DB::commit();
       } catch (Exception $e) {
            DB::rollBack();
       }
       return redirect('admin/specialization')->with('success','Especialidad Registrada'); 
    }
    public function update($id,Request $request){
        //Valiadaciones
        request()->validate([
            'quantity_voucher_update' => 'required'
        ], [], [
            'quantity_voucher_update' => 'cupos' 
        ]);
        //Modelo user
        $specialization=Specialization::find($id);
        $specialization->quantity_voucher=$request->quantity_voucher_update;
        $specialization->save();
        return  redirect('admin/specialization')->with('success','La cantidad de cupos de la especilidad '.$specialization->name.' fue actualizado');
    }
    public function delete($id){
        $specialization=Specialization::find($id);
        $specialization->delete();
        return redirect('admin/specialization')->with('success','La especialización '.$specialization->name.' fue eliminado'); 
    }    
}

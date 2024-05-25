<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
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

    public function addPatient(){
        $rol=UserGroup::all();
        return view('admin.admin.createdPatient',compact('rol'));
    }

    public function addHistoryPatient(){
        $rol=UserGroup::all();
        return view('patient.createdHistoryPatient',compact('rol'));
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
    public function edit($slug)
    {
        // Buscar al usuario cuyo slug generado coincide con el parámetro
        $user = User::all()->firstWhere(function ($user) use ($slug) {
            return $user->slug === $slug;
        });
        if(empty($user)){
            return view('page.404');
        }
        $rol = UserGroup::all();
        return view('admin.admin.edit', compact('user', 'rol'));
    }
    public function update($slug, Request $request)
    {
        // Generar el slug dinámicamente
        $generatedSlug = Str::slug($slug);

        // Buscar al usuario cuyo slug generado coincide con el parámetro
        $user = User::all()->firstWhere(function ($user) use ($generatedSlug) {
            return $user->slug === $generatedSlug;
        });
        // Validaciones
        request()->validate([
            'dni' => 'required|regex:/^[0-9]{8}$/|unique:users,dni,' . $user->id,
            'names'=>'required|string|regex:/^[\pL\s]+$/u|max:25',
            'surnames'=>'required|string|regex:/^[\pL\s]+$/u|max:25',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email, '.$user->id,
                function ($attribute, $value, $fail) {
                    $allowedDomains = ['outlook.com', 'hotmail.com','gmail.com'];
                    $domain = explode('@', $value)[1];
                    if (!in_array($domain, $allowedDomains)) {
                        $fail("El dominio del correo electrónico no está permitido.");
                    }
                },
            ],
            'phone' => 'required|regex:/^[0-9]{9}$/|unique:users,phone,' . $user->id,
            'password' => 'sometimes|nullable|same:password_confirm',
            'user_level' => 'required|integer|exists:user_groups,group_level',
            'status' => 'required'
        ]);

        // Actualizar campos del usuario
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->user_level = $request->user_level;

        // Actualizar contraseña si se proporcionó
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/admin/list')->with('success', 'El Usuario ' . $user->names . ' fue actualizado');
    }
    public function photo($slug, Request $request){
        // Generar el slug dinámicamente
        $generatedSlug = Str::slug($slug);

        // Buscar al usuario cuyo slug generado coincide con el parámetro
        $user = User::all()->firstWhere(function ($user) use ($generatedSlug) {
            return $user->slug === $generatedSlug;
        });
        // Validaciones
        request()->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2000',
        ]);
        // Manejo de imágenes y actualización del modelo
        if ($request->hasFile('image')) {
            $name = $user->hanbleUploadImage($request->file('image'));
            if (Storage::disk('public')->exists('perfiles/' . $user->image_path)) {
                Storage::disk('public')->delete('perfiles/' . $user->image_path);
            }
        } else {
            $name = $user->image;
        }
        $user->image = $name;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'La foto de perfil del usuario '. $user->names . ' fue actualizado');
    }
    
    public function delete($id){
        $user=User::find($id);
        $user->delete();
        return redirect('admin/admin/list')->with('success','El Usuario '.$user->names.' fue eliminado'); 
    }
    public function reporte(){
        // Obtener todos los usuarios
        $users = User::all(); // O personaliza la consulta si es necesario
        // Cargar la vista y pasar los datos de los usuarios
        $view = View::make('admin.reporte.report', ['users' => $users]);
        // Obtener el contenido HTML de la vista
        $html = $view->render();
        // Crear una instancia de mPDF
        $mpdf = new Mpdf();
        // Configurar el pie de página centrado
        $footerHtml = '<footer>Página {PAGENO} de {nbpg}</footer>';
        $mpdf->SetHTMLFooter($footerHtml);      
        // Escribir el contenido HTML en el PDF
        $mpdf->WriteHTML($html);
        // Devolver el PDF como respuesta
        return response($mpdf->Output('reporte_usuarios.pdf', 'I')) // 'I' para Inline, 'D' para Descargar
            ->header('Content-Type', 'application/pdf');  
    }    

}

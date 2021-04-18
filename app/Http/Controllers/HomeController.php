<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ColasEmail;
use App\User;
use App\EmailList;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $pagina;
    private $paginas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->paginas = array(5,10,15,50,100);
        $this->pagina = 5;
        
    }

    /**
     * Datos de usuarios
     * Listado de usuarios con las acciones de modificar y eliminar
     */
    public function index(Request $request){ 
        $user = \Auth::user();
        
        if(!empty($request->pagina)){
                $cantidad = $request->pagina;
        }else{
                $cantidad = $this->pagina;
        }
       // $cantidad = 5;
        if($user->rol == 'admin'){
            $users = User::paginate($cantidad);
            $paginas = $this->paginas;
        }else{ 
            $users = $user;
            $paginas = $this->pagina;
        }
        return view('home')->with(compact('users','paginas','cantidad')); // listado
    }
    /**
     * Editar datos del usuario
     */
    public function edit($id){
        $user = User::find($id); //obtener user id
        return view('editar')->with(compact('user','id'));

    }
    /**
     * Actualizar datos del usuario
     */
    public function update(Request $request, $id){
        
        Log::error("update()->request. (request: ".json_encode($request).")");

        //Validar
        $this->validate($request, User::$rules, User::$messages);
        
        $user = User::find($id);
        $user->nombre = $request->input('nombre');
        $user->numero_celular = $request->input('numero_celular');
        $user->save(); // update
        Log::info(array("update()->save", $user));

        return redirect('/home');
    }
    /**
     * Eliminar usuario
     */
    public function destroy($id){
    
        $user = User::find($id);
        $user->delete(); // delete

        return back();
    }
    /**
     * Buscar de resgistro por nombre, email, cedula y celular
     */
    public function search(Request $request){

        if(!empty($request->pagina)){
                $cantidad = $request->pagina;
        }else{
                $cantidad = $this->pagina;
        }
        
        $users = User::where('nombre','like','%'.$request->search.'%')
                ->orWhere('email','like','%'.$request->search.'%')
                ->orWhere('numero_celular','=',$request->search)
                ->orWhere('cedula','=',$request->search)                    
                ->paginate($cantidad);
        $paginas = $this->paginas;
        $buscar = $request->search;
        
        
        return view('home')->with(compact('users','paginas','cantidad','buscar'));

    }
    /**
     * Mostrar formulario de envio de email
     */
    public function formShowEmail(){
        $user = \Auth::user();
        
        return view('email_form')->with(compact('user'));
    }
    /**
     * Almacenamos los correos en la tabla jobs.
     * Guardamos los correos en la tabla email.
     */
    public function formStoredEmail(Request $request){
        $user = \Auth::user();
       
        $array_email = array(
            'nombre_from' => $user->nombre,
            'email_from' => $user->email,
            'email_to' => $request->email,
            'asunto' => $request->asunto,
            'mensaje' => $request->mensaje,
        );

        $envio = Mail::to($request->email)
        ->cc($user->email)
        //->send(new ColasEmail($array_email));
        ->queue(new ColasEmail($array_email));

         $email = new EmailList();
         $email->user_id = $user->id;
         $email->asunto = $request->asunto;
         $email->mensaje = $request->mensaje;
         $email->email_to = $request->email;
         $email->save();

        
        return view('email_form')->with(compact('user'));
    }
    /**
     * Listado de correos
     */
    public function emailList(){ 
        $user = \Auth::user();
        $list = EmailList::find($user->id)->paginate(10); 
       
        return view('email_list')->with(compact('list')); // listado
    } 

}

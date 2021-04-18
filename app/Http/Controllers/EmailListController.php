<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailListController extends Controller
{
	private $pagina;
    private $paginas;

    public function __construct()
    {
        $this->middleware('auth');
        $this->paginas = array(5,10,15,50,100);
        $this->pagina = 5;
        
    }

 	public function listaCorreos(Request $request){

	 	$datos = $this->api();

	    if(!empty($request->pagina)){
	            $cantidad = $request->pagina;
	    }else{
	            $cantidad = $this->pagina;
	    }
	  
	    $paginas = $this->paginas;

	    return view('api_form')->with(compact('datos','paginas','cantidad')); // listado

 	}


    public function api(){
        
        $data = '{
                    "password": "123456789",
                    "user": "aninimo",
                }';
        
        $response = $this->apiCall("https://api-email", "POST", $data);
        Log::error(array("apiCall()->response", $response));
        
        //datos de prueba
 		$response = array(1 => array(
        						   'id'=>'1',
        						   'remitente'=>'alejandrocien1@gmail.com',
        						   'destinatario'=>'destino@hotmail.com',
        						   'asunto'=>'prueba',
        						   'mensaje'=>'1',
        						   'estado'=>'0',
        						   'fecha_creacion'=>'2020-01-18',
			        			),
        				2 => array(
        						   'id'=>'2',
        						   'remitente'=>'jjuan@gmail.com',
        						   'destinatario'=>'destino1@hotmail.com',
        						   'asunto'=>'prueba1',
        						   'mensaje'=>'1',
        						   'estado'=>'0',
        						   'fecha_creacion'=>'2020-01-18',

			        			),
        				3 => array(
        						   'id'=>'3',
        						   'remitente'=>'pedro@gmail.com',
        						   'destinatario'=>'destino2@hotmail.com',
        						   'asunto'=>'prueba2',
        						   'mensaje'=>'1',
        						   'estado'=>'1',
        						   'fecha_creacion'=>'2020-01-18',

			        			)
        			);
        return $response;
    }

    public function apiCall($url, $type, $data = ""){
        
        if($ch = curl_init($url)){
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
         //   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
               curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            $output = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $err = curl_error($ch);

            curl_close($ch);

            $output = json_decode($output, true);

            if(!$output){
                $response = array( 'status' => 'ERROR','answer' => array('errorMessage' => 'cURL Error #:00001'.$err));
            }else{

                $response = $output;
            }

        }else{  

            $response = array( 'status' => 'ERROR','answer' => array('errorMessage' => 'cURL Error #:00002, error connecting to service')); 
        }

        return $response;
    }
}

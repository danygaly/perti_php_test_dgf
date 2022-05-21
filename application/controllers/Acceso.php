<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Acceso extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('clean');
        $this->load->library('herramientas');
        $this->load->helper('input_helper');
        $this->load->helper('usuario_helper');
        $this->load->helper('expect_helper');
        $this->load->helper('form');            
        $this->load->helper('url'); 
        $this->load->model('user_model', 'user', TRUE);
    }
    
    public function index(){
        $header_data['title'] = "header";
        $footer_data = 0;  
        $contenido_data['title'] = "reg";
        $template['titulo'] = "Iniciar Sesión";
        $template['header'] = $this->load->view('login/header',$header_data,true);
        $template['login'] = $this->load->view('login/login',$header_data,true);
        $template['registro'] = $this->load->view('login/registro_usuario',$header_data,true);
        $template['footer'] = $this->load->view('login/footer',$footer_data,true);
		$this->load->view('main_login',$template);
    }

    public function addUser(){
		$data = array(
            array('field' => 'nombre',
              'label' => 'nombre',
              'rules' => 'trim|required'
             ),
            array('field' => 'telefono',
              'label' => 'telfono',
              'rules' => 'trim|required'
            ),
            array('field' => 'correo',
                'label' => 'correo',
                'rules' => 'trim|required'
            ),
            array('field' => 'confirma_correo',
                'label' => 'confirmar.correo',
                'rules' => 'trim|required'
            ),
            array('field' => 'rfc',
                'label' => 'rfc',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'notas',
                'label' => 'correo',
                'rules' => 'trim|required'
               ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            )
        );
        $message_invalido = 'Debe llenar todos los campos.';
        $nombre = $this->input->post('nombre');
        $telefono = $this->input->post('telefono');
        $correo = $this->input->post('correo');
        $confirma_correo = $this->input->post('confirma_correo');
        $rfc = $this->input->post('rfc');
        $notas = $this->input->post('notas');
        $password = $this->input->post('password');

		if(is_empty($correo) || is_empty($password) || is_empty($nombre) || is_empty($telefono) || is_empty($confirma_correo) || is_empty($rfc) || is_empty($notas)) {
			$result['error'] = true;
            $result['msg'] = $message_invalido;
            print (json_encode($result));
            return false;
		}

        if(!is_mail($correo) || !is_mail($confirma_correo)) {
            $message_invalido = 'Debe introducir un correo valido.';
			$result['error'] = true;
            $result['msg'] = $message_invalido;
            print (json_encode($result));
            return false;
		}

        if(!($correo  == $confirma_correo)) {
            $message_invalido = 'La confirmacion de correo no es valida.';
			$result['error'] = true;
            $result['msg'] = $message_invalido;
            print (json_encode($result));
            return false;
		}

        if(!is_phone($telefono)) {
            $message_invalido = 'Debe introducir un telefono con formato valido.';
			$result['error'] = true;
            $result['msg'] = $message_invalido;
            print (json_encode($result));
            return false;
		}

        $this->form_validation->set_rules($data);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombre' => form_error('nombre'),
                'telefono' => form_error('telefono'),
                'correo' => form_error('correo'),
                'confirma_correo' => form_error('confirma_correo'),
                'rfc' => form_error('rfc'),
                'notas' => form_error('notas'),
                'password '=> form_error('password')
            );
        }else{
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'telefono' => $this->input->post('telefono'),
                'correo' => $this->input->post('correo'),
                'rfc' => $this->input->post('rfc'),
                'notas' => $this->input->post('notas'),
                'password' => hash('sha256', $this->input->post('password'))
            );
            $usuario_repetido = $this->repeatUser($data);
            if(!$usuario_repetido){
                $id_user = (int) $this->user->addUser($data);
                if($id_user){
                    $result['error'] = false;
                    $result['msg'] ='Usuario agregado correctamente';
                    $redirect_login = site_url('/');
                }else{
                    $result['error'] = true;
                    $result['msg'] ='Ha ocurrido un error con el registro.';
                }
            }else{
                $result['error'] = true;
                $result['msg'] ='Este usuario ya ha sido registrado previamente';
            }
        }
        print json_encode($result);
    }

    public function iniciar_sesion($id){
		
        $user = $this->user_model->get_user_by_id($id);
        
        $nombre = $user->nombre;
        $telefono = $user->telefono;
        $rfc = $user->rfc;
        $correo = $user->correo;
        $notas = $user->notas;

        $sess_array = array(
			'id' => $id,
			'nombre'=>$nombre,
            'telefono'=>$telefono,
            'rfc'=>$rfc,
            'notas'=>$notas,
            'correo'=>$correo
        );
        $this->session->set_userdata('logged_in', $sess_array);
        return site_url('desktop');
    }

    public function logUser(){
        $message_invalido = 'Debe llenar todos los campos.';

        $mail = $this->clean->xss_clean($this -> input -> post('correo'));
        $password = $this->clean->xss_clean($this -> input -> post('password'));

		if(is_empty($mail) || is_empty($password)) {
			$result['error'] = true;
            $result['msg'] = $message_invalido;
            print (json_encode($result));
            return false;
		}

		$db_user = $this->user_model->get_user_by_mail($mail);

		if( is_null($db_user) ) {
            $result['error'] = true;
            $result['msg'] = 'Este usuario no está registrado en la aplicación.';
            print (json_encode($result));
            return false;
		}

        $password = hash('sha256', $password);
        //Se debe realizar la consulta e igualdad con el dato password en sha256
        if( is_not_equal($db_user->password, $password) ) {
            $result['error'] = true;
            $result['msg'] = 'Contraseña incorrecta.';
            print (json_encode($result));
            return false;
		}

        //Se debe realizar la consulta e igualdad con el dato password en sha256
        if( strictEqual($db_user->password, $password) ) {
            $result['error'] = false;
            $result['msg'] = 'Accediendo';

            $this->iniciar_sesion($db_user->id);
            $redirect_login = site_url('desktop');
            
            $result['url'] = $redirect_login;
            
            print (json_encode($result));
            return true;
		}
    }

    function repeatUser($data){
        $result = false;
        if($this->user->get_user_by_mail($data['correo'])){
            $result = true;
        }
        return $result;
    }

    function cerrar_sesion(){
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
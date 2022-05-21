<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->library('clean');
        $this->load->library('herramientas');
        $this->load->helper('input_helper');
        $this->load->helper('usuario_helper');
        $this->load->helper('expect_helper');
        $this->load->helper('form');            
        $this->load->helper('url'); 
        $this->load->model('user_model','user');
    }

    public function get_users(){
        $query=  $this->user->get_data_users();
            if($query){
                $result['users']  = $this->user->get_data_users();
            }
        echo json_encode($result);
    }

    public function get_user($id){
        $query=  $this->user->get_user_by_id($id);
        $result  = null;
        if($query){
            $result  = $this->user->get_user_by_id($id);
        }
        echo json_encode($result);
    }

    public function crear_usuario(){
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
        $rfc = $this->input->post('rfc');
        $notas = $this->input->post('notas');
        $password = $this->input->post('password');

		if(is_empty($correo) || is_empty($password) || is_empty($nombre) || is_empty($telefono) || is_empty($rfc) || is_empty($notas)) {
			$result['error'] = true;
            $result['msg'] = $message_invalido;
            print (json_encode($result));
            return false;
		}

        if(!is_mail($correo)) {
            $message_invalido = 'Debe introducir un correo valido.';
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

    public function actualizar_usuario($id){
        $config = array(
            array('field' => 'nombre',
              'label' => 'nombre',
              'rules' => 'trim|required'
             ),
            array('field' => 'telefono',
              'label' => 'telefono',
              'rules' => 'trim|required'
            ),
            array('field' => 'correo',
                'label' => 'correo',
                'rules' => 'trim|required'
            ),
            array('field' => 'rfc',
                'label' => 'rfc',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombre' => form_error('nombre'),
                'telefono' => form_error('telefono'),
                'correo' => form_error('correo'),
                'rfc' => form_error('rfc')
            );
        }else{
            $id = $id;
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'telefono' => $this->input->post('telefono'),
                'correo' => $this->input->post('correo'),
                'rfc' => $this->input->post('rfc')
            );
            if($this->user->updateUser($id,$data)){
                $result['error'] = false;
                $result['success'] = 'Usuario actualizado correctamente';
            }
        }
        echo json_encode($result);
    }

    function repeatUser($data){
        $result = false;
        if($this->user->get_user_by_mail($data['correo'])){
            $result = true;
        }
        return $result;
    }

    public function deleteUser(){
        $id = $this->input->post('id');
        if($this->user->deleteUser($id)){
            $msg['error'] = false;
            $msg['success'] = 'Usuario eliminado correctamente';
        }else{
            $msg['error'] = true;
        }
        print(json_encode($msg));
    }

    public function searchUser(){
        $value = $this->input->post('text');
        $query =  $this->user->searchUser($value);
        if($query){
            $result['users']= $query;
        }           
        echo json_encode($result);         
    }

}
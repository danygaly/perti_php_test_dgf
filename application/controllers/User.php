<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{
    function __construct(){
        parent::__construct();
         $this->load->model('user_model','user');
    }

    public function showAll(){
        $query=  $this->user->getAllUsers();
            if($query){
                $result['users']  = $this->user->getAllUsers();
            }
        echo json_encode($result);
    }

    public function addUser(){
		$data = array(
            array('field' => 'nombre_escuela',
              'label' => 'nombre_escuela',
              'rules' => 'trim|required'
             ),
            array('field' => 'cct',
              'label' => 'cct',
              'rules' => 'trim|required'
            ),
            array('field' => 'estado',
                'label' => 'estado',
                'rules' => 'trim|required'
            ),
            array('field' => 'nombre_director',
                'label' => 'nombre_director',
                'rules' => 'trim|required'
            ),
            array('field' => 'correo_colegio',
                'label' => 'mail.colegio',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'correo',
                'label' => 'correo',
                'rules' => 'trim|required'
               ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($data);
        if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'nombre_escuela' => form_error('nombre_escuela'),
                'cct' => form_error('cct'),
                'estado' => form_error('estado'),
                'nombre_director' => form_error('nombre_director'),
                'correo_colegio' => form_error('correo_colegio'),
                'correo' => form_error('correo'),
                'password '=> form_error('password')
            );
        }else{
            $data = array(
                'nombre_escuela' => $this->input->post('nombre_escuela'),
                'cct' => $this->input->post('cct'),
                'estado' => $this->input->post('estado'),
                'nombre_director' => $this->input->post('nombre_director'),
                'correo_colegio' => $this->input->post('correo_colegio'),
                'correo' => $this->input->post('correo'),
                'password' => hash('sha256', $this->input->post('password'))
                
            );
            if($this->user->addUser($data)){
                $result['error'] = false;
                $result['msg'] ='Usuario agregado correctamente';
                $result['id_usuario'] = (int)$this->user->addUser($data);
            }
        }
        echo json_encode($result);
    }

    public function updateUser(){
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
            ),
            array('field' => 'password',
                'label' => 'password',
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
                'rfc' => form_error('rfc'),
                'password' => form_error('password')
            );
        }else{
            $id = $this->input->post('id');
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'telefono' => $this->input->post('telefono'),
                'correo' => $this->input->post('correo'),
                'rfc' => $this->input->post('rfc'),
                'password' => hash('sha256', $this->input->post('password'))
            );
            if($this->user->updateUser($id,$data)){
                $result['error'] = false;
                $result['success'] = 'Usuario actualizado correctamente';
            }
        }
        echo json_encode($result);
    }


}
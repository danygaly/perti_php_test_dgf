<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Desktop extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('clean');
        $this->load->helper('input_helper');
        $this->load->helper('usuario_helper');
        $this->load->helper('expect_helper');
        $this->load->helper('form');            
        $this->load->helper('url'); 
        $this->load->model('user_model', '', TRUE);
    }
    public function index(){
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $header_data['nombre'] = $session_data['nombre'];
            $header_data['mail'] = $session_data['correo'];
            $footer_data['title'] = "footer";
            $contenido_data['usuarios'] = $this->user_model->getAllUsers();
            $template['titulo'] = "Usuarios Registrados";
            $template['header'] = $this->load->view('commons/header',$header_data,true);
            $template['contenido'] = $this->load->view('users/usuarios',$contenido_data,true);
            $template['footer'] = $this->load->view('commons/footer',$footer_data,true);
            $this->load->view('desktop',$template);
        } else {
            redirect(base_url());
        }
    }

}

?>
<?php 
class User_model extends CI_Model{

    public function getAllUsers(){
        $query = $this->db->get('usuarios');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function get_data_users(){
        $query = $this->db->get('usuarios');

        $this->db->select("
            u.id as id,
            u.nombre as nombre,
            u.correo as correo,
            u.rfc as rfc,
            u.notas as notas
        ");
        $this->db->from("usuarios as u");

        if($query->num_rows() > 0){
            $query = $this->db->get();
            $result=$query->result();
            return $query->result();
        }else{
            return false;
        }
    }

    public function addUser($data){
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function get_user_by_mail($mail){
        $this->db->select("
            u.id as id,
            u.correo as correo,
            u.password as password
        ");
        $this->db->from("usuarios as u");
        $this->db->where("u.correo", $mail);
        $query = $this->db->get();
        $result=$query->result();
        return ($result) ? $result[0] : null;
    }


    public function get_user_by_id($id){
        $this->db->select("
            u.id as id,
            u.nombre as nombre,
            u.telefono as telefono,
            u.correo as correo,
            u.rfc,
            u.notas as notas
        ");
        $this->db->from("usuarios as u");
        $this->db->where("u.id", $id);
        $query = $this->db->get();
        $result = $query->result();
        return ($result) ? $result[0] : null;
    }


    public function updateUser($id,$field){
        $this->db->where('id', $id);
        $this->db->update('usuarios', $field);
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
    }
    
    public function searchUser($match) {
        $field = array('nombre_escuela','CCT','estado','nombre_director','correo_colegio','correo');    
        $this->db->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get('usuarios');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
}
?>
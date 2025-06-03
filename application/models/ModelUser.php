<?php 

defined('BASEPATH') OR exit('No direct script access allowed'); 

class ModelUser extends CI_Model { 

    public function simpanData($data = null) {
        if ($data !== null) {
            $this->db->insert('user', $data);
        }
    }

    public function getUserWhere($where = null) {
        $query = $this->db->get_where('user', $where);
        return $query->result();
    }

    public function cekUserAccess($where = null) {
        $this->db->select('*');
        $this->db->from('access_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getUserLimit() {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit(10, 0);
        return $this->db->get()->result();
    }

    public function updateUser($data = null, $where = null) {
        if ($data !== null && $where !== null) {
            $this->db->update('user', $data, $where);
        }
    }

    public function hapusUser($where = null) {
        if ($where !== null) {
            $this->db->delete('user', $where);
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    private $table = 'mahasiswa';

    public function get_all($search = '', $jurusan = '', $status = '') {
        $this->db->order_by('created_at', 'DESC');
        if ($search)  $this->db->like('nama', $search)->or_like('nim', $search);
        if ($jurusan) $this->db->where('jurusan', $jurusan);
        if ($status)  $this->db->where('status', $status);
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function count_by_status() {
        $result = [];
        $statuses = ['Aktif', 'Cuti', 'Lulus', 'DO'];
        foreach ($statuses as $s) {
            $result[$s] = $this->db->where('status', $s)->count_all_results($this->table);
        }
        return $result;
    }

    public function nim_exists($nim, $exclude_id = null) {
        $this->db->where('nim', $nim);
        if ($exclude_id) $this->db->where('id !=', $exclude_id);
        return $this->db->count_all_results($this->table) > 0;
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produto_model extends CI_Model
{
    protected $table = 'produtos';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }



    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('produtos', $data);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('produtos', ['id' => $id])->row();
    }
}

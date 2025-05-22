<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cupom_model extends CI_Model
{
    protected $table = 'cupons';

    public function get_by_codigo($codigo)
    {
        return $this->db->get_where($this->table, ['codigo' => $codigo])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}

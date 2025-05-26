<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estoque_model extends CI_Model
{
    protected $table = 'estoques';

    public function get_by_produto($produto_id)
    {
        return $this->db->get_where($this->table, ['produto_id' => $produto_id])->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete_by_produto($produto_id)
    {
        return $this->db->delete($this->table, ['produto_id' => $produto_id]);
    }
    public function get_by_produto_and_estoque_id($produto_id, $estoque_id)
    {
        return $this->db
            ->where('produto_id', $produto_id)
            ->where('id', $estoque_id)
            ->get($this->table)
            ->row();
    }
}

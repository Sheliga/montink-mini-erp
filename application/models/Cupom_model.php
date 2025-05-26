<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cupom_model extends CI_Model
{

    private $table = 'cupons';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }
    public function buscar_cupom_valido($codigo)
    {
        $this->db->where('codigo', $codigo);
        // $this->db->where('validade >=', date('Y-m-d'));
        return $this->db->get('cupons')->row_array();
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
}

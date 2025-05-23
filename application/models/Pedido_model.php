<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedido_model extends CI_Model
{
    protected $table = 'pedidos';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        // $this->db->insert($this->table, $data);
        // return $this->db->insert_id();
        return "";
    }

    public function update_status($id, $status)
    {
        return $this->db->update($this->table, ['status' => $status], ['id' => $id]);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
    public function salvar_pedido($dados)
    {
        $this->db->insert('pedidos', $dados);
        return $this->db->insert_id();
    }

    public function atualizar_estoque($itens)
    {
        foreach ($itens as $item) {
            $this->db->where('id', $item['estoque_id']);
            $this->db->set('quantidade', 'quantidade - ' . (int)$item['quantidade'], FALSE);
            $this->db->update('estoques');
        }
    }
}

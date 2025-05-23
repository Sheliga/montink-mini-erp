<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produto_model extends CI_Model
{
    protected $table = 'produtos';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_all_with_stock()
    {
        return $this->db->select('p.id AS produto_id, p.nome, p.preco, e.variacao, e.quantidade')
            ->from('produtos p')
            ->join('estoques e', 'p.id = e.produto_id')
            ->get()
            ->result();
    }
    public function get_all_com_estoque()
    {
        return $this->db->select('p.id AS produto_id, p.nome, p.preco, e.id AS estoque_id, e.variacao, e.quantidade')
            ->from('produtos p')
            ->join('estoques e', 'p.id = e.produto_id')
            ->get()
            ->result();
    }
    public function listarComVariacoesAgrupadas()
    {
        $this->db->select('
            produtos.id,
            produtos.nome,
            produtos.preco,
            estoques.id as estoque_id,
            estoques.variacao,
            estoques.quantidade
        ');
        $this->db->from('produtos');
        $this->db->join('estoques', 'estoques.produto_id = produtos.id', 'left');
        $query = $this->db->get();

        $result = $query->result();

        $produtos_agrupados = [];

        foreach ($result as $row) {
            $id = $row->id;

            if (!isset($produtos_agrupados[$id])) {
                $produtos_agrupados[$id] = [
                    'id' => $row->id,
                    'nome' => $row->nome,
                    'preco' => $row->preco,
                    'variacoes' => []
                ];
            }

            if ($row->estoque_id !== null) {
                $produtos_agrupados[$id]['variacoes'][] = (object)[
                    'estoque_id' => $row->estoque_id,
                    'variacao' => $row->variacao,
                    'quantidade' => $row->quantidade
                ];
            }
        }

        return $produtos_agrupados;
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

    public function delete_variacao($estoque_id)
    {
        return $this->db->delete('estoques', ['id' => $estoque_id]);
    }

    public function obter_produto_por_estoque($estoque_id)
    {
        $this->db->select('
        produtos.id as produto_id, 
        produtos.nome, 
        produtos.preco, 
        estoques.id as estoque_id, 
        estoques.variacao
    ');
        $this->db->from('estoques');
        $this->db->join('produtos', 'produtos.id = estoques.produto_id');
        $this->db->where('estoques.id', $estoque_id);
        return $this->db->get()->row();
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

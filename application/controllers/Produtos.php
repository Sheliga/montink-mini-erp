<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Produto_model');
        $this->load->model('Estoque_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function index()
    {
        $data['produtos'] = $this->Produto_model->get_all();
        $this->load->view('produtos/index', $data);
    }

    public function criar()
    {
        if ($_POST) {
            $produtoData = [
                'nome' => $this->input->post('nome'),
                'preco' => $this->input->post('preco')
            ];
            $produto_id = $this->Produto_model->insert($produtoData);

            $variacoes = $this->input->post('variacao');
            $quantidades = $this->input->post('quantidade');

            foreach ($variacoes as $index => $variacao) {
                $this->Estoque_model->insert([
                    'produto_id' => $produto_id,
                    'variacao' => $variacao,
                    'quantidade' => $quantidades[$index]
                ]);
            }

            $this->session->set_flashdata('success', 'Produto criado com sucesso.');
            redirect('produtos');
        }

        $this->load->view('produtos/criar');
    }

    public function editar($id)
    {
        $produto = $this->Produto_model->get_by_id($id);
        $estoques = $this->Estoque_model->get_by_produto($id);

        if (!$produto) {
            show_404();
        }

        if ($_POST) {
            $produtoData = [
                'nome' => $this->input->post('nome'),
                'preco' => $this->input->post('preco')
            ];
            $this->Produto_model->update($id, $produtoData);

            $this->Estoque_model->delete_by_produto($id);

            $variacoes = $this->input->post('variacao');
            $quantidades = $this->input->post('quantidade');

            foreach ($variacoes as $index => $variacao) {
                $this->Estoque_model->insert([
                    'produto_id' => $id,
                    'variacao' => $variacao,
                    'quantidade' => $quantidades[$index]
                ]);
            }

            $this->session->set_flashdata('success', 'Produto atualizado.');
            redirect('produtos');
        }

        $data['produto'] = $produto;
        $data['estoques'] = $estoques;

        $this->load->view('produtos/editar', $data);
    }
}

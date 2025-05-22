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
        $this->load->model('Produto_model');
        $this->load->model('Estoque_model');

        if ($this->input->method() === 'post') {
            $nome = $this->input->post('nome');
            $preco = $this->input->post('preco');
            $variacoes = $this->input->post('variacoes');

            $produto_id = $this->Produto_model->insert([
                'nome' => $nome,
                'preco' => $preco
            ]);

            if ($produto_id && isset($variacoes['nome'], $variacoes['quantidade'])) {
                for ($i = 0; $i < count($variacoes['nome']); $i++) {
                    $this->Estoque_model->insert([
                        'produto_id' => $produto_id,
                        'variacao' => $variacoes['nome'][$i],
                        'quantidade' => $variacoes['quantidade'][$i]
                    ]);
                }
            }

            redirect('produtos');
        }

        $this->load->view('produtos/criar');
    }

    public function update($id)
    {
        $this->load->model('Produto_model');
        $this->load->model('Estoque_model');

        if ($this->input->method() === 'post') {
            $nome = $this->input->post('nome');
            $preco = $this->input->post('preco');
            $variacoes = $this->input->post('variacoes');
            $estoque_ids = $this->input->post('estoque_ids');

            $this->Produto_model->update($id, [
                'nome' => $nome,
                'preco' => $preco
            ]);

            foreach ($variacoes['nome'] as $i => $variacao_nome) {
                $estoque_data = [
                    'produto_id' => $id,
                    'variacao' => $variacao_nome,
                    'quantidade' => $variacoes['quantidade'][$i]
                ];

                if (isset($estoque_ids[$i]) && $estoque_ids[$i] > 0) {
                    $this->Estoque_model->update($estoque_ids[$i], $estoque_data);
                } else {
                    $this->Estoque_model->insert($estoque_data);
                }
            }

            redirect('produtos');
        }

        $data['produto'] = $this->Produto_model->get_by_id($id);
        $data['estoques'] = $this->Estoque_model->get_by_produto($id);
        $this->load->view('produtos/update', $data);
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

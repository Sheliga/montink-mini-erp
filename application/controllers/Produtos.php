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
        $produtos_agrupados = $this->Produto_model->listarComVariacoesAgrupadas();

        $data = array(
            "produtos_agrupados" => $produtos_agrupados,
            "scripts" => array(
                "js/owl.carousel.min.js",
                "js/theme-scripts.js"
            )
        );

        $this->template->show("produtos/index.php", $data);
    }

    public function delete($id)
    {
        $this->Produto_model->delete($id);
        $this->session->set_flashdata('success', 'Produto excluído com sucesso.');
        redirect('produtos');
    }

    public function delete_variacao($id)
    {
        $this->Produto_model->delete_variacao($id);
        $this->session->set_flashdata('success', 'Variação excluída com sucesso.');
        redirect('produtos');
    }

    public function criar()
    {
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

        // $data = [
        //     "scripts" => ["js/form-validation.js"]
        // ];

        // $this->template->show('produtos/criar.php', $data);
        $data = ["scripts" => ["js/form-validation.js", "theme-scripts.js"]];
        $this->template->show('produtos/form', $data);
    }

    public function update($id)
    {
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

        $data = [
            'produto' => $this->Produto_model->get_by_id($id),
            'estoques' => $this->Estoque_model->get_by_produto($id),
            'scripts' => ['js/form-validation.js']
        ];

        $this->template->show('produtos/update.php', $data);
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

        $data = [
            'produto' => $produto,
            'estoques' => $estoques,
            'scripts' => ['js/form-validation.js']
        ];

        $this->template->show('produtos/editar.php', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produto_model');
        $this->load->model('Pedido_model');
        $this->load->library('session');
        $this->load->model('Estoque_model');
        $this->load->library('user_agent');
    }
    /**
     * Método para filtrar e remover itens sem estoque_id
     *
     * @param array $carrinho Array de itens do carrinho.
     * @return array Retorna o carrinho com apenas os itens válidos.
     */


    public function adicionar($estoque_id)
    {
        // Verifica se o parâmetro foi passado
        if (!$estoque_id) {
            show_error('ID de estoque não informado.', 400);
        }

        // Obtém os dados do produto a partir do estoque
        $produto = $this->Produto_model->obter_produto_por_estoque($estoque_id);
        if (!$produto) {
            show_404();
        }

        // Recupera o carrinho da sessão ou inicializa como array vazio
        $carrinho = $this->session->userdata('carrinho') ?? [];

        $encontrado = false;
        foreach ($carrinho as &$item) {
            // Aqui comparamos com o estoque_id recebido
            if ($item['estoque_id'] == $estoque_id) {
                $item['quantidade'] = (int)($item['quantidade'] ?? 0) + 1;
                $encontrado = true;
                break;
            }
        }

        if (!$encontrado) {
            $carrinho[] = [
                'produto_id' => $produto->produto_id,
                'estoque_id' => $produto->estoque_id,
                'nome'       => $produto->nome,
                'variacao'   => $produto->variacao,
                'preco'      => (float)$produto->preco,
                'quantidade' => 1
            ];
        }
        $carrinho = $this->limpar_itens_invalidos($carrinho);

        $this->session->set_userdata('carrinho', $carrinho);
        // redirect('carrinho');
        // Redireciona de volta para a página que originou a requisição
        redirect($this->agent->referrer());
    }



    public function index()
    {


        $pedidos = $this->Pedido_model->get_all();
        // Calcula subtotal, frete e total


        // Prepara os dados para a view
        $data = [
            'orders'    => $pedidos,

        ];

        // Usa o sistema de templates
        $this->template->show('pedidos/index.php', $data);
    }
}

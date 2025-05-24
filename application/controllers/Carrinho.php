<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carrinho extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produto_model');
        $this->load->model('Pedido_model');
        $this->load->library('session');
        $this->load->library('user_agent');
    }
    /**
     * Método para filtrar e remover itens sem estoque_id
     *
     * @param array $carrinho Array de itens do carrinho.
     * @return array Retorna o carrinho com apenas os itens válidos.
     */
    private function limpar_itens_invalidos($carrinho)
    {
        return array_filter($carrinho, function ($item) {
            return isset($item['estoque_id']) && !empty($item['estoque_id']);
        });
    }

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

    // public function index()
    // {
    //     $itens = $this->session->userdata('carrinho') ?? [];
    //     $subtotal = array_sum(array_map(function ($item) {
    //         return $item['preco'] * $item['quantidade'];
    //     }, $itens));
    //     $frete = $this->calcular_frete($subtotal);
    //     $total = $subtotal + $frete;

    //     $dados = [
    //         'itens'    => $itens,
    //         'subtotal' => $subtotal,
    //         'frete'    => $frete,
    //         'total'    => $total,
    //     ];

    //     $this->load->view('carrinho/index', $dados);
    // }

    public function index()
    {
        $itens = $this->session->userdata('carrinho') ?? [];

        // Remove itens inválidos
        $itens = $this->limpar_itens_invalidos($itens);
        $this->session->set_userdata('carrinho', $itens);

        // Calcula subtotal, frete e total
        $subtotal = array_sum(array_map(function ($item) {
            return $item['preco'] * $item['quantidade'];
        }, $itens));

        $frete = $this->calcular_frete($subtotal);
        $total = $subtotal + $frete;

        // Prepara os dados para a view
        $data = [
            'itens'    => $itens,
            'subtotal' => $subtotal,
            'frete'    => $frete,
            'total'    => $total,
            'scripts'  => [
                'js/carrinho.js' // se quiser scripts personalizados
            ]
        ];

        // Usa o sistema de templates
        $this->template->show('carrinho/index.php', $data);
    }
    public function remover($estoque_id = null)
    {
        if (!$estoque_id) {
            show_error('ID de estoque não fornecido para remoção.', 400);
        }

        $carrinho = $this->session->userdata('carrinho') ?? [];
        $carrinho = $this->limpar_itens_invalidos($carrinho);
        // Filtra os itens removendo aquele com o estoque_id informado
        $novo_carrinho = array_filter($carrinho, function ($item) use ($estoque_id) {
            return $item['estoque_id'] != $estoque_id;
        });
        $this->session->set_userdata('carrinho', $novo_carrinho);
        redirect('carrinho');
    }
    // public function finalizar()
    // {
    //     $itens = $this->session->userdata('carrinho') ?? [];

    //     if (empty($itens)) {
    //         $this->session->set_flashdata('error', 'Carrinho vazio.');
    //         redirect('carrinho');
    //     }

    //     // Calcular o subtotal de forma defensiva: verifica se 'preco' e 'quantidade' estão definidos
    //     $subtotal = array_sum(array_map(function ($i) {
    //         $preco = isset($i['preco']) ? (float)$i['preco'] : 0;
    //         $quantidade = isset($i['quantidade']) ? (int)$i['quantidade'] : 0;
    //         return $preco * $quantidade;
    //     }, $itens));

    //     // Calcula o frete com a lógica definida (já encontra-se no controller)
    //     $frete = $this->calcular_frete($subtotal);
    //     $total = $subtotal + $frete;

    //     $dados_pedido = [
    //         'itens'     => json_encode($itens),
    //         'subtotal'  => $subtotal,
    //         'frete'     => $frete,
    //         'total'     => $total,
    //         'criado_em' => date('Y-m-d H:i:s')
    //     ];

    //     $pedido_id = $this->Pedido_model->salvar_pedido($dados_pedido);
    //     // Atualiza o estoque com os itens vendidos
    //     $this->Pedido_model->atualizar_estoque($itens);
    //     // Limpa o carrinho na sessão
    //     $this->session->unset_userdata('carrinho');

    //     $this->session->set_flashdata('success', "Pedido #{$pedido_id} finalizado com sucesso.");
    //     redirect('produtos');
    // }
    public function finalizar()
    {
        $itens = $this->session->userdata('carrinho') ?? [];
        $itens = $this->limpar_itens_invalidos($itens);
        $this->session->set_userdata('carrinho', $itens);

        if (empty($itens)) {
            $this->session->set_flashdata('error', 'Carrinho vazio.');
            redirect('carrinho');
        }

        // Recupera os dados do formulário
        $cep           = $this->input->post('cep');
        $endereco      = $this->input->post('endereco');      // Ex: rua, número, complemento
        $email_cliente = $this->input->post('email_cliente');

        // Validação básica (exemplo)
        if (empty($cep)) {
            $this->session->set_flashdata('error', 'Informe um CEP válido.');
            redirect('carrinho');
        }

        // Calcula subtotal e total
        $subtotal = array_sum(array_map(function ($i) {
            $preco = isset($i['preco']) ? (float)$i['preco'] : 0;
            $quantidade = isset($i['quantidade']) ? (int)$i['quantidade'] : 0;
            return $preco * $quantidade;
        }, $itens));

        $frete = $this->calcular_frete($subtotal);
        $total = $subtotal + $frete;

        // Monta o pedido para inserção
        $dados_pedido = [
            'produtos_serializados' => json_encode($itens),
            'subtotal'              => $subtotal,
            'frete'                 => $frete,
            'total'                 => $total,
            'cep'                   => $cep,
            'endereco'              => $endereco,
            'email_cliente'         => $email_cliente,
            'created_at'            => date('Y-m-d H:i:s'),
        ];


        $pedido_id = $this->Pedido_model->salvar_pedido($dados_pedido);

        $this->Pedido_model->atualizar_estoque($itens);
        if (!empty($email_cliente)) {
            $this->Pedido_model->enviar_email_confirmacao($email_cliente, $pedido_id, $itens, $total);
        }
        $this->session->unset_userdata('carrinho');

        $this->session->set_flashdata('success', "Pedido #{$pedido_id} finalizado com sucesso.");

        redirect('produtos');
    }

    /**
     * Método privado para calcular o frete com base no subtotal.
     *
     * @param float $subtotal
     * @return float
     */
    private function calcular_frete($subtotal)
    {
        $subtotal = (float)$subtotal; // Garante que $subtotal é numérico
        if ($subtotal >= 200) {
            return 0;
        }
        if ($subtotal >= 52 && $subtotal <= 166.59) {
            return 15;
        }
        return 20;
    }
}

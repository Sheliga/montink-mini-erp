<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cupons extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Coupon_model');
        $this->load->library('session');
    }

    public function index()
    {
        $cupons = $this->Coupon_model->get_all();
        $data = array(
            "cupons" => $cupons,
            "scripts" => array(
                "js/datatables.min.js", // se usar datatables
                "js/cupom.js"           // exemplo de script customizado
            )
        );

        $this->template->show("cupons/index.php", $data);
    }

    public function create()
    {
        $data = array(
            "scripts" => array(
                "js/form-validation.js"
            )
        );

        $this->template->show("cupons/create.php", $data);
    }

    public function insert()
    {
        $data = $this->input->post();

        $cupom = [
            'codigo' => $data['codigo'],
            'validade' => $data['validade'],
            'tipo' => $data['tipo'],
            'desconto' => $data['desconto'],
            'valor_minimo' => !empty($data['valor_minimo']) ? $data['valor_minimo'] : null,
        ];

        $this->Coupon_model->insert($cupom);
        redirect('cupons');
    }

    public function edit($id)
    {
        $data = array(
            "cupom" => $this->Coupon_model->get($id),
            "scripts" => array(
                "js/form-validation.js"
            )
        );

        $this->template->show("cupons/edit.php", $data);
    }

    public function update($id)
    {
        $data = [
            'codigo' => $this->input->post('codigo'),
            'validade' => $this->input->post('validade'),
            'tipo' => $this->input->post('tipo'),
            'desconto' => $this->input->post('desconto'),
            'valor_minimo' => $this->input->post('valor_minimo') ?: null
        ];

        $this->Coupon_model->update($id, $data);
        redirect('cupons');
    }

    public function delete($id)
    {
        $this->Coupon_model->delete($id);
        redirect('cupons');
    }
}

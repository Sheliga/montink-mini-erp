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
        $data['cupons'] = $this->Coupon_model->get_all();
        $this->load->view('cupons/index', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->Coupon_model->insert($data);
            redirect('cupons');
        }
        $this->load->view('cupons/create');
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
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->Coupon_model->update($id, $data);
            redirect('cupons');
        }

        $data['cupom'] = $this->Coupon_model->get($id);
        $this->load->view('cupons/edit', $data);
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

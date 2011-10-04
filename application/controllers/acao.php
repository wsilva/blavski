<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acao extends CI_Controller
{

    public function index()
    {
        $this->auth->check_logged($this->router->class, $this->router->method);

        $data = array();

        # pegando mensagens da sessão flash
        $data['mensagens'] = $this->session->flashdata('mensagens');
        
        $this->load->view('tmpl/header', $data);
        $this->load->view('acao');
        $this->load->view('tmpl/footer');
    }

    public function gravaacao()
    {
        $this->auth->check_logged($this->router->class, $this->router->method);

        $this->load->library('form_validation');

        # validações
        $validacoes = array(
            array(
                'field' => 'defeito',
                'label' => 'Defeito',
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'cod_barra',
                'label' => 'Código de Barras',
                'rules' => 'trim|required|min_length[5]|max_length[200]|alpha_numeric|xss_clean'
            ),
            array(
                'field' => 'defeito_id',
                'label' => 'Tipo de Defeito',
                'rules' => 'trim|required|min_length[1]|max_length[3]|numeric|xss_clean'
            )
        );
        
        $this->form_validation->set_rules($validacoes);

        # mensagens de erro
        $this->form_validation->set_message('required', 'O campo <strong>%s</strong> é obrigatório');
        $this->form_validation->set_message('min_length', 'O campo <strong>%s</strong> deve ter no mínimo %s caracteres');
        $this->form_validation->set_message('max_length', 'O campo <strong>%s</strong> deve ter no máximo %s caracteres');
        $this->form_validation->set_message('alpha_numeric', 'O campo <strong>%s</strong> deve ter apenas letras e/ou números');
        $this->form_validation->set_message('numeric', 'O campo <strong>%s</strong> deve ter apenas números');

        # definindo delimitadores
        $this->form_validation->set_error_delimiters('<li class="submiterror">', '</li>');

        # não passou na validação
        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }

        #passou na validação
        else
        {
            # carregando model
            $this->load->model('AcaoModel');

            # criando o objeto usuário
            $acao = new AcaoModel();

            # populando obj usuário
            $acao->cod_barra = $this->input->post('cod_barra');
            $acao->dt_entrada = $this->input->post('dt_entrada');
            $acao->dt_saida = date('Y-m-d H:i:s');
            $acao->usuario_id = $this->session->userdata('usuario_id');
            $acao->defeito = $this->input->post('defeito');
            $acao->defeito_id = $this->input->post('defeito_id');


            # gravando dados no banco
            if ($acao->grava())
            {
                $mensagens = array('notice' => 'Ação cadastrada com sucesso.');
                $this->session->set_flashdata('mensagens', $mensagens);
            }

            #erro ao gravar dados
            else
            {
                $mensagens = array('error' => 'Erro ao cadastrar ação.');
                $this->session->set_flashdata('mensagens', $mensagens);
            }

            # redirecionando
            redirect(base_url() . 'acao', 'refresh');
            exit();
        }
    }

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file acao.php */
/* Location: ./application/controllers/acao.php */
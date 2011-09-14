<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    //registros por página
    private $limit = 5;

    public function index()
    {
        $this->auth->check_logged($this->router->class, $this->router->method);
        
        $data = array();
        
        //pegando parametro da paginação
        $uri_segment = 3;
        $offset = $this->uri->segment($uri_segment);
        
        //carregando model
        $this->load->model('Usuario_model');
        
        $usuarios = $this->Usuario_model->buscartodos();
        $usuarios_pag = $this->Usuario_model->buscarporqtde($this->limit, $offset);
        
        //paginação
        $this->load->library('pagination');
        $config['base_url'] = site_url('usuario/index');
        $config['total_rows'] = sizeof($usuarios);
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = $uri_segment;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        
        //para montar tabelas html
        $this->load->library('table');
        
        //para trabalhar com datas
        $this->load->helper('date');

        //table header
        $tablearr[] = array('Nome', 'Usuário', 'E-mail', 'Criação', 'Última alteração', '');

        //varrendo usuarios
        foreach($usuarios_pag as $usuario){
            

            //ações
            $actions = "<a href='alterar/{$usuario->id}' >editar</a>";
            $actions .= " | <a href='senha/{$usuario->id}' >nova senha</a>";
            $actions .= " | <a href='permissoes/{$usuario->id}' >permissoes</a>";
            $actions .= " | <a href=\"javascript:removeConfirmation({$usuario->id})\" >remover</a>";

            //create update
            $created = mdate('%d/%m/%Y %Hh%i', mysql_to_unix($usuario->dt_cadastro));
            $updated = mdate('%d/%m/%Y %Hh%i', mysql_to_unix($usuario->dt_alteracao));

            //populando html table
            $tablearr[] = array($usuario->nome, $usuario->usuario, $usuario->email, $created, $updated, $actions);
        }
        

        //definindo abertura da tag table
        $table_tmpl = array ('table_open' => ' <table class="tabledetail">');
        $this->table->set_template($table_tmpl);

        //dumping to data variable
        $data['tabela_usuarios'] = $this->table->generate($tablearr);

        //limpando table helper para ser reutilizado
        $this->table->clear();
        
        # pegando mensagens da sessão flash
        $data['mensagens'] = $this->session->flashdata('mensagens');

        $this->load->view('tmpl/header', $data);
        $this->load->view('usuariolist');
        $this->load->view('tmpl/footer');
    }
    
    public function novo()
    {
        $this->auth->check_logged($this->router->class, $this->router->method);
        
        $data = array();
        
        # pegando mensagens da sessão flash
        $data['mensagens'] = $this->session->flashdata('mensagens');

        $this->load->view('tmpl/header', $data);
        $this->load->view('usuarionovo');
        $this->load->view('tmpl/footer');
    }
    
    public function grava_novo()
    {
        $this->load->library('form_validation');
        
        # validações
        $validacoes = array(
            array(
                'field' => 'usuario',
                'label' => 'Usuário',
                'rules' => 'trim|required|alpha_numeric|min_length[5]|max_length[20]|xss_clean'
            ),
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'trim|required|min_length[5]|max_length[200]|xss_clean'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'trim|required|max_length[150]|valid_email'
            ),
            array(
                'field' => 'senha',
                'label' => 'Senha',
                'rules' => 'trim|required|min_length[5]|max_length[200]|matches[confirmacao]|md5'
            ),
            array(
                'field' => 'confirmacao',
                'label' => 'Confirmação de Senha',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($validacoes);
        
        # mensagens de erro
        $this->form_validation->set_message('required', 'O campo <strong>%s</strong> é obrigatório');
        $this->form_validation->set_message('min_length', 'O campo <strong>%s</strong> deve ter no mínimo %s caracteres');
        $this->form_validation->set_message('max_length', 'O campo <strong>%s</strong> deve ter no máximo %s caracteres');
        $this->form_validation->set_message('alpha_numeric', 'O campo <strong>%s</strong> deve ter apenas letras e/ou números');
        $this->form_validation->set_message('valid_email', 'O campo <strong>%s</strong> deve ter um endereço de e-mail válido');
        $this->form_validation->set_message('matches', 'Os campos <strong>%s</strong> e <strong>%s</strong> não conferem.');
        
        # definindo delimitadores
        $this->form_validation->set_error_delimiters('<li class="submiterror">', '</li>');
        
        # não passou na validação
        if ($this->form_validation->run() == FALSE)
        {
            $this->novo();
        }
        
        #passou na validação
        else
        {
            var_dump('ação de gravar novo');
            die('testando');
            $this->load->view('formsuccess');
        }
    }

    public function __construct()
    {
        parent::__construct();
    }

}

/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */
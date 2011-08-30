<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
//        $this->load->helper('logs');
        $this->load->helper('cookie');
    }

    public function index()
    {
        redirect(base_url() . 'home/login', 'refresh');
    }

    public function void()
    {
        $data['js_to_load'] = null;
        $this->load->view('libs/html-header', $data);
        $this->load->view('libs/menu');
        $this->load->view('libs/html-footer');
    }

    public function sempermissao()
    {

        echo "<html>";
        echo "<title>Acesso Negado</title>";
        echo "<body bgcolor='#EEEEEE'>";
        echo " <div style='padding:20px;background-color:#FFCC00;'>";
        echo "<h2>Você não tem permissão para acessar esta funcionalidade.</h2>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        exit();
    }

    public function login()
    {
        $data['titulo']="Testando";
        $this->load->view('header', $data);
        $data = NULL;
        $this->load->view('login', $data);
        $this->load->view('footer');
    }

    public function dologin()
    {
        $usuario = $this->input->post('usuario');
        $senha = md5($this->input->post('senha'));
        if ($usuario == ""  || $this->input->post('senha') == "")
        {
            redirect(base_url() . 'home/login', 'refresh');
            exit();
        }
        if (isset($_POST['lembrar']))
        {
            setcookie("usuario", $usuario);
            setcookie("lembrar", "checked");
        }
        $sql = "SELECT 
                    id,usuario,nome,email
                FROM usuarios
                WHERE usuario ='" . $usuario . "'
                    AND senha ='" . $senha . "'";
        
        $query = $this->db->query($sql);
        $result = $query->result();
        
        if (count($result) < 1)
        {
            redirect(base_url() . 'home/login', 'refresh');
            exit();
        }
        
        else
        {
            $login = array(
                'id_usuario' => $result[0]->id,
                'usuario' => $result[0]->login,
                'nome' => $result[0]->nome,
                'email' => $result[0]->email,
                'logged_in' => TRUE,
                'data' => date("d/m/Y h:i:s")
            );
            $data['ip'] = getenv("REMOTE_ADDR");
            $data['usuario_id'] = $result[0]->id;
            $data['dt'] = date('Y-m-d H:i:s');
            $this->db->insert('acessos', $data);
            $this->session->set_userdata($login);
            redirect(base_url() . 'home/void', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->login();
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
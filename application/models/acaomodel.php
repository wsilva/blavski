<?php

class AcaoModel extends CI_Model
{

    var $id;
    var $cod_barra = '';
    var $dt_entrada = '0000-00-00 00:00:00';
    var $dt_saida = '0000-00-00 00:00:00';
    var $defeito = '';
    var $defeito_id = '';

    public function __construct($id = null)
    {
        parent::__construct();

        if ($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('acoes');

            if ($query->num_rows == 1)
            {
                $result = $query->result();

                $this->id = $id;
                $this->cod_barra = $result[0]->cod_barra;
                $this->dt_entrada = $result[0]->dt_entrada;
                $this->dt_saida = $result[0]->dt_saida;
                $this->usuario_id = $result[0]->usuario_id;
                $this->defeito = $result[0]->defeito;
                $this->defeito_id = $result[0]->defeito_id;
            }

            //ñ existe
            else
            {
                die("ooops: Ação id does not exists! <br/> What are you doing?");
            }
        }

        //without user id we create a new one
        else
        {
            $this->id = null;
        }
        
        return $this;
    }

    function buscartodos()
    {
        $this->db->order_by("dt_saida", "asc");
        $query = $this->db->get('acoes');
        return $query->result();
    }

    function buscarporqtde($limit, $offset)
    {
        $this->db->order_by("dt_saida", "asc");
        $query = $this->db->get('acoes', $limit, $offset);
        return $query->result();
    }
    

    function grava()
    {
        //inserting new acao
        if($this->id == null)
        {
            $insertData = array(
               'id' => $this->id ,
               'cod_barra' => $this->cod_barra ,
               'dt_entrada' => $this->dt_entrada,
               'dt_saida' => $this->dt_saida,
               'usuario_id' => $this->usuario_id,
               'defeito' => $this->defeito,
               'defeito_id' => $this->defeito_id
            );

            $this->db->insert('acoes', $insertData);
            $this->id = $this->db->insert_id(); //last inserted id
        }

        //updating existing acao
        else
        {
            $updateData = array(
               'cod_barra' => $this->cod_barra ,
               'dt_entrada' => $this->dt_entrada,
               'dt_saida' => $this->dt_saida,
               'usuario_id' => $this->usuario_id,
               'defeito' => $this->defeito,
               'defeito_id' => $this->defeito_id
            );
            $this->db->where('id',  $this->id);
            $this->db->update('acoes', $updateData);
        }

        return TRUE;
    }

    function remove()
    {

        //deleting user
        $this->db->where('id', $this->id);
        $this->db->delete('acoes');

        return TRUE;
    }

}

/* End of file usuario_model.php */
/* Location: ./application/models/usuario_model.php */

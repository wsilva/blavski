<div id="content-container">
    <div id="content">
        <h1>Cadastro de ação</h1>
        
        <div id="flash">
            <?php if (is_array($mensagens)): ?>
                <?php foreach ($mensagens as $tipo => $mensagem): ?>
                    <div class="flash <?php echo $tipo; ?>"><?php echo $mensagem ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?php if( validation_errors() ): ?>
        <div id="form_errors">
            <div class="flash error">
                <?php echo validation_errors(); ?>
            </div>
        </div>
        <?php endif; ?>

        <div id="body">
            <p>Preencher os dados abaixo:</p>

            <?php
            echo form_open('/acao/gravaacao');

            $optDefeitos = array(
                'SIM' => 'Sim',
                'NAO' => 'Não',
            );
            
            $optTipoDefeitos = array(
                '1' => 'Defeito1',
                '2' => 'Defeito2',
                '3' => 'Defeito3',
            );
            
            $optId = 'id="defeito"';
            
            $optTipoDefeitosId = 'id="tipodefeito"';

            echo form_fieldset('Dados da ação');

            echo "<p>";
            echo form_label('Defeito?', 'defeito');
            echo "<br/>";
            echo form_dropdown('defeito', $optDefeitos, 'NAO', $optId);
            echo "</p>";

            echo "<div id='defeito_select'>";
            echo form_label('Selecione o defeito', 'defeito_id');
            echo "<br/>";
            echo form_dropdown('defeito_id', $optTipoDefeitos, '', $optTipoDefeitosId);
            echo "</div>";

            echo "<p id='defeito_select'></p>";

            echo "<p>";
            echo form_label('Código de Barras', 'cod_barra');
            echo "<br/>";
            echo form_input(array('name' => 'cod_barra', 'id' => 'cod_barra', 'maxlength' => '100'));
            echo "</p>";

            echo "<p>";
            echo form_submit('finalizar', 'Finalizar');
            echo "</p>";

            echo form_hidden('dt_entrada', date('Y-m-d H:i:s'));
            echo form_fieldset_close();

            echo form_close();
            ?>
        </div>

    </div>
</div>  
<script type="text/javascript">
    $(document).ready(function () {
        
        $("#cod_barra").focus();
        $("#defeito_select").hide();
        
        $("#defeito").change( function(){
            
            if($("#defeito").val()=='NAO')
            {
                $("#defeito_select").fadeOut('fast');
            }
            else
            {
                $("#defeito_select").fadeIn('fast');
//                $("#defeito_select").html('...Carregando...');
//                $.ajax({
//                    type: "POST",
//                    url: "/acao/listadefeitos",
//                    //                data: dataString,
//                    cache: false,
//                    success: function(resp)
//                    {
//                        $("#defeito_select").html(resp);
//                    } 
//                });
            }
            
        })
    });
    
</script>

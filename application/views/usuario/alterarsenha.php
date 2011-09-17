<div id="content-container">

    <div id="content">

        <h1>Definir Senha</h1>

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
            
            <p>
                <b>Usuário:</b> <?php echo $usuario->nome; ?>
            </p>
            
            <?php
            echo form_open('/usuario/grava_novasenha');

            echo form_fieldset('Dados');
            
            echo form_hidden('usuario_id', $usuario->id);

            echo "<p>";
            echo form_label('Senha', 'senha');
            echo "<br/>";
            echo form_password(array('name' => 'senha', 'id' => 'senha', 'maxlength' => '100'));
            echo "</p>";

            echo "<p>";
            echo form_label('Confirmação', 'confirmacao');
            echo "<br/>";
            echo form_password(array('name' => 'confirmacao', 'id' => 'confirmacao', 'maxlength' => '100'));
            echo "</p>";

            echo "<p>";
            echo form_submit('gravar', 'Gravar');
            echo "</p>";

            echo form_fieldset_close();

            echo form_close();
            ?>
        </div>

    </div>

    <div id="aside">
        <div id="links" class="box">
            <h3>Usuários</h3>
            <p><a href="/usuario">voltar</a></p>
        </div>      
    </div>

</div>

<script type="text/javascript">
    function removeConfirmation(usuario_id)
    {
        var resp = confirm("Deseja realmente remover?");
        if(resp)
        {
            window.location = '/usuario/remover/' + usuario_id;
        }
    }
</script>

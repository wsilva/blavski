<div id="content-container">

    <div id="content">

        <h1>Novo Usuário</h1>

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
            
            <?php
            echo form_open('/usuario/grava_novo');

            echo form_fieldset('Dados');

            echo "<p>";
            echo form_label('Usuário', 'usuario');
            echo "<br/>";
            echo form_input(array('name' => 'usuario', 'id' => 'usuario', 'maxlength' => '100', 'value' => set_value('usuario')));
            echo "</p>";

            echo "<p>";
            echo form_label('Nome', 'nome');
            echo "<br/>";
            echo form_input(array('name' => 'nome', 'id' => 'nome', 'maxlength' => '100', 'value' => set_value('nome')));
            echo "</p>";

            echo "<p>";
            echo form_label('E-mail', 'email');
            echo "<br/>";
            echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => '100', 'value' => set_value('email')));
            echo "</p>";

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

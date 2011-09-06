<div id="content-container">
    <div id="content">
        
        <div id="flash">
            <?php if( is_array($mensagens) ): ?>
                <?php foreach ($mensagens as $tipo => $mensagem):?>
                    <div class="flash <?php echo $tipo; ?>"><?php echo $mensagem?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <h2>
            Entrar
        </h2>

        <p>
            <?php
            echo form_open('/home/dologin');

            echo form_fieldset('Entrar');
            echo form_label('Usuário', 'usuario');
            echo form_input('usuario', set_value('usuario', $this->input->post('usuario')));
            echo "<br/>";
            echo form_label('Senha', 'senha');
            echo form_password('senha');
            echo "<br/>";
            echo form_submit('entrar', 'Entrar');

            echo form_fieldset_close();

            echo form_close();
            ?>
        </p>
    </div>
    <div id="aside">
        <h3>
            Login
        </h3>
        <p>
            Informar usuario e senha para acessar.
        </p>
    </div>
</div>

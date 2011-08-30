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

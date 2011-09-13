<div id="navigation">
    <ul>
        <li><a href="/">Home</a></li>
        <?php if( $this->session->userdata('logged_in') ):?>
            <li><a href="/cadastro">Cadastro</a></li>
            <?php if( $this->auth->check_menu('usuario', 'index') ): ?>
                <li><a href="/usuario">Usuários</a></li>            
            <?php endif; ?>
            <li><a href="/home/logout">Sair</a></li>
        <?php endif; ?>
    </ul>
</div>
<div id="navigation">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="#">Sobre</a></li>
        <?php if( $this->session->userdata('logged_in') ):?>
            <li><a href="/home/logout">Sair</a></li>            
        <?php endif; ?>
    </ul>
</div>
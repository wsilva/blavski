<div id="content-container">
    <div id="content">
        
        <div id="flash">
            <?php if( is_array($mensagens) ): ?>
                <?php foreach ($mensagens as $tipo => $mensagem):?>
                    <div class="flash <?php echo $tipo; ?>"><?php echo $mensagem?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?php echo $tabela_usuarios; ?>
        <?php echo $pagination; ?>
        
    </div>
    <div id="aside">
        bla
    </div>
</div>

<script type="text/javascript">
    function removeConfirmation(usuario_id)
    {
        var resp = confirm("Deseja realmente remover?");
        if(resp)
        {
            window.location = '<?php echo base_url(); ?>usuario/remover/' + usuario_id;
        }
    }
</script>

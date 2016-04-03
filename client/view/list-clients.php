<section class="container">
    <div class="wrap ">
        <?php
        $this->show_error( 'message-error' );
        $this->show_success( 'message-success' );
        ?>
        <div class="col twelve list-header">
            <h2>Clientes</h2>
            <ul class="container">
                <li class="col three">Nome</li>
                <li class="col three">E-mail</li>
                <li class="col two">Telefone</li>
                <li class="col two">Serviços</li>
                <li class="col two">Data de Registro</li>
            </ul>
        </div>
        <ul class="col twelve list-content">
            <?php
            if ( count( $this->data ) ) {
                foreach( $this->data as $k => $v ) {  ?>
                <li>
                    <div class="col three">
                        <span><?php echo $v->client_name; ?></span>
                        <a href="?action=edit&id=<?php echo $v->client_id; ?>"> editar </a>
                        <a class="btn-delete" href="?action=delete&id=<?php echo $v->client_id; ?>"> excluir </a>
                    </div>
                    <div class="col three"><?php echo $v->client_email; ?></div>
                    <div class="col two"><?php echo $v->client_phone; ?></div>
                    <div class="col two">
                        <a href="<?php echo URL_SITE ?>demand/?client=<?php echo $v->client_id; ?>"> Visualizar Serviços </a>
                    </div>
                    <div class="col two">
                        <?php echo $v->register_date; ?>
                    </div>
                <?php } } else { ?>
                <span>Nenhum cliente cadastrado ainda!</span>
            <?php } ?>
        </ul>
    </div>
</section>

<?php
echo $this->error;
echo $this->success;
?>
<section class="container">
    <div class="wrap ">
        <?php
            $this->show_error( 'message-error' );
            $this->show_success( 'message-success' );
        ?>
        <div class="col twelve list-header">
            <h2>Serviços</h2>
            <ul class="container">
                <li class="col four" >Nome</li>
                <li class="col four">Descrição</li>
                <li class="col four">Data de Registro</li>
            </ul>
        </div>
        <ul class="col twelve list-content">
            <?php
            if ( count( $this->data ) ) {
                foreach( $this->data as $k => $v ) {  ?>
                <li>
                    <div class="col four">
                        <?php echo $v->service_name; ?>
                        <a class="btn-edit" href="?action=edit&id=<?php echo $v->service_id; ?>"> editar </a>
                        <a class="btn-delete" href="?action=delete&id=<?php echo $v->service_id; ?>"> excluir </a>
                    </div>
                    <div class="col four"><?php echo $v->service_description; ?></div>
                    <div class="col four"><?php echo $v->register_date; ?></div>
                </li>
                <?php } } else { ?>
                <span>Nenhum cliente cadastrado ainda!</span>
            <?php } ?>
        </ul>
    </div>
</section>

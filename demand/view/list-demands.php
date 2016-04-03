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
            <h2>Pedidos</h2>
            <ul class="container">
                <li class="col two" >Cliente</li>
                <li class="col two">Serviço</li>
                <li class="col two">Data de Início</li>
                <li class="col two">Data de Fim</li>
                <li class="col two">Data de Registro</li>
                <li class="col two">Expria em</span></li>
            </ul>
        </div>
        <ul class="col twelve list-content">
            <?php
            if ( count( $this->data ) ) {
                foreach( $this->data as $k => $v ) {  ?>
                    <div class="col two" >
                        <span><?php echo $v->client_name; ?></span>
                        <a href="?action=edit&id=<?php echo $v->demand_id; ?>"> editar </a>
                        <a class="btn-delete" href="?action=delete&id=<?php echo $v->demand_id; ?>"> excluir </a>
                    </div>
                    <div class="col two"><?php echo $v->service_name; ?></div>
                    <div class="col two"><?php echo $v->demand_start; ?></div>
                    <div class="col two"><?php echo $v->demand_finish; ?></div>
                    <div class="col two"><?php echo $v->register_date; ?></div>
                    <div class="col two"><?php echo $this->diff_date( $v->demand_finish ); ?></div>
                <?php } } else { ?>
                <p>Nenhum pedido cadastrado...</p>
            <?php } ?>
        </ul>
    </div>
</section>

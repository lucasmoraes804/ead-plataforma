<?php
echo $this->error;
echo $this->success;
?>
<section class="container">
    <div class="wrapper">
        <span><?php echo $this->error; ?></span>
        <h2>Pedidos</h2>
        <ul class="container">
            <li><span>Cliente</span></li>
            <li><span>Serviço</span></li>
            <li><span>Data de Início</span></li>
            <li><span>Data de Fim</span></li>
            <li><span>Data de Registro</span></li>
            <li><span>Expria em</span></li>
        </ul>
        <ul class="container list">
            <?php
            if ( count( $this->data ) ) {
                foreach( $this->data as $k => $v ) {  ?>
                    <li><span><?php echo $v->client_name; ?></span><a href="?action=edit&id=<?php echo $v->demand_id; ?>"> editar </a><a class="btn-delete" href="?action=delete&id=<?php echo $v->demand_id; ?>"> excluir </a></li>
                    <li><span><?php echo $v->service_name; ?></span></li>
                    <li><span><?php echo $v->demand_start; ?></span></li>
                    <li><span><?php echo $v->demand_finish; ?></span></li>
                    <li><span><?php echo $v->register_date; ?></span></li>
                    <li><?php echo $this->diff_date( $v->demand_finish ); ?></li>
                <?php } } else { ?>
                <p>Nenhum pedido cadastrado...</p>
            <?php } ?>
        </ul>
    </div>
</section>

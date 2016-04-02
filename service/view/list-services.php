<?php
echo $this->error;
echo $this->success;
?>
<section class="container">
    <div class="wrapper">
        <span><?php echo $this->error; ?></span>
        <h2>Clientes</h2>
        <ul class="container">
            <li><span>Nome</span></li>
            <li><span>Descrição</span></li>
            <li><span>Data de Registro</span></li>
        </ul>
        <ul class="container list">
            <?php
            if ( count( $this->data ) ) {
                foreach( $this->data as $k => $v ) {  ?>
                    <li><span><?php echo $v->service_name; ?></span><a href="?action=edit&id=<?php echo $v->service_id; ?>"> editar </a><a class="btn-delete" href="?action=delete&id=<?php echo $v->service_id; ?>"> excluir </a></li>
                    <li><span><?php echo $v->service_description; ?></span></li>
                    <li><span><?php echo $v->register_date; ?></span></li>
                <?php } } else { ?>
                <span>Nenhum cliente cadastrado ainda!</span>
            <?php } ?>
        </ul>
    </div>
</section>

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
            <li><span>E-mail</span></li>
            <li><span>Telefone</span></li>
            <li><span>Data de Registro</span></li>
        </ul>
        <ul class="container list">
            <?php
            if ( count( $this->data ) ) {
                foreach( $this->data as $k => $v ) {  ?>
                    <li><span><?php echo $v->client_name; ?></span><a href="?action=edit&id=<?php echo $v->client_id; ?>"> editar </a><a class="btn-delete" href="?action=delete&id=<?php echo $v->client_id; ?>"> excluir </a></li>
                    <li><span><?php echo $v->client_email; ?></span></li>
                    <li><span><?php echo $v->client_phone; ?></span></li>
                    <li><span><?php echo $v->register_date; ?></span></li>
                <?php } } else { ?>
                <span>Nenhum cliente cadastrado ainda!</span>
            <?php } ?>
        </ul>
    </div>
</section>

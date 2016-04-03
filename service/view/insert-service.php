<?php
$fields = $this->data;
?>
<section class="container">
    <div class="wrap">
        <div class="form-content">
            <h3><?php echo $this->title_page; ?></h3>
            <?php
            $this->show_error( 'message-error' );
            $this->show_success( 'message-success' );
            ?>
        <form method="POST">
            <fieldset>
                <ul>
                    <li>
                        <label for="service-name">Nome</label>
                        <input id="service-name" type="text" name="_name" value="<?php echo $fields->service_name; ?>"/>
                    </li>
                    <li>
                        <label for="service-description">Descrição</label>
                        <textarea id="service-description" name="_description" ><?php echo $fields->service_description; ?></textarea>
                    </li>
                    <li>
                        <input class="button" type="submit" value="Salvar" name="insert_service" />
                    </li>
                </ul>
            </fieldset>
        </form>
    </div>
</section>


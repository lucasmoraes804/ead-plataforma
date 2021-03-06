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
                            <label for="client-name">Nome</label>
                            <input id="client-name" type="text" name="_name" value="<?php echo $fields->client_name; ?>"/>
                        </li>
                        <li>
                            <label for="client-email">E-mail</label>
                            <input id="client-email" type="text" name="_email" value="<?php echo $fields->client_email; ?>"/>
                        </li>
                        <li>
                            <label for="client-phone">Telefone</label>
                            <input id="client-phone" class="mask-phone" type="text" name="_phone" value="<?php echo $fields->client_phone; ?>"/>
                        </li>
                        <li>
                            <input class="button" type="submit" value="Salvar" name="insert_client" />
                        </li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
</section>


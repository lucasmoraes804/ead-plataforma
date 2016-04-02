<?php
$fields = $this->data;
echo $this->error;
echo $this->success;
?>
<section class="container">
    <div class="wrapper">
        <h3><?php echo $this->title_page; ?></h3>
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


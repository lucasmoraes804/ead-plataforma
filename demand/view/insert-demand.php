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
                        <label for="demand-client">Client</label>
                        <?php if ( count( $this->clients ) ){ ?>
                            <select name="_client_id" id="demand-client" >
                            <?php foreach( $this->clients as $client ){
                                printf(
                                    '<option value="%s" %s>%s</option>',
                                    $client->client_id,
                                    ( $client->client_id == $fields->client_id ) ? 'selected' : '',
                                    $client->client_name
                                );
                            } ?>
                            </select>
                        <?php } ?>
                    </li>
                    <li>
                        <label for="demand-service">Serviço</label>
                        <?php if ( count( $this->services ) ){ ?>
                            <select name="_service_id" id="demand-service" >
                                <?php foreach( $this->services as $service ){
                                    printf(
                                        '<option value="%s" %s>%s</option>',
                                        $service->service_id,
                                        ( $service->service_id == $fields->service_id ) ? 'selected' : '',
                                        $service->service_name
                                    );
                                } ?>
                            </select>
                        <?php } ?>
                    </li>
                    <li>
                        <label for="demand-start">Data de Início</label>
                        <input type="text" id="demand-start" name="_start" class="mask-date" value="<?php echo $fields->demand_start; ?>" >
                    </li>
                    <li>
                        <label for="demand-finish">Data de termino</label>
                        <input type="text" id="demand-finish" name="_finish" class="mask-date" value="<?php echo $fields->demand_finish; ?>" >
                    </li>
                    <li>
                        <input class="button" type="submit" value="Salvar" name="insert_demand" />
                    </li>
                </ul>
            </fieldset>
        </form>
    </div>
</section>


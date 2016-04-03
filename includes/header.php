<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>EAD Plataforma</title>

    <link href="<?php echo URL_SITE ?>assets/css/main.css" rel="stylesheet" type="text/css" />
</head>
    <header class="container header">
        <section class="wrap">
            <ul class="col twelve menu-list">
                <li class="col two"><a href="<?php echo URL_SITE ?>client">Clientes</a></li>
                <li class="col two"><a href="<?php echo URL_SITE ?>client/?action=insert">Novo Cliente</a></li>
                <li class="col two"><a href="<?php echo URL_SITE ?>service/">Serviços</a></li>
                <li class="col two"><a href="<?php echo URL_SITE ?>service/?action=insert">Novo Serviço</a></li>
                <li class="col two"><a href="<?php echo URL_SITE ?>demand/">Pedidos</a></li>
                <li class="col two"><a href="<?php echo URL_SITE ?>demand/?action=insert">Novo Pedido</a></li>
            </ul>
            <div class="col twelve welcome-header">
                <p><?php echo $this->welcome_header(); ?></p>
            </div>
        </section>
    </header>
<body>
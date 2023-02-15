<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <?php wp_head(); ?>
</head>

<body>

    <header>
        <h1>
            <?php bloginfo('name'); ?>
        </h1>

        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
                <li><?php wp_nav_menu(array('theme_location' => 'primary-menu', 'menu_class' => 'nav')) ?></li>
            </ul>
        </nav>
    </header>

    <section id="main">
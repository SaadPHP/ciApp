<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ciApp</title>
    <?= link_tag('/assets/css/bootstrap.min.css'); ?>
    <?= link_tag('/assets/fontawesome/css/fontawesome.min.css'); ?>
    <?= link_tag('/assets/fontawesome/css/all.min.css'); ?>
    <?= link_tag('/assets/styles.css'); ?>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url();?>apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url();?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url();?>favicon-16x16.png">
    <link rel="manifest" href="<?= base_url()?>site.webmanifest">
</head>
<body>
    <div class="container-fluid">
    <div class="public-header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="fas fa-sticky-note"></i> Articles</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary btn-sm my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Search</button>
            </form>
        <?= anchor('Login','<i class="fas fa-sign-in-alt"></i> Login','class="ml-2 float-right btn btn-primary btn-sm"'); ?>
        <?= anchor('UserRegistration','<i class="fas fa-user-plus"></i> Signup','class="ml-2 float-right btn btn-info btn-sm"'); ?>
        </div>
    </div>    
        </nav>
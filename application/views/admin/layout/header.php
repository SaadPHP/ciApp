<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?= link_tag('/assets/css/bootstrap.min.css'); ?>
    <?= link_tag('/assets/fontawesome/css/fontawesome.min.css'); ?>
    <?= link_tag('/assets/fontawesome/css/all.min.css'); ?>
    <?= link_tag('/assets/styles.css'); ?>
    <?= link_tag('/assets/css/jquery-te-1.4.0.css'); ?>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url();?>apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url();?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url();?>favicon-16x16.png">
    <link rel="manifest" href="<?= base_url()?>site.webmanifest">
</head>
<body>
    <?php date_default_timezone_set("Asia/Karachi"); ?>
    <div class="container-fluid">
    <div class="admin-header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <?php $role_id = $this->session->userdata('role_id'); ?>
        <a class="navbar-brand" href="#"><i class="fas fa-user-cog"></i> <?php echo $role_id == 2 ? "User's Panel" : "Admin Panel"; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" id="search" type="text" placeholder="Search">
            </form>
        <?= anchor('Login/Logout','<i class="fas fa-sign-out-alt"></i> Logout','class="ml-2 float-right btn btn-primary btn-sm"'); ?>
        </div>
    </div>
        </nav>
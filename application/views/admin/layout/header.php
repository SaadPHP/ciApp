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
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="fas fa-user-cog"></i> Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Search</button>
            </form>
        <?= anchor('Logout','<i class="fas fa-sign-out-alt"></i> Logout','class="ml-2 float-right btn btn-primary"'); ?>
        </div>
        </nav>
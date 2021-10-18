<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/bootstrap.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/card.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <script src="<?= base_url('/assets/js/jquery/jquery-3.5.1.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="<?= base_url('/assets/js/app.js') ?>"></script>


    <title>Bank</title>
</head>

<body>

    <?php

    $last = $this->uri->total_segments();
    $basename = $this->uri->segment($last);

    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link <?php if ($active = empty($basename)  ? 'selected' : '') echo $active ?>" href="<?= base_url('/') ?>"><i class="fas fa-home"></i></a>
                </li>
                <?php if (!logged_in()) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active = $basename == 'login'  ? 'selected' : '') echo $active ?> " href="<?= base_url('/auth/login') ?>">Login</a>
                    </li>
                <?php elseif (logged_in()) : ?>
                    <li class="nav-item">
                        <a class="nav-link bg-warning <?php if ($active = $basename == 'logout'  ? 'selected' : '') echo $active ?> " href="<?= base_url('/auth/logout') ?>">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($active = $basename == 'auth'  ? 'selected' : '') echo $active ?> " href="<?= base_url('/auth') ?>">Auth</a>
                    </li>
                <?php endif  ?>
                <li class="nav-item <?php if ($active = $basename == 'create_user'  ? 'selected' : '') echo $active ?>">
                    <a class="nav-link" href="<?= base_url('auth/create_user') ?>">Create user</a>
                </li>
                <?php if (logged_in()) : ?>
                    <li class="nav-item <?php if ($active = $basename == 'create-card'  ? 'selected' : '') echo $active ?>">
                        <a class="nav-link" href="<?= base_url('create-card') ?>">Create card</a>
                    </li>
                    <li class="nav-item <?php if ($active = $basename == 'show-card'  ? 'selected' : '') echo $active ?>">
                        <a class="nav-link" href="<?= base_url('show-card') ?>">Show card</a>
                    </li>
                    <li class="nav-item <?php if ($active = $basename == 'activity-log'  ? 'selected' : '') echo $active ?>">
                        <a class="nav-link" href="<?= base_url('activity-log') ?>">Activity log</a>
                    </li>
                <?php endif  ?>
            </ul>
        </div>
    </nav>

    <!-- Flash messages -->
    <div class="alert col-6">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong></strong>
    </div>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UFT-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <title><?= $this->renderSection("title") ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="<?= site_url('/css/bulma.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= site_url('/css/auto-complete.css') ?>">
    <script dcefer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
</head>
<body>

<section class="section">

    <nav class="navbar" role="navigation" aria-label="main navigation">

        <div class="navbar-menu is-active">

            <div class="navbar-start">

                <a class="navbar-item" href="<?= site_url("/") ?>">Home</a>

            </div>

            <div class="navbar-end">

                <?php if (current_user()): ?>

                    <a class="navbar-item" href="<?= site_url("/profile/show") ?>">Profile</a>

                    <?php if (current_user()->is_admin): ?>

                        <a class="navbar-item" href="<?= site_url("/admin/users") ?>">Users</a>

                        <a class="navbar-item" href="<?= site_url("/admin/charts") ?>">Charts</a>

            
                    <?php endif; ?>

                    <a class="navbar-item" href="<?= site_url("/events") ?>">Events</a>

                    <a class="navbar-item" href="<?= site_url("/logout") ?>">Log out</a>

                <?php else: ?>

                    <a class="navbar-item" href="<?= site_url("/signup") ?>">Sign up</a>

                    <a class="navbar-item" href="<?= site_url("/login") ?>">Log in</a>

                <?php endif; ?>

            </div>
        </div>
    </nav>
    
    <?php if (session()->has('warning')): ?>
        <div class="notification is-danger is-light">
            <button class="delete"></button>
            <?= session('warning') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('info')): ?>
        <div class="notification is-success is-light">
            <button class="delete"></button>
            <?= session('info') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="notification is-danger is-light">
            <button class="delete"></button>
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <?= $this->renderSection("content") ?>

</section>

<script src="<?= site_url('/js/app.js') ?>"></script>

</body>
</html>


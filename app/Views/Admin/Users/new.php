<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>New user<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">New user</h1>

<?php if (session()->has('errors')): ?>
    <ul>
        <?php foreach(session('errors') as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>



<div class="form_fields">
    <?= form_open("/admin/users/create") ?>

        <?= $this->include('Admin/Users/form') ?>

        <div class="field-actions" style="margin-top: 20px;">
        
            <button class="button is-primary">Save</button>
            <a class="button" href="<?= site_url("/admin/users") ?>">Cancel</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
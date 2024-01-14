<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Profile<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Profile</h1>

<?php if ($user->profile_image): ?>

    <img src="<?= site_url('/profile/image') ?>" width="200" height="200" alt="profile image">

    <div>
        <a class="button is-danger is-light" href="<?= site_url('/profileimage/delete') ?>">Delete profile image</a>
    </div>

<?php else: ?>

    <img src="<?= site_url('/image/blank_profile.jpeg') ?>" width="200" height="200" alt="profile image">

<?php endif; ?>

<div class="content">
    <dl>
        <dt class="has-text-weight-bold">First Name</dt>
        <dd><?= esc($user->first_name) ?></dd>

        <dt class="has-text-weight-bold">Last Name</dt>
        <dd><?= esc($user->last_name) ?></dd>

        <dt class="has-text-weight-bold">Email</dt>
        <dd><?= esc($user->email) ?></dd>

        <?php if (!empty($user->phone_number)): ?>

            <dt class="has-text-weight-bold">Phone Number</dt>
            <dd><?= esc($user->phone_number) ?></dd>

        <?php else: ?>

            <dt class="has-text-weight-bold">Phone Number</dt>
            <dd>None</dd>

        <?php endif; ?>
    </dl>
</div>

<a class="button is-link is-light" href="<?= site_url("/profile/edit") ?>">Edit</a>

<a class="button is-link is-light" href="<?= site_url("/profile/editpassword")?>">Change password</a>

<a class="button is-link is-light" href="<?= site_url("/profileimage/edit") ?>">Change profile image</a>

<?= $this->endSection() ?>

<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">User</h1>

<a href="<?= site_url("/admin/users") ?>">&laquo; back to index</a>

<div class="content">
    <dl>
        <dt class="has-text-weight-bold">First Name</dt>
        <dd><?= esc($user->first_name) ?></dd>

        <dt class="has-text-weight-bold">Last Name</dt>
        <dd><?= esc($user->last_name) ?></dd>

        <dt class="has-text-weight-bold">Email</dt>
        <dd><?= esc($user->email) ?></dd>

        <dt class="has-text-weight-bold">Active</dt>
        <dd><?= $user->is_active ? 'yes' : 'no' ?></dd>

        <dt class="has-text-weight-bold">Administrator</dt>
        <dd><?= $user->is_admin ? 'yes' : 'no' ?></dd>

        <dt class="has-text-weight-bold">Created at</dt>
        <dd><?= $user->created_at ?></dd>

        <dt class="has-text-weight-bold">Updated at</dt>
        <dd><?= $user->updated_at ?></dd>
    </dl>
</div>

<a href="<?= site_url('/admin/users/edit/' . $user->id) ?>">Edit</a>

<?php if ($user->id != current_user()->id): ?>

    <a href="<?= site_url('/admin/users/delete/' . $user->id) ?>">Delete</a>

<?php endif; ?>

<?= $this->endSection() ?>
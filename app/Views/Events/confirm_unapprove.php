<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Unapprove Event Confirmation<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Unapprove Event Confirmation</h1>

<p>Are you sure you want to unapprove this event?</p>

<form method="POST" action="<?php echo site_url('events/unapprove/'.$event->id); ?>">
    <button class="button is-danger is-light" type="submit" name="confirm" value="1">Yes, Unapprove Event</button>
    <a class="button is-link is-light" href="<?php echo site_url('events'); ?>">No, Go Back</a>
</form>

<?= $this->endSection() ?>
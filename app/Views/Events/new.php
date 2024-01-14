<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>New Event<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">New Event</h1>

<?= form_open("/events/create") ?>

    <?= $this->include('Events/form') ?>

    <div class="field-actions" style="margin-top: 20px;">
        <button class="button is-primary">Save</button>
        <a class="button" href="<?= site_url("/events") ?>">Cancel</a>
    </div>
</form>

<?= $this->endSection() ?>
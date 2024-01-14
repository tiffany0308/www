<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Delete event<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Delete event</h1>

<p>Are you sure??</p>

<div class="fields-action" style="margin-top: 20px">
<?= form_open("/events/delete/" . $event->id) ?>

    <button class="button is-primary">Yes</button>
    <a class="button" href="<?= site_url('/events/show/' . $event->id) ?>">Cancel</a>

</form>

<?= $this->endSection() ?>
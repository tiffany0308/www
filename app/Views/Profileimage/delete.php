<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Delete profile image<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Delete profile image</h1>

<div class="content">
<p>Are you sure?</p>
</div>

<?= form_open("/profileimage/delete") ?>

    <button class="button is-primary">Yes</button>
    <a class="button" href="<?= site_url("/profile/show") ?>">Cancle</a>

</form>

<?= $this->endSection() ?>
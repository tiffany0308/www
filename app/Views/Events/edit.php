<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit event<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Edit event</h1>

<div class="form-fields">
    <?= form_open("/events/update/" . $event->id)?>

        <?= $this->include('Events/form') ?>

        <div class="field action" style="margin-top: 20px">
            <button class="button is-primary">Save</button>
            <a class="button" href="<?= site_url("/events/show/" . $event->id) ?>">Cancel</a>
        </div>

    </form>
</div>
<?= $this->endSection() ?>
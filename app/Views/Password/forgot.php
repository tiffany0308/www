<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Forgot password<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Forgot password</h1>
<?= form_open("/password/processforgot") ?>

    <div class="field">
        <label class="label" for="email">Email</label>
        <input class="input" style="width: 500px" type="text" name="email" id="email" value="<?= old('email') ?>">
    </div>

    <button class="button is-primary">Send</button> <a class="button" href="/login">Cancel</a>

</form>

<?= $this->endSection() ?>


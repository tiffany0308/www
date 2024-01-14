<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit profile image<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Edit profile image</h1>

<?= form_open_multipart("/profileimage/update") ?>

    <div class="file has-name">
        <label class="file-label">
            <input class="file-input" type="file" name="image" onchange="showFileName(this)">
            <span class="file-cta">
                <span class="file-icon">
                    <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                    Choose a file...
                </span>
            </span> 
            <span class="file-name">
            </span>
        </label>
    </div>
    
    <script>
    function showFileName(input) {
        var fileLabel = input.parentNode.querySelector('.file-name');
        fileLabel.textContent = input.files[0].name;
    }
    </script>

    <div class="field is-grouped" style="margin-top: 10px;">
            <button class="button is-primary" style="margin-right: 20px;">Upload</button>
            <a class="button" href="<?= site_url("/profile/show") ?>">Cancel</a>
    </div>
</form>

<?= $this->endSection() ?>

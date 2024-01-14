<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Event Rating<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1 class="title">Event Rating</h1>
<a href="<?= site_url('events/show/'.$event->id) ?>" class="button is-link is-light">back</a>
<p class="has-text">Rate this event:</p>
<form action="<?= site_url('events/rate/'.$event->id) ?>" method="POST">
    <div id="ratingStars">
        <span class="star" data-rating="1">★ </span> 
        <span class="star" data-rating="2">★ </span> 
        <span class="star" data-rating="3">★ </span> 
        <span class="star" data-rating="4">★ </span> 
        <span class="star" data-rating="5">★ </span> 
        <input type="hidden" name="rating" id="ratingInput" value="<?= old('rating') ?>" ?>
        <?= csrf_field() ?>
    </div>

    <button type="submit" class="button" id="confirmButton" disabled>Confirm Rating</button>
</form>

<style>
.star { 
    font-size: 10vh; 
    cursor: pointer;
} 

.star.selected {
    color: orange;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ratingStars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('ratingInput');
        const confirmButton = document.getElementById('confirmButton');

        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.dataset.rating;
                ratingInput.value = rating;

                ratingStars.forEach(star => {
                    star.classList.remove('selected');
                    if (star.dataset.rating <= rating) {
                        star.classList.add('selected');
                    }
                });

                confirmButton.disabled = false;
            });
        });
    });
</script>

<?= $this->endSection() ?>
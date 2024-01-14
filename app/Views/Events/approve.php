<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Unapproved event<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Unapproved event</h1>

<?php if ($events): ?>
    <ul>
        <?php foreach ($events as $event): ?>

        <li>
            <div class="card">
                <div class="card-content" style="width-500px">
                    <div class="content">
                        <a class="title is-4" href="<?= site_url("/events/show/" . $event->id) ?>">
                            <?= esc($event->title) ?>
                        </a>
                        <br>
                        <?= esc($event->description) ?>
                        <br>
                        Event duration:  <?= date('H:i', strtotime($event->start_time)) ?> to <?= date('H:i', strtotime($event->end_time)) ?>
                        <div class="button-container">
                            <?php if ($event->approval != 1): ?>
                                <a class="button is-primary" href="<?php echo site_url('events/approveEvent/'.$event->id); ?>">Approve</a>
                            <?php endif; ?>
                        </div>
                    </div>
                 </div>
            <div>
        </li>

        <?php endforeach; ?>
    </ul>

    <?= $pager->simplelinks() ?>

<?php else: ?>

    <p>No events found.</p>

<?php endif; ?>
<br>
<a class="button is-link is-light" href="/events">back</a>

<script src="<?= site_url('/js/auto-complete.min.js') ?>"></script>

<script>
    var searchUrl = "<?= site_url('/events/search?q=') ?>";
    var showUrl = "<?= site_url('/events/show/') ?>";
    var data;
    var i;

    var searchAutoComplete = new autoComplete({
        selector: 'input[name="query"]',
        cache: false,
        source: function (term, response) {
            var request = new XMLHttpRequest();
            request.open('GET', searchUrl + term, true);

            request.onload = function () {
                data = JSON.parse(this.response);
                i = 0;
                var suggestions = data.map(event => event.title);
                response(suggestions);
            };

            request.send();
        },
        renderItem: function (item, search) {
            var id = data[i].id;
            i++;
            return '<div class="autocomplete-suggestion" data-id="' + id + '">' + item + '</div>';
        },
        onSelect: function (e, term, item) {
            window.location.href = showUrl + item.getAttribute('data-id');
        }
    });
</script>

<?= $this->endSection() ?>
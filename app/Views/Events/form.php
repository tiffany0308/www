<style>
    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 10px;
    }

    .tag {
        display: inline-block;
        background-color: #f2f2f2;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .tag.selected {
        background-color: #007bff;
        color: #fff;
    }
</style>
<div class="form-fields">
    <div class="field" style="width: 600px">
        <label class="label" for="title">Title</label>
        <input class="input <?= session('errors.title') ? 'is-danger' : '' ?>" placeholder="enter your title of the event here" type="text" name="title" id="title" value="<?= old('title', esc($event->title)) ?>">
        <?php if (session('errors.title')): ?>
            <p class="help is-danger"><?= session('errors.title') ?></p>
        <?php endif; ?>
    </div>
	
    <div class="field" style="width: 700px">
    <label class="label" for="description">Description</label>
    <textarea class="textarea <?= session('errors.description') ? 'is-danger' : '' ?>" placeholder="enter your description of the event here" name="description" id="description"><?= old('description', esc($event->description)) ?></textarea>
	<?php if (session('errors.description')): ?>
		<p class="help is-danger"><?= session('errors.description') ?></p>
	<?php endif; ?>
	</div>

	<div class="field">
    <label class="label" for="day_of_week">Which Day of Week</label>
    <div class="control">
        <div class="select">
            <select id="day_of_week" name="day_of_week">
                <option value="Monday" <?php if (old('day_of_week', $event->day_of_week) === 'Monday'): ?>selected<?php endif; ?>>Monday</option>
                <option value="Tuesday" <?php if (old('day_of_week', $event->day_of_week) === 'Tuesday'): ?>selected<?php endif; ?>>Tuesday</option>
                <option value="Wednesday" <?php if (old('day_of_week', $event->day_of_week) === 'Wednesday'): ?>selected<?php endif; ?>>Wednesday</option>
                <option value="Thursday" <?php if (old('day_of_week', $event->day_of_week) === 'Thursday'): ?>selected<?php endif; ?>>Thursday</option>
                <option value="Friday" <?php if (old('day_of_week', $event->day_of_week) === 'Friday'): ?>selected<?php endif; ?>>Friday</option>
                <option value="Saturday" <?php if (old('day_of_week', $event->day_of_week) === 'Saturday'): ?>selected<?php endif; ?>>Saturday</option>
                <option value="Sunday" <?php if (old('day_of_week', $event->day_of_week) === 'Sunday'): ?>selected<?php endif; ?>>Sunday</option>
            </select>
        </div>
    </div>
	<?php if (session('errors.day_of_week')): ?>
		<p class="help is-danger"><?= session('errors.day_of_week') ?></p>
	<?php endif; ?>

	<div class="field" style="width: 300px">
        <label class="label" for="start_time">Start time</label>
        <input class="input <?= session('errors.start_time') ? 'is-danger' : '' ?>" type="time" placeholder="e.g 14:30" name="start_time" id="start_time" value="<?= old('start_time', esc($event->start_time)) ?>">
		<?php if (session('errors.start_time')): ?>
            <p class="help is-danger"><?= session('errors.start_time') ?></p>
        <?php endif; ?>
	</div>
	<div class="field" style="width: 300px">
        <label class="label" for="end_time">End time</label>
        <input class="input <?= session('errors.end_time') ? 'is-danger' : '' ?>" type="time" placeholder="e.g 14:30" name="end_time" id="end_time" value="<?= old('end_time', esc($event->end_time)) ?>">
		<?php if (session('errors.end_time')): ?>
            <p class="help is-danger"><?= session('errors.end_time') ?></p>
        <?php endif; ?>
	</div>
	<div class="field" style="width: 600px">
        <label class="label" for="location">Venue</label>
        <input class="input <?= session('errors.location') ? 'is-danger' : '' ?>" type="text" placeholder="address of the venue" name="location" id="location" value="<?= old('location', esc($event->location)) ?>">
        <p class="help is-info">no need to input the venue if the format of event is online</p>
		<?php if (session('errors.location')): ?>
            <p class="help is-danger"><?= session('errors.location') ?></p>
        <?php endif; ?>
	</div>
	<div class="field" style="width: 300px">
        <label class="label" for="organizer">Organizer</label>
        <input class="input <?= session('errors.organizer') ? 'is-danger' : '' ?>" type="text" placeholder="name of the organizer" name="organizer" id="organizer" value="<?= old('organizer', esc($event->organizer)) ?>">
		<?php if (session('errors.organizer')): ?>
            <p class="help is-danger"><?= session('errors.organizer') ?></p>
        <?php endif; ?>
	</div>
    <div class="field" style="width: 300px">
        <label class="label" for="email">Email</label>
        <input class="input <?= session('errors.email') ? 'is-danger' : '' ?>" type="text" placeholder="email address" name="email" id="email" value="<?= old('email', esc($event->email)) ?>">
		<?php if (session('errors.email')): ?>
            <p class="help is-danger"><?= session('errors.email') ?></p>
        <?php endif; ?>
	</div>
	<div class="field" style="width: 300px">
        <label class="label" for="contact_number">Contact number</label>
        <input class="input <?= session('errors.contact_number') ? 'is-danger' : '' ?>" type="tel" placeholder="contact number of the organizer" name="contact_number" id="contact_number" value="<?= old('contact_number', esc($event->contact_number)) ?>">
		<?php if (session('errors.contact_number')): ?>
            <p class="help is-danger"><?= session('errors.contact_number') ?></p>
        <?php endif; ?>
        </div>
        <div class="field" style="width: 600px">
    <label class="label" for="tags">Tags</label>
    <p class="help is-info">Click to choose the tags for the event</p>
    <br>
    <div class="tags">
        <?php
        $tags = ['online', 'offline', 'casual chat', 'dine together', 'in-depth discussion', 'banking', 'law', 'accounting', 'business', 'social welfare', 'medical and nursing', 'information technology', 'others'];
        $selectedTags = (array) (old('tags', $event->tags) ?? []); 
        $selectedTagsString = implode(',', $selectedTags); 
        $submittedTags = isset($_POST['tags']) ? $_POST['tags'] : '';

        foreach ($tags as $tag): ?>
            <div class="tag <?= (strpos($submittedTags, $tag) !== false || in_array($tag, explode(',', $selectedTagsString))) ? 'selected' : '' ?>"><?= $tag ?></div>
        <?php endforeach; ?>
    </div>
    <input type="hidden" name="tags" value="<?= old('tags', esc($event->tags)) ?>">
</div>

<script>
    const tagsContainer = document.querySelector('.tags');
    const tagsInput = document.querySelector('input[name="tags"]');

    tagsContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('tag')) {
            event.target.classList.toggle('selected');
            updateTagsInput();
        }
    });

    function updateTagsInput() {
        const selectedTags = Array.from(tagsContainer.getElementsByClassName('tag')).filter(tagElement => tagElement.classList.contains('selected')).map(tagElement => tagElement.innerText);
        tagsInput.value = selectedTags.join(',');
    }
</script>
</div>
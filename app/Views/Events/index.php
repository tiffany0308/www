<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Events<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1 class="title">Events</h1>

<p class="buttons">
    <a class="button is-link is-light" href="<?= site_url("/events/new") ?>">
    <span class="icon is-small">
        <i class="fas fa-plus"></i>
    </span>
    <span>New event</span></a> 
    <?php if (current_user()->is_admin == 1): ?>
        <a class="button is-primary is-light" href="<?= site_url("/events/approve") ?>">
        <span class="icon is-small">
            <i class="fas fa-check"></i>
        </span>
        <span>Approve event</span></a>
    <?php endif; ?>
</p>
<div>
    <p class="control has-icons-left">
        <input class="input" name="query" id="query" placeholder="Search">
        <span class="icon is-small is-left">
            <i class="fas fa-search"></i>
        </span>
    </p>
    
    <p class="label">tags:</p>
    <div id="tagList" class="tags"></div>
</div>
<style>
    .button {
        margin-bottom: 10px;
    }
    .input {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 500px;
        margin-bottom: 10px;

    }

    a.title.is-4 {
        color: black; 
        text-decoration: none; 
    }

    a.title.is-4:hover {
        color: blue; 
    }
    .card {
        margin: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 16px;
        background-color: #f5f5f5;
    }

    .card-content {
        display: flex;
    }

    .content {
        display: flex;
        flex-direction: column;
    }

    .title.is-4 {
        color: #333;
        font-size: 35px;
        font-weight: bold;
        text-decoration: none;
    }

    .description-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .event-duration {
        margin-right: 5px;
    }

    .rating-wrapper {
        margin-left: 100px;
        display: flex;
    }
    .star {
        font-size: 20px; 
        color: gray;
        margin-right: 2px;
    }
    .star.filled {
        color: orange;
    }

    .rating-value {
        font-size: 40px;
        font-weight: bold;
        color: orange;
    }

    .description {
        margin-top: 5px;
    }
    .tag {
        cursor: pointer;
    }
    .tags {
        margin: 10px;
    }
</style>
<?php if ($events): ?>
    <ul class="event-list">
        <?php foreach ($events as $event): ?>
            <li class="event" data-tags="<?= is_array($event->tags) ? implode(',', $event->tags) : $event->tags ?>">
            <div class="card">
                <div class="card-content">
                    <div class="content">
                        <div class="title-wrapper">
                            <a class="title is-4" href="<?= site_url("/events/show/" . $event->id) ?>">
                                <?= esc($event->title) ?>
                            </a>
                        </div>
                        <div class="description-wrapper">
                            <span class="event-duration">
                                Event duration: <?= date('H:i', strtotime($event->start_time)) ?> to <?= date('H:i', strtotime($event->end_time)) ?>
                            </span>
                            <div class="rating-wrapper">
                                <span class="rating-value"><?= esc($event->average_rating) ?></span>
                                <div class="rating-stars">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <?php if ($i <= $event->average_rating) : ?>
                                            <span class="star filled">★</span>
                                        <?php else : ?>
                                            <span class="star">★</span>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>                            
                            </div>
                        </div>
                        <div class="description">
                            <?= esc($event->description) ?>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>

    <?= $pager->simplelinks() ?>

<?php else: ?>

    <p>No events found.</p>

<?php endif; ?>

<script src="<?= site_url('/js/auto-complete.min.js') ?>"></script>
    
<script>
    var searchUrl = "<?= site_url('/events/search?q=') ?>";
    var showUrl = "<?= site_url('/events/show/') ?>";
    var data;
    var i;
            
    var searchAutoComplete = new autoComplete({
        selector: 'input[name="query"]',
        cache: false,
        source: function(term, response) {

            var request = new XMLHttpRequest();

            request.open('GET', searchUrl + term, true);

            request.onload = function() {
                
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
        onSelect: function(e, term, item){
            
            window.location.href = showUrl + item.getAttribute('data-id');
            
        }
    });
    
</script>
<script>
var selectedTags = [];
var tagList = document.getElementById('tagList');
var eventList = document.getElementsByClassName('event-list')[0];

var tags = ['online', 'offline', 'casual chat', 'dine together', 'in-depth discussion', 'banking', 'law', 'accounting', 'business', 'social welfare', 'medical and nursing', 'information technology', 'others'];
renderTags();

function renderTags() {
  tags.forEach(tag => {
    var tagElement = document.createElement('span');
    tagElement.textContent = tag;
    tagElement.classList.add('tag', 'is-light', 'is-rounded', 'is-medium');
    tagElement.addEventListener('click', function() {
      toggleTag(tagElement, tag);
    });
    tagList.appendChild(tagElement);
  });
}

function toggleTag(tagElement, tag) {
  var index = selectedTags.indexOf(tag);
  if (index === -1) {
    selectedTags.push(tag);
    tagElement.classList.add('is-primary');
  } else {
    selectedTags.splice(index, 1);
    tagElement.classList.remove('is-primary');
  }
  filterResults();
}

function filterResults() {
  var eventElements = eventList.getElementsByClassName('event');
  for (var i = 0; i < eventElements.length; i++) {
    var eventElement = eventElements[i];
    var eventTags = eventElement.getAttribute('data-tags').split(',');

    var showEvent = selectedTags.every(tag => eventTags.includes(tag));

    if (showEvent) {
      eventElement.style.display = 'block';
    } else {
      eventElement.style.display = 'none';
    }
  }
}
</script>
<?= $this->endSection() ?>
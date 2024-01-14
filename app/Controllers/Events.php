<?php

namespace App\Controllers;

use App\Models\EventModel;

class Events extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new EventModel();
        $this->current_user = service('auth')->getCurrentUser();
    }

    public function index()
    {
        $data = $this->model->where('approval', 1)->paginateAllEvents();

        return view('Events/index', [
            'events' => $data,
            'pager' => $this->model->pager
        ]);
    }

    public function show($id)
    {
        $event = $this->model->where('id', $id)
                             ->first();

        if ($event === null) {
            throw new PageNotFoundException("Event with id $id not found");
        }

        return view('Events/show', [
            'event' => $event
        ]);
    }

    public function new()
    {
        $event = new \App\Entities\Event();
        return view('Events/new', [
            'event' => $event
        ]);
    }

    public function create()
    {
        $eventData = $this->request->getPost();
    $eventData['user_id'] = intval($this->current_user->id);

    if ($this->model->insert($eventData)) {
        return redirect()->to("/events/show/{$this->model->insertID}")
            ->with('info', 'Event uploaded successfully');
    } else {
        return redirect()->back()
            ->with('errors', $this->model->errors())
            ->with('warning', 'Invalid data')
            ->withInput();
    }
    }
    

    public function edit($id)
    {
        $event = $this->model->where('id', $id)
                             ->first();

        if ($this->current_user->id != $event->user_id && $this->current_user->is_admin != 1) {
            return redirect()->to('/events')->with('error', 'You do not have permission to edit this event.');
        }

        return view('Events/edit', [
            'event' => $event
        ]);
    }

    public function update($id)
    {
        $event = $this->model->where('id', $id)
                             ->first();

        if ($this->current_user->id != $event->user_id && $this->current_user->is_admin != 1) {
            return redirect()->to('/events')->with('error', 'You do not have permission to update this event.');
        }

        $post = $this->request->getPost();

        $event->fill($post);

        if (!$event->hasChanged()) {
            return redirect()->back()
                ->with('warning', 'Nothing to update')
                ->withInput();
        }

        if ($this->model->save($event)) {
            return redirect()->to("/events/show/$id")
                ->with('info', 'Event updated successfully');
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }

    public function delete($id)
    {
        $event = $this->model->where('id', $id)
                             ->first();

        if ($this->current_user->id != $event->user_id && $this->current_user->is_admin !== 1) {
            return redirect()->to('/events')->with('error', 'You do not have permission to update this event.');
        }

        if ($this->request->getMethod() === 'post') {
            $this->model->delete($id);

            return redirect()->to('/events')
                ->with('info', 'Event deleted');
        }

        return view('Events/delete', [
            'event' => $event
        ]);
    }

    public function search()
    {
        $events = $this->model->search($this->request->getGet('q'));

        return $this->response->setJSON($events);
    }
    
    public function approve()
    {
        if ($this->current_user->is_admin != 1) {
            return redirect()->to('/events')->with('error', 'You do not have permission to access this page.');
        }

        $data = $this->model->where('approval', null)
                            ->orWhere('approval', 0)
                            ->paginateAllEvents();

        return view('Events/approve', [
            'events' => $data,
            'pager' => $this->model->pager
        ]);
    }

    public function approveEvent($id)
    {
        if ($this->current_user->is_admin != 1) {
            return redirect()->to('/events')->with('error', 'You do not have permission to access this page.');
        }
        $event = $this->model->where('id', $id)
                             ->first();
                             

        if ($event->approval != 1) {
            $event->approval = 1;

    
            if ($this->model->save($event)) {
                return redirect()->back()->with('info', 'Event approved successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to approve event.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid event or event already approved.');
        }
    }

    public function unapproveEvent($id)
    {
        if ($this->current_user->is_admin != 1) {
            return redirect()->to('/events')->with('error', 'You do not have permission to access this page.');
        }
    
        $event = $this->model->where('id', $id)
                             ->first();
    
        if ($event->approval != 0) {
            $event->approval = 0;
    
            if ($this->model->save($event)) {
                return redirect()->back()->with('info', 'Event unapproved successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to unapprove event.');
            }
        } else {
            return view('Events/confirm_unapprove', ['event' => $event]);
        }
    }

    public function rating($id)
    {
        $event = $this->model->where('id', $id)
                             ->first();

        return view('Events/rating', [
            'event' => $event
        ]);

    }
    public function rate($id)
    {
        $rating = $this->request->getPost('rating');
        $success = $this->rateEvent($id, $rating);
    
        if ($success) {
    
            return redirect()->back()->with('info', 'Thank you for rating the event.');
        } else {
            return redirect()->back()->with('error', 'Failed to rate the event.');
        }
    }
    public function rateEvent($id, $rating)
    {
        $event = $this->model->where('id', $id)
                             ->first();

        if ($event === null) {
            return false;
        }
    
        $currentTotalRatings = $event->total_ratings;
        $numberOfRatings = $event->number_of_ratings;
        
        $newTotalRatings = $currentTotalRatings + $rating;
        $newAverageRating = round($newTotalRatings / ($numberOfRatings + 1), 1);
        
        $event->average_rating = $newAverageRating;
        $event->total_ratings = $newTotalRatings;
        $event->number_of_ratings = $numberOfRatings + 1;
        
        $this->model->save($event);
        return true;
    }
    

    private function getEventOr404($id)
    {
        $event = $this->model->where('id', $id)
                             ->where('user_id', $this->current_user->id)
                             ->first();

        if ($event === null) {
            throw new PageNotFoundException("Event with id $id not found");
        }

        return $event;
    }
}

<?php

namespace App\Controllers;

use App\Models\JoinModel;
use App\Models\EventModel;

class JoinEvent extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new JoinModel();
    }

    public function showJoinEventForm($eventId)
    {
        $eventModel = new EventModel();
        $event = $eventModel->find($eventId);

        $joinevent = new \App\Entities\Join();

        return view('JoinEvent/form', [
            'eventId' => $event->id,
            'joinevent' => $joinevent
        ]);
    }

    public function saveJoinEventForm($eventId)
    {
        $joinevent = new \App\Entities\Join($this->request->getPost());
    
        $joinevent->event_id = $eventId;
    
        if ($this->model->insert($joinevent)) {
            $joinEventId = $this->model->insertID();
    
            $this->sendjoinEventEmail($eventId, $joinEventId);
    
            return redirect()->back()->with('info', 'Success in sending a request to be a participants.');
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }

    public function sendJoinEventEmail($eventId, $id)
    {
        $eventModel = new EventModel();
        $event = $eventModel->find($eventId);

        $joinevent = $this->model->find($id);

        $organizer = $event->email;

        $eventName = $event->title;

        $email = service('email');

        $email->setTo($organizer);
        $email->setSubject('participant request for ' . $eventName);

        $message = view('JoinEvent/request_email', [
            'name' => $joinevent->name,
            'phone' => $joinevent->phone,
            'email' => $joinevent->email,
            'occupation' => $joinevent->occupation,
            'reason' => $joinevent->reason,
            'eventName' => $eventName
        ]);

        $email->setMessage($message);

        $email->send();

        session()->setFlashdata('success', 'participant registration request sent successfully.');

        return redirect()->back();
    
    }
}
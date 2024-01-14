<?php

namespace App\Controllers;

use App\Models\VolunteerModel;
use App\Models\EventModel;

class Volunteers extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new VolunteerModel();
    }

    public function showVolunteerForm($eventId)
    {
        $eventModel = new EventModel();
        $event = $eventModel->find($eventId);

        $volunteer = new \App\Entities\Volunteer();

        return view('Volunteers/form', [
            'eventId' => $event->id,
            'volunteer' => $volunteer
        ]);
    }

    public function saveVolunteerForm($eventId)
    {
        $volunteer = new \App\Entities\Volunteer($this->request->getPost());
    
        $volunteer->event_id = $eventId;
    
        if ($this->model->insert($volunteer)) {
            $volunteerId = $this->model->insertID();
    
            $this->sendVolunteerEmail($eventId, $volunteerId);
    
            return redirect()->back()->with('info', 'Success in sending a request to be a volunteer.');
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->with('warning', 'Invalid data')
                ->withInput();
        }
    }

    public function sendVolunteerEmail($eventId, $id)
    {
        $eventModel = new EventModel();
        $event = $eventModel->find($eventId);

        $volunteer = $this->model->find($id);

        $organizer = $event->email;

        $eventName = $event->title;

        $email = service('email');

        $email->setTo($organizer);
        $email->setSubject('Volunteer request for ' . $eventName);

        $message = view('Volunteers/request_email', [
            'name' => $volunteer->name,
            'phone' => $volunteer->phone,
            'email' => $volunteer->email,
            'occupation' => $volunteer->occupation,
            'reason' => $volunteer->reason,
            'eventName' => $eventName
        ]);

        $email->setMessage($message);

        $email->send();

        session()->setFlashdata('success', 'Volunteer registration request sent successfully.');

        return redirect()->back();
    
    }
}
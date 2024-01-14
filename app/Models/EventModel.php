<?php

namespace App\Models;


class EventModel extends \CodeIgniter\Model
{
    protected $table = 'event';

    protected $allowedFields = ['title', 'description', 'day_of_week', 'start_time', 'end_time', 'location', 'organizer', 'contact_number','approval','total_ratings','average_rating','number_of_ratings', 'tags', 'email','user_id'];

    protected $returnType = 'App\Entities\Event';

    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required',
        'description' => 'required',
        'organizer' => 'required',
        'email' => 'required|valid_email',
        'day_of_week' => 'required',
        'contact_number' => 'required|numeric|exact_length[8]',
        'start_time' => 'required',
        'end_time' => 'required'
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Please enter the title.'
        ],
        'description' => [
            'required' => 'Please enter the description.'
        ],
        'organizer' => [
            'required' => 'Please enter the name of the organizer.'
        ],
        'day_of_week' => [
            'required' => 'Please choose the day of week of the event.'
        ],
        'email' => [
            'required' => 'Please enter your email.',
            'valid_email' => 'Please enter your email address in the correct format.'
        ],
        'contact_number' => [
            'required' => 'Please enter the contact number of the organizer.',
            'numeric' => 'The contact number must be numeric.',
            'exact_length' => 'The contact number must be exactly 8 digits long.'
        ],
        'start_time' => [
            'required' => 'Please choose the starting time of the event.'
        ],
        'end_time' => [
            'required' => 'Please choose the ending time of the event.'
        ]
    ];

    public function paginateAllEvents()
    {
        return $this->orderBy('created_at')
            ->paginate(5);
    }

    public function getEventByUserId($id, $user_id)
    {
        return $this->where('id', $id)
            ->where('user_id', $user_id)
            ->first();
    }

    public function search($term)
    {
        if ($term === null) {
            return [];
        }

        return $this->select('id, title')
            ->like('title', $term)
            ->get()
            ->getResultArray();
    }


}
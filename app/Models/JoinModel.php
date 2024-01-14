<?php

namespace App\Models;

class JoinModel extends \CodeIgniter\Model
{
    protected $table = 'joinevent';

    protected $allowedFields = ['name', 'phone', 'email', 'occupation', 'reason', 'event_id'];

    protected $returnType = 'App\Entities\Join';

    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required',
        'occupation' => 'required',
        'email' => 'required|valid_email',
        'phone' => 'required|numeric|exact_length[8]',
        'reason' => 'required'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Please enter your name.'
        ],
        'occupation' => [
            'required' => 'Please enter your occupation.'
        ],
        'email' => [
            'required' => 'Please enter your email.',
            'valid_email' => 'Please enter your email address in the correct format.'
        ],
        'phone' => [
            'required' => 'Please enter your phone number.',
            'numeric' => 'Phone number should be numeric.',
            'exact_length[8]' => 'Phone number should be 8 digits.'
        ],
        'reason' => [
            'required' => 'Please enter the reason for joining.'
        ]
    ];
}
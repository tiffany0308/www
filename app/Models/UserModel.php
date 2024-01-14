<?php

namespace App\Models;

use App\Libraries\Token;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'user';

    protected $allowedFields = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'activation_hash', 'reset_hash', 
                                'reset_expires_at'];

    protected $returnType = 'App\Entities\User';

    protected $useTimestamps = true;

    protected $validationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'phone_number' => 'permit_empty|numeric|exact_length[8]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]'
    ];

    protected $validationMessages =[
        'first_name' => [
            'required' => 'Please enter your first name.'
        ],
        'last_name' => [
            'required' => 'Please enter your last name.'
        ],
        'email' => [
            'required' => 'Please enter your email.',
            'valid_email' => 'Please enter your email address in a correct format.',
            'is_unique' => 'That email is taken'
        ],
        'phone_number' => [
            'numeric' => 'Phone number should be numeric',
            'exact_length[8]' => 'Phone number should be in 8 digits.'
        ],
        'password' => [
            'required' => 'Please enter your password.',
            'min_length[6]' => 'The length of passowrd should be at least 6 digits.'
        ],
        'password_confrimation' => [
            'required' => 'Please confirm the password',
            'matches' => 'Please enter the same password again'
        ]
    ];

    protected $beforeInsert = ['hashPassword'];

    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }

    public function findByEmail($email)
    {
        return $this->where('email', $email)
                    ->first();
    }

    public function disablePasswordValidation()
    {
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    public function activateByToken($token)
    {
        $token = new Token($token);

        $token_hash = $token->getHash();

        $user = $this->where('activation_hash', $token_hash)
                     ->first();

        if ($user !== null) {

            $user->activate();

            $this->protect(false)
                 ->save($user);
        }
    }

    public function getUserForPasswordReset($token)
    {
        $token = new Token($token);

        $token_hash = $token->getHash();

        $user = $this->where('reset_hash', $token_hash)
                     ->first();

        if ($user) {

            if ($user->reset_expires_at < date('Y-m-d H:i:s')) {

                $user = null;

            }
        }

        return $user;
    }
}
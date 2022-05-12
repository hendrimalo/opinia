<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use \Firebase\JWT\KEY;

class User extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function login()
    {
        helper(['form']);
        $rules = [
            'email'     => 'required|valid_email',
            'password'  => 'required|min_length[6]',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new UserModel();
        $user = $model->where("email", $this->request->getVar('email'))->first();
        if(!$user) return $this->failNotFound('Email Not Found');

        $verify = password_verify($this->request->getVar('password'), $user['password']);
        if(!$verify) return $this->fail('Wrong Password');

        $key = getenv('TOKEN_SECRET');
        $payload = array(
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "uid"   => $user['id_user'],
            "email" => $user['email']
        );

        $token = JWT::encode($payload, $key, 'HS256');

        return $this->respond($token);
    }

    public function register()
    {
        helper(['form']);
        $rules = [
            'fullname'   => 'required|min_length[6]',
            'email'      => 'required|valid_email|is_unique[users.email]',
            'phone'      => 'required|min_length[12]',
            'password'   => 'required|min_length[6]',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'fullname'  => $this->request->getVar('fullname'),
            'email'     => $this->request->getVar('email'),
            'phone'     => $this->request->getVar('phone'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
        ];
        $model = new UserModel();
        $registered = $model->save($data);
        $response = [
            'status'    => 200,
            'error'     => null,
            'message'   => [
                'success'   => 'Data User Success Created'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}

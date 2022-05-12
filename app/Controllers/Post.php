<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PostModel;

class Post extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new PostModel();
        $model->select('posts.id_post, posts.title, posts.description,  post_types.jenis, post_types.type, posts.user');
        $data['posts'] = $model->join('post_types', 'post_type = id_post_type')->findAll();
        if($data) {
            $response = [
                'status'    => 200,
                'error'     => null,
                'data'      => $data
            ];
            return $this->respond($response);
        }
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
        helper(['form']);
        $rules = [
            'title'         => 'required',
            'description'   => 'required',
            'post_type'     => 'required',
            'user'          => 'required',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'title' => $this->request->getVar('title'),
            'jenis' => $this->request->getVar('jenis'),
            'description' => $this->request->getVar('description'),
            'post_type' => $this->request->getVar('post_type'),
            'user' => $this->request->getVar('user'),
        ];

        $model = new PostModel();
        $created = $model->save($data);
        if($created) {
            $response = [
                'status'    => 200,
                'error'     => null,
                'message'   => [
                    'success'   => 'Success create data Post',
                    'data'      => $created
                ]
            ];
            return $this->respond($response);
        } else {
            $response = [
                'status'    => 401,
                'error'     => 'Error create data Post',
            ];
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $mmodel = new PostModel();
        $getById = $model->where('id_post', $id)->first();
        if(!empty($getById)) {
            $model->update($id, [
                'jenis' => $this->request->getVar('jenis'),
                'description' => $this->request->getVar('description'),
                'post_type' => $this->request->getVar('post_type'),
                'user' => $this->request->getVar('user'),
            ]);
            $response = [
                'status'    => 200,
                'error'     => null,
                'message'   => [
                    'success'   => 'Success edit data Post'
                ]
            ];
            return $this->respond($response);
        } else {
            $response = [
                'status'    => 401,
                'error'     => 'Error edit data Post Type',
            ];
            return $this->respond($response);
        }
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
        $model = new PostModel();
        $getById = $model->where('id_post', $id)->first();
        if(!empty($getById)) {
            $model->delete($id);
            $response = [
                'status'    => 200,
                'error'     => null,
                'message'   => [
                    'success'   => 'Success delete data Post'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status'    => 401,
                'error'     => 'Error delete data Post',
            ];
            return $this->respond($response);
        }
    }
}

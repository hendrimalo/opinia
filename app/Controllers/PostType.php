<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PostTypeModel;

class PostType extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new PostTypeModel();
        $data['post_types'] = $model->orderBy('id_post_type', 'DESC')->findAll();
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
            'jenis'     => 'required',
            'type'      => 'required',
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $data = [
            'jenis' => $this->request->getVar('jenis'),
            'type'  => $this->request->getVar('type'),
        ];
        
        $model = new PostTypeModel();
        $created = $model->save($data);
        if($created) {
            $response = [
                'status'    => 200,
                'error'     => null,
                'message'   => [
                    'success'   => 'Success create data Post Type',
                    'data'      => $created
                ]
            ];
            return $this->respond($response);
        } else {
            $response = [
                'status'    => 401,
                'error'     => 'Error create data Post Type',
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
        $model = new PostTypeModel();
        $getById = $model->where('id_post_type', $id)->first();
        if(!empty($getById)) {
            $model->update($id, [
                'jenis' => $this->request->getPost('jenis'),
                'type' => $this->request->getPost('type'),
            ]);
            $response = [
                'status'    => 200,
                'error'     => null,
                'message'   => [
                    'success'   => 'Success edit data Post Type'
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
        $model = new PostTypeModel();
        $getById = $model->where('id_post_type', $id)->first();
        if(!empty($getById)) {
            $model->delete($id);
            $response = [
                'status'    => 200,
                'error'     => null,
                'message'   => [
                    'success'   => 'Success create data Post Type'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'status'    => 401,
                'error'     => 'Error delete data Post Type',
            ];
            return $this->respond($response);      
        }
    }
}

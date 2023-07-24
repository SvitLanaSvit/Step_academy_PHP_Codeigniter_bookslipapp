<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\RESTful\ResourceController;

class BooksLib extends ResourceController
{
    protected $modelName = 'App\Models\BookModel';
    protected $format = 'json';
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
        $model = new BookModel();
        $books = $model->orderBy("id", "DESC")->findAll();
        if ($books) {
            $data["books"] = $books;
            return $this->respond($data);
        } else {
            return $this->failNotFound("No books found!");
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
        $model = new BookModel();
        $data = $model->where("id", $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound("No such book!");
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $model = new BookModel();
        $data = [
            "titleBook" => $this->request->getVar("titleBook"),
            "price" => $this->request->getVar("price"),
            "authorId" => $this->request->getVar("authorId"),
            "yearOfPablish" => $this->request->getVar("yearOfPablish")
        ];

        $model->insert($data);
        $response = [
            "status" => 201,
            "error" => null,
            "messages" => [
                "success" => "Book successfully added"
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $model = new BookModel();
        $data = [
            "titleBook" => $this->request->getVar("titleBook"),
            "price" => $this->request->getVar("price"),
            "authorId" => $this->request->getVar("authorId"),
            "yearOfPablish" => $this->request->getVar("yearOfPablish")
        ];
        if($id ){
            $model->update($id, $data);
            $response = [
                "status"=>200,
                "error"=>null,
                "messages"=>[
                    "success" => "Book with id = $id successfully updated"
                ]
            ];
            return $this->respond($response);
        }
        else{
            return $this->failNotFound("Book was not found!!!");
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
        $model = new BookModel();
        $data = $model->where("id", $id)->delete($id);
        if($data){
            $response = [
                "status"=>200,
                "error"=>null,
                "data"=>$data,
                "messages"=>[
                    "success" => "Book with id = $id successfully deleted"
                ]
            ];
            return $this->respond($response);
        }
        else{
            return $this->failNotFound("Book was not found!!!");
        }
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthorModel;
use CodeIgniter\Model;

class Authors extends BaseController
{
    public function getIndex()
    {
        //
        $model = Model(AuthorModel::class);
        $data["authors"] = $model->getAuthors();
        $data["title"] = "Authors list";
        return view("templates/header", $data)
            . view("authors/index")
            . view("templates/footer");
    }

    public function getCreate()
    {
        helper("form"); //for validation_list_error!!!!
        $data['title'] = 'Add new author';
        return view("templates/header", $data)
            . view("authors/create")
            . view("templates/footer");
    }

    public function postCreate()
    {
        helper("form"); //for validation_list_error!!!!
        $model = model(AuthorModel::class);
        $post = $this->request->getPost(["firstname", "surname", "yearOfBirth"]);
        $rules = [
            "firstname" => "required|max_length[128]",
            "surname" => "required|max_length[128]",
            "yearOfBirth" => "required|integer"
        ];
        if (!$this->validateData($post, $rules)) {
            $data['title'] = 'Add new author';
            return view("templates/header", $data)
                . view("authors/create")
                . view("templates/footer");
        }

        $model->save($post);
        $data["title"] = 'New Author added!';
        $data["message"] = 'New Author added!';
        return view("templates/header", $data)
            . view("authors/success")
            . view("templates/footer");
    }

    public function getEdit($id)
    {
        helper("form"); //for validation_list_error!!!!
        $model = model(AuthorModel::class);
        $data['author'] = $model->getAuthors($id);
        $data['title'] = 'Edit Author';
        return view("templates/header", $data)
            . view("authors/edit", $data)
            . view("templates/footer");
    }

    public function postEdit($id)
    {
        helper("form"); //for validation_list_error!!!!
        $model = model(AuthorModel::class);
        $post = $this->request->getPost(["firstname", "surname", "yearOfBirth"]);
        $rules = [
            "firstname" => "required|max_length[128]",
            "surname" => "required|max_length[128]",
            "yearOfBirth" => "required|integer"
        ];

        if (!$this->validateData($post, $rules)) {
            $data['title'] = 'Edit Author';
            $data['author'] = $post;
            return view("templates/header", $data)
                . view("authors/edit", $data)
                . view("templates/footer");
        }

        $model->update($id, $post);
        $data['title'] = 'Author updated!';
        $data['message'] = 'Author updated!';
        return view("templates/header", $data)
            . view("authors/success")
            . view("templates/footer");
    }

    public function getDelete($id){
        $model = model(AuthorModel::class);
        $data['author'] = $model->getAuthors($id);
        $data['title'] = 'Delete author:';
        return view("templates/header", $data)
            . view("authors/delete", $data)
            . view("templates/footer");
    }

    public function postDelete($id){
        $model = model(AuthorModel::class);
        $model->delete($id);
        $data['title'] = 'Author deleted!';
        $data['message'] = 'Author deleted!';

        return view("templates/header", $data)
            . view("authors/success")
            . view("templates/footer");
    }

    public function getView($id){
        $data['id'] = $id;
        $data['title'] = 'INFO by author with id '.$id;
        return view("templates/header", $data)
            . view("authors/view", $data)
            . view("templates/footer");
    }
}

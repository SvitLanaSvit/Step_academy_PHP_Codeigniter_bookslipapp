<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthorModel;
use App\Models\BookModel;
use CodeIgniter\Model;

class Books extends BaseController
{
    public function getIndex()
    {
        //
        $booksModel = Model(BookModel::class);
        $authorsModel = Model(AuthorModel::class);

        $books = $booksModel->getBooks();
        $data['books'] = [];

        foreach ($books as $book) {
            $author = $authorsModel->find($book['authorId']);
            $book['author'] = $author['firstname'] . ' ' . $author['surname'];
            $data['books'][] = $book;
        }

        $data['title'] = 'Books list';
        return view("templates/header", $data)
            . view("books/index")
            . view("templates/footer");
    }

    public function getCreate()
    {
        helper("form"); //for validation_list_error!!!!
        $data['title'] = 'Add new book:';

        $authorsModel = Model(AuthorModel::class);
        $data['authors'] = $authorsModel->getAuthors();

        return view("templates/header", $data)
            . view("books/create", $data)
            . view("templates/footer");
    }

    public function postCreate()
    {
        helper("form");
        $booksModel = Model(BookModel::class);

        $authorsModel = Model(AuthorModel::class);
        $data['authors'] = $authorsModel->getAuthors();

        $post = $this->request->getPost(["titleBook", "price", "authorId", "yearOfPablish"]);
        $rules = [
            "titleBook" => "required|max_length[255]",
            "price" => "required|decimal",
            "authorId" => "required|integer",
            "yearOfPablish" => "required|integer"
        ];

        if (!$this->validateData($post, $rules)) {
            $data['title'] = 'Add new book:';
            return view("templates/header", $data)
                . view("books/create")
                . view("templates/footer");
        }

        $booksModel->save($post);
        $data["title"] = 'New Book added!';
        $data["message"] = 'New Book added!';
        return view("templates/header", $data)
            . view("books/success")
            . view("templates/footer");
    }

    public function getEdit($id){
        helper("form");
        $booksModel = model(BookModel::class);
        $authorsModel = model(AuthorModel::class);

        $data['authors'] = $authorsModel->getAuthors();
        $data['book'] = $booksModel->getBooks($id);

        $data['title'] = 'Edit book';
        return view("templates/header", $data)
            . view("books/edit", $data)
            . view("templates/footer");
    }

    public function postEdit($id){
        helper("form");
        $booksModel = Model(BookModel::class);
        $authorsModel = Model(AuthorModel::class);
        
        $data['authors'] = $authorsModel->getAuthors();

        $post = $this->request->getPost(["titleBook", "price", "authorId", "yearOfPablish"]);
        $rules = [
            "titleBook" => "required|max_length[255]",
            "price" => "required|decimal",
            "authorId" => "required|integer",
            "yearOfPablish" => "required|integer"
        ];

        if (!$this->validateData($post, $rules)) {
            $data['title'] = 'Add new book:';
            return view("templates/header", $data)
                . view("books/edit", $data)
                . view("templates/footer");
        }

        $booksModel->update($id, $post);
        $data['title'] = 'Book updated!';
        $data['message'] = 'Book updated!';
        return view("templates/header", $data)
            . view("books/success")
            . view("templates/footer");
    }

    public function getDelete($id)
    {
        $model = model(BookModel::class);
        $authorModel = model(AuthorModel::class);
        $book = $model->getBooks($id);

        $data['book'] = $book;

        $data['author'] = $authorModel->find($book['authorId']);

        $data['title'] = 'Delete book:';
        return view("templates/header", $data)
            . view("books/delete", $data)
            . view("templates/footer");
    }

    public function postDelete($id)
    {
        $model = model(BookModel::class);
        $model->delete($id);
        $data['title'] = 'Book deleted!';
        $data['message'] = 'Book deleted!';

        return view("templates/header", $data)
            . view("books/success")
            . view("templates/footer");
    }

    public function getView($id){
        $data['id'] = $id;
        $data['title'] = 'INFO by book with id '.$id;

        return view("templates/header", $data)
            . view("books/view", $data)
            . view("templates/footer");
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        //
    }

    public function getRegistration(){
        helper("form");

        // $roleModel = model(RoleModel::class);
        // $roles = $roleModel->getRoles();
        // $data['roles'] = $roles;

        $data['title'] = 'User registration';
        return view("templates/header", $data)
            . view("users/registration", $data)
            . view("templates/footer");
    }

    public function postRegistration(){
        helper("form");
        
        $userModel = model(UserModel::class);

        // $roleModel = model(RoleModel::class);
        // $roles = $roleModel->getRoles();
        // $data['roles'] = $roles;

        $post = $this->request->getPost(['login', 'password', 'email']);
        $rules = [
            "login"=>"required|max_length[255]",
            "password"=>"required|max_length[128]|regex_match[/(?=.*[a-z])(?=.*[A-Z])(?=.*\W).+/]",
            "email"=>"required|max_length[255]"
        ];

        if(!$this->validateData($post, $rules)){
            $data['title'] = 'Registration user:';
            return view("templates/header", $data)
                . view("users/registration")
                . view("templates/footer");
        }

        $hashPassword = $userModel->hashPassword($post['password']);
        $post['password'] = $hashPassword;
        $userModel->save($post);
        $data["title"] = 'User registered!';
        $data["message"] = 'User registered!';
        return view("templates/header", $data)
            . view("users/successregistred")
            . view("templates/footer");
    }

    public function getLogin(){
        helper('form');

        $data['title'] = 'User log in';
        return view("templates/header", $data)
            . view("users/login", $data)
            . view("templates/footer");
    }

    public function postLogin(){
        helper('form');

        $userModel = model(UserModel::class);

        $post = $this->request->getPost(['login', 'password']);
        $rules = [
            "login"=>"required|max_length[255]",
            "password"=>"required|max_length[128]"
        ];

        if(!$this->validateData($post, $rules)){
            $data['title'] = 'Log in:';
            return view("templates/header", $data)
                . view("users/login")
                . view("templates/footer");
        }

        $isCorrect = $userModel->checkLoginPassword($post['login'], $post['password']);

        if($isCorrect){
            $data['title'] = 'Login is succesfull!';
            return view("templates/header", $data)
            . view("users/successlogin")
            . view("templates/footer");
        }
        else{
            $data['title'] = 'Login is not succesfull!';
            return view("templates/header", $data)
            . view("users/notsuccesslogin")
            . view("templates/footer");
        }
    }

    //logout
    public function getLogout(){
        if(isset($_COOKIE['user_login']) && isset($_COOKIE['role'])){
            $login = $_COOKIE['user_login'];
            $role = $_COOKIE['role'];
            
            setcookie('user_login', $login, time() - 60 * 60 * 2, '/');
            setcookie('role', $role, time() - 60 * 60 * 2, '/');
            return redirect()->to('/users/login');
        }
        
        return redirect()->to('/');
    }
}

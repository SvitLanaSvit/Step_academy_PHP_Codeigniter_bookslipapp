<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        h2{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>BOOKS LIBRARY</h2>
        <div class="d-flex" style="justify-content: space-between;">
            <div class="btn-group">
                <a href="/authors" class="btn btn-primary">AUTHORS</a>
                <a href="/books" class="btn btn-secondary">BOOKS</a>
                <?if(!isset($_COOKIE['user_login'])) :?>
                    <a href="/users/registration" class="btn btn-primary">REGISTRATION</a>
                <?endif?>
            </div>
            <div class="btn-group">
                <?if(!isset($_COOKIE['user_login'])):?>
                    <a href="/users/login" class="btn btn-secondary">LOG IN</a>
                <?endif?> 
                <?if(isset($_COOKIE['user_login'])) :?>
                    <a href="/users/logout" class="btn btn-warning" disabled>LOG OUT</a>
                <?endif?>
            </div>
        </div>
    </div>
</body>
</html>
<div class="container">
    <h2 class="alert alert-error">
        <?=session()->getFlashdata('error')?>
    </h2>
    <p class="alert alert-warning">
        <?=validation_list_errors()?>
    </p>
    <form action="/users/registration" method="post">
        <?=csrf_field()?>
        <div class="mb-3">
          <label for="login" class="form-label">Login</label>
          <input type="text" name="login" id="login" class="form-control" placeholder="Enter login..." value="<?=set_value('login')?>">
        </div>
    
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter password..." value="<?=set_value('password')?>">
        </div>
    
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter email..." value="<?=set_value('email')?>">
        </div>
    
        <div class="btn-group">
            <input type="submit" value="Registration" class="btn btn-success">
            <a class="btn btn-secondary" href="/">Back to main menu</a>
        </div>
        
    </form>
</div>
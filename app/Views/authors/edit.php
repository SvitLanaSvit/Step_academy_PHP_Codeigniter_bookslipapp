<div class="container">
    <h2 class="alert alert-error">
        <?=session()->getFlashdata('error')?>
    </h2>
    <p class="alert alert-warning">
        <?=validation_list_errors()?>
    </p>
    <form action="/authors/edit/<?=$author['id']?>" method="post">
        <?=csrf_field()?>
        <div class="mb-3">
          <label for="firstname" class="form-label">Firstname</label>
          <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter firstname..." value="<?=$author['firstname']?>">
        </div>
    
        <div class="mb-3">
          <label for="surname" class="form-label">Surname</label>
          <input type="text" name="surname" id="surname" class="form-control" placeholder="Enter surname..." value="<?=$author['surname']?>">
        </div>
    
        <div class="mb-3">
          <label for="yearofbirth" class="form-label">Year of birth</label>
          <input type="number" name="yearOfBirth" id="yearofbirth" class="form-control" placeholder="Enter year of birth..." value="<?=$author['yearOfBirth']?>">
        </div>
    
        <input type="submit" value="Update" class="btn btn-success">
    </form>
</div>
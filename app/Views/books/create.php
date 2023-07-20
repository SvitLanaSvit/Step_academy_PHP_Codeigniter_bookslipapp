<div class="container">
    <h2 class="alert alert-error">
        <?= session()->getFlashdata('error') ?>
    </h2>
    <p class="alert alert-warning">
        <?= validation_list_errors() ?>
    </p>
    <form action="/books/create" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="titleBook" class="form-label">Title</label>
            <input type="text" name="titleBook" id="titleBook" class="form-control" placeholder="Enter title..." value="<?= set_value('titleBook') ?>">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Enter price..." value="<?= set_value('price') ?>">
        </div>

        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name="authorId">
                <option value=0 selected>Choose author</option>
                <?
                    foreach($authors as $author){
                        $authorId = $author['id'];
                ?>
                        <option value="<?=$authorId?>" ><?=$author['firstname'].' '.$author['surname']?></option>
                <?        
                    }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="yearofpublish" class="form-label">Year of publish</label>
            <input type="number" name="yearOfPablish" id="yearofpublish" class="form-control" placeholder="Enter year of publish..." value="<?= set_value('yearOfPablish') ?>">
        </div>

        <input type="submit" value="Create book" class="btn btn-success">
    </form>
</div>
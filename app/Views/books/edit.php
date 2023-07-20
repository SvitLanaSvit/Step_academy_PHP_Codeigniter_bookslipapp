<div class="container">
    <h2 class="alert alert-error">
        <?= session()->getFlashdata('error') ?>
    </h2>
    <p class="alert alert-warning">
        <?= validation_list_errors() ?>
    </p>
    <form action="/books/edit/<?=$book['id']?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="titleBook" class="form-label">Title</label>
            <input type="text" name="titleBook" id="titleBook" class="form-control" placeholder="Enter title..." value="<?=$book['titleBook']?>">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Enter price..." value="<?=$book['price'] ?>">
        </div>

        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name="authorId">
                <?
                    foreach($authors as $author){
                        $authorId = $author['id'];
                        $selected = ($authorId == $book['authorId']) ? 'selected' : '';
                ?>
                        <option value="<?=$authorId?>" <?=$selected?>><?=$author['firstname'].' '.$author['surname']?></option>
                <?        
                    }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="yearofpublish" class="form-label">Year of publish</label>
            <input type="number" name="yearOfPablish" id="yearofpublish" class="form-control" placeholder="Enter year of publish..." value="<?= $book['yearOfPablish'] ?>">
        </div>

        <div class="btn-group">
            <input type="submit" value="Update book" class="btn btn-success">
            <a href="/books" class="btn btn-secondary">Back to list of books</a>
        </div>
    </form>
</div>
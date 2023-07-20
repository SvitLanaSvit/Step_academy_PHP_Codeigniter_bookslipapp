<div class="container">
    <h2>Confirm delete</h2>
    <h3>Are you sure you want to delete this book?</h3>
    <table class="table table-striped">
        <tr>
            <th>Title</th>
            <td><?=esc($book['titleBook'])?></td>
        </tr>
        <tr>
            <th>Price</th>
            <td><?=esc($book['price'])?></td>
        </tr>
        <tr>
            <th>Author</th>
            <td><?=esc($author['firstname'].' '.$author['surname'])?></td>
        </tr>
        <tr>
            <th>Year of publish</th>
            <td><?=esc($book['yearOfPablish'])?></td>
        </tr>
    </table>
    <div class="btn-group">
        <form action="/books/delete/<?=esc($book['id'])?>" method="post">
            <?=csrf_field()?>
            <input type="submit" value="Delete book" class="btn btn-danger">
        </form>
        <a href="/books" class="btn btn-secondary">Back to list of books</a>
    </div>
</div>
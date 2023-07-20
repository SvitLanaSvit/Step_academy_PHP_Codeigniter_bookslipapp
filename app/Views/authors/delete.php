<div class="container">
    <h2>Confirm delete</h2>
    <h3>Are you sure you want to delete this author?</h3>
    <table class="table table-striped">
        <tr>
            <th>Firstname</th>
            <td><?=esc($author['firstname'])?></td>
        </tr>
        <tr>
            <th>Surname</th>
            <td><?=esc($author['surname'])?></td>
        </tr>
        <tr>
            <th>Date of birth</th>
            <td><?=esc($author['yearOfBirth'])?></td>
        </tr>
    </table>
    <div class="btn-group">
        <form action="/authors/delete/<?=esc($author['id'])?>" method="post">
            <?=csrf_field()?>
            <input type="submit" value="Delete author" class="btn btn-danger">
        </form>
        <a href="/authors" class="btn btn-secondary">Back to list of authors</a>
    </div>
</div>
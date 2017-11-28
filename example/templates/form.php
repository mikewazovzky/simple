<form method="POST" action="/admin/save">

    <input type="hidden" name="id" value="<?php echo $article ? $article->id : null; ?>">

    Title:<br>
    <input class="form-control" type="text" name="title"
        value="<?php echo $article ? $article->title : ''; ?>"
    >
    <br>

    Author:<br>
    <select class="form-control" name="author_id">
        <option value="0"></option>
        <?php foreach($authors as $author) : ?>
            <option value="<?php echo $author->id; ?>"
                <?php echo $author->id == $article->author_id ? 'selected' : ''; ?>>
                <?php echo $author->name; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    Body:<br>
    <textarea class="form-control"  name="body" rows="4"><?php echo $article ? htmlspecialchars_decode($article->body) : ''; ?></textarea>
    <br>
    <input class="btn btn-primary"  type="submit" value="<?php echo $button; ?>">
    <input class="btn btn-danger"  type="reset" value="Cancel">
</form>

<br>

<?php if(isset($errors)):?>
    <?php foreach($errors as $error):?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong>
        <?php echo $error->getMessage(); //->getMessage();?>
    </div>
    <?php endforeach;?>
<?php endif;?>

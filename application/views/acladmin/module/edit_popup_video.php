<h3 class="alert alert-info"><?php echo $title; ?></h3>
<form action="" method="post" enctype="multipart/form-data">
    <?php //print_r($content) ?>
    <table class="table table-striped">
        <tr>
            <td>Contoh: <code>https://www.youtube.com/watch?v=K7NQVbHJPRg</code></td>
            <td></td>
        </tr>
        <tr>
            <td>Video URL</td>
            <td>
                <?php if($article->video_id != ""): ?>
                    <input type="text" name="video_id" value="https://www.youtube.com/watch?v=<?php echo $article->video_id; ?>" class="input input-block-level" />
                <?php else: ?>
                    <input type="text" name="video_id" value="" class="input input-block-level" />
                <?php endif; ?>
                <span class="alert-error"><?php echo form_error('video_id')?></span>
            </td>
        </tr>
        <input type="hidden" name="id_account" value="<?php echo $article->id_account; ?>" />
    </table>

    <table class="table table-striped">
        <tr>
            <td><input type="submit" class="btn btn-large btn-primary" name="submit" value="Update" /></td>
        </tr>
    </table>
</form>
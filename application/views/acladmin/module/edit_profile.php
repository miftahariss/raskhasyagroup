<h3 class="alert alert-info"><?php echo $title; ?></h3>
<form action="" method="post" enctype="multipart/form-data">
    <?php //print_r($content) ?>
    <table class="table table-striped">
        <tr>
            <td>Judul</td>
            <td>
                <input type="text" name="title" value="<?php echo $article->title; ?>" class="input input-block-level" />
                <span class="alert-error"><?php echo form_error('title')?></span>
            </td>
        </tr>
        <tr>
            <td>Isi<font style="color: red;"> *</font></td>
            <td>
                <textarea type="text" name="body"><?php echo $article->body; ?></textarea>
                <span class="alert-error"><?php echo form_error('body')?></span>
            </td>
        </tr>
    </table>

    <table class="table table-striped">
        <tr>
            <td><input type="submit" class="btn btn-large btn-primary" name="submit" value="Update" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript" src="<?php echo base_url();?>asset_admin/assets/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">CKEDITOR.replace ('body', {toolbar : 'Basic'})</script>
<script type="text/javascript">CKEDITOR.replace ('body_en', {toolbar : 'Basic'})</script>
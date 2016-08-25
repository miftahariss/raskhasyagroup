<script type="text/javascript">
var current = 1;
            
function editPhoto() {
    current++;
    var strToAddPhoto = '<tr><td><input type="text" name="title_photo[]" class="input-xlarge" /></td><td><input type="text" name="desc_photo[]" class="input-xlarge" /></td><td><input type="file" name="galleryfile[]" required="required"/></td><td><a onclick="$(this).closest(\'tr\').remove();" class="btn"><span class=\'icon-remove-sign\'></span> Delete</a></td></tr>';

    $('#editPhoto').append(strToAddPhoto);
}
    
</script>
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
            <td>Short Desc</td>
            <td>
                <input type="text" name="short_desc" value="<?php echo $article->short_desc ?>" class="input input-block-level" />
                <span class="alert-error"><?php echo form_error('short_desc')?></span>
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="id_category" required>
                    <option value="">-- Category --</option>
                    <?php
                        $category = $this->acladminmodel->fetchCategory2();
                        foreach($category as $value):
                    ?>
                    <option value="<?php echo $value->id; ?>" <?php if($article->id_category == $value->id) echo "selected"; ?>><?php echo $value->title; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="alert-error"><?php echo form_error('id_category')?></span>
            </td>
        </tr>
        <tr>
            <td>Isi</td>
            <td>
                <textarea type="text" name="body"><?php echo $article->body; ?></textarea>
                <?php /* <span class="alert-error"><?php echo form_error('body')?></span> */ ?>
            </td>
        </tr>
        <tr>
            <td>Foto <code>Maksimal 2MB</code></td>
            <td>
            	<?php if ($article->filename == 0): ?>
            		<span class="label label-important">Foto tidak ditemukan!</span>
            	<?php else: ?>
            		<img src="<?php echo base_url()?>asset_admin/assets/uploads/cover/small/<?php echo $article->filename ?>" /><br />
            	<?php endif; ?>
                <input type="file" name="userfile" /><code>minimum file dimension 200 x 300 pixel</code>
                <span class="alert-error"><?php echo form_error('userfile'); ?></span>
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
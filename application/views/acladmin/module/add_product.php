<script type="text/javascript">
    var current = 1;

    function addPhoto() {
        //current keeps track of how many people we have.
        current++;
        var strToAddPhoto = "<tr><td></td><td><input type=\"text\" name=\"title_photo[]\" class=\"input-xlarge\" /></td><td><input type=\"text\" name=\"desc_photo[]\" class=\"input-xlarge\" /></td><td><input type=\"file\" name=\"galleryfile[]\" required=\"required\"/></td><td><a onclick=\"$(this).closest('tr').remove();\" class=\"btn\"><span class='icon-remove-sign'></span> Delete</a></td></tr>";

        $('#photo').append(strToAddPhoto)
    }

</script>
<h3 class="alert alert-info"><?php echo $title; ?></h3>
<form action="" method="post" name="addArticle" enctype="multipart/form-data">
    <table class="table table-striped">
        <tr>
            <td>Judul</td>
            <td>
                <input type="text" name="title" value="<?php echo set_value('title')?>" class="input input-block-level" required="required" />
                <span class="alert-error"><?php echo form_error('title')?></span>
            </td>
        </tr>
        <tr>
            <td>Short Desc</td>
            <td>
                <input type="text" name="short_desc" value="<?php echo set_value('short_desc')?>" class="input input-block-level" required="required" />
                <span class="alert-error"><?php echo form_error('short_desc')?></span>
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="id_category" required>
                    <option value="">-- Choose Category --</option>
                    <?php
                        $sub = $this->acladminmodel->fetchCategory2();
                        foreach($sub as $value):
                    ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->title; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="alert-error"><?php echo form_error('id_category')?></span>
            </td>
        </tr>
        <tr>
            <td>Isi</td>
            <td>
                <textarea type="text" name="body" required="required"><?php echo set_value('body')?></textarea>
                <?php /* <span class="alert-error"><?php echo form_error('body')?></span> */ ?>
            </td>
        </tr>
        <tr>
            <td>Foto Utama<code>Maksimal 2MB</code></td>
            <td>
                <input type="file" name="userfile" required="required" /><code>minimum file dimension 200 x 300 pixel</code>
                <span class="alert-error"><?php echo form_error('userfile'); ?></span>
            </td>
        </tr>
    </table>
    <table class="table table-striped">
        <tr>
            <td><input type="submit" class="btn btn-large btn-primary" name="submit" value="Save" onclick="javascript:checkInput()"/></td>
        </tr>
        <input type="hidden" name="id_account" />
    </table>
</form>
<script type="text/javascript" src="<?php echo base_url();?>asset_admin/assets/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">CKEDITOR.replace ('body', {toolbar : 'Basic'})</script>
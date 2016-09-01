<h3 class="alert alert-info"><?php echo $title; ?></h3>
<form action="" method="post" enctype="multipart/form-data">
    <?php //print_r($content) ?>
    <table class="table table-striped">
        <tr>
            <td>Alamat<font style="color: red;"> *</font></td>
            <td>
                <textarea type="text" name="alamat" required><?php echo $article->alamat; ?></textarea>
                <span class="alert-error"><?php echo form_error('alamat')?></span>
            </td>
        </tr>
        <tr>
            <td>Email</td>
            <td>
                <input type="text" name="email" value="<?php echo $article->email; ?>" class="input input-block-level" required />
                <span class="alert-error"><?php echo form_error('email')?></span>
            </td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>
                <input type="text" name="telepon" value="<?php echo $article->telepon; ?>" class="input input-block-level" required />
                <span class="alert-error"><?php echo form_error('telepon')?></span>
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
<h3 class="alert alert-info"><?php echo $title; ?></h3>
<form action="" method="post" enctype="multipart/form-data">
    <?php //print_r($content) ?>
    <table class="table table-striped">
    	<tr>
    		<td>Foto <code>Maksimal 2MB</code></td>
            <td>
            	<?php if ($article->filename == 0): ?>
            		<span class="label label-important">Foto tidak ditemukan!</span>
            	<?php else: ?>
            		<img src="<?php echo base_url()?>asset_admin/assets/uploads/cover/small/<?php echo $article->filename ?>" /><br />
            	<?php endif; ?>
                <input type="file" name="userfile" /><code>maximum file dimension 900 x 450 pixel</code>
                <span class="alert-error"><?php echo form_error('userfile'); ?></span>
            </td>
    	</tr>
        <tr>
            <td>Link</td>
            <td>
                <input type="text" name="filename_link" value="<?php echo $article->filename_link; ?>" class="input input-block-level" />
                <span class="alert-error"><?php echo form_error('filename_link')?></span>
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
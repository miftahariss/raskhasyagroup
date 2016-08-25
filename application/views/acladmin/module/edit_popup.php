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
            <td>Video URL</td>
            <td>
                <a href="<?php echo base_url()?>backend/acladmin/edit_popup_video/<?php echo $this->uri->segment(4); ?>">Edit</a>
                <?php if($article->video_id != ""): ?> 
                    | <a href="<?php echo base_url()?>backend/acladmin/delete_popup_video/<?php echo $this->uri->segment(4); ?>">Hapus</a> | <a href="https://youtube.com/watch?v=<?php echo $article->video_id; ?>" target="_blank">View</a>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>Foto <code>Maksimal 2MB</code></td>
            <td>
                <a href="<?php echo base_url()?>backend/acladmin/edit_popup_foto/<?php echo $this->uri->segment(4); ?>">Edit</a>
                <?php if($article->filename != ""): ?> 
                    | <a href="<?php echo base_url()?>backend/acladmin/delete_popup_foto/<?php echo $this->uri->segment(4); ?>">Hapus</a> | <a href="<?php echo base_url(); ?>asset_admin/assets/uploads/cover/original/<?php echo $article->filename; ?>" target="_blank">View</a>
                <?php endif; ?>
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
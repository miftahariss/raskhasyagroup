<section class="baris">
    <div class="container">
        <h3 class="text-center mt30 "><span class="bg-title-putih">Kegiatan</span></h3>
        <div class="line-title"></div>
        <?php if ($kegiatan > 0): ?>
            <div class="row">
                <?php foreach($kegiatan as $data): ?>
                    <div class="col-xs-6">
                        <div class="media mb20">
                            <div class="media-left">
                                <a href="<?php echo base_url().'kegiatan/'.$data->permalink; ?>">
                                  <img class="media-object mr10" width="100" src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/medium/<?php echo $data->filename; ?>" alt="<?php echo $data->title; ?>" >
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="<?php echo base_url().'kegiatan/'.$data->permalink; ?>"><?php echo $data->title; ?></a></h4>
                                <p><?php echo $data->short_desc; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <nav aria-label="Page navigation" class="custom-paging">
                <?php echo $page_links; ?>
            </nav>
        <?php endif; ?>
    </div>
</section> 
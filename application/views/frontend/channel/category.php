<section class="section-produk bg-f7 pt30 pb30">
    <div class="container">
        <h3 class="text-center mt0 "><span class="bg-title-produk"><?php echo $category_id[0]->title; ?></span></h3>
        <div class="line-title"></div>
        <?php if ($product > 0): ?>
            <div class="row">
                <?php foreach($product as $data): ?>
                    <div class="col-xs-2">
                        <div class="list-produk">
                            <a href="<?php echo base_url().'produk/'.$data->permalink; ?>">
                                <div class="img">
                                    <img src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/medium/<?php echo $data->filename; ?>" class="img-responsive" alt="<?php echo $data->title; ?>">
                                </div>
                                <div class="desc p10">
                                    <div class="name">
                                        <p class="mb0"><?php echo $data->title; ?></p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="clearfix"></div>
            </div> <!-- end of row -->

            <nav aria-label="Page navigation" class="custom-paging">
              <?php echo $page_links; ?>
            </nav>
        <?php endif; ?>
    </div> <!-- end of container -->
</section> <!-- end of section-produk -->
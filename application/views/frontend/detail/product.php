<section class="detail_produk">
    <div class="container">
        <h1 class="text-center mt30 fs22"><span class="bg-title-putih"><?php echo $detail[0]->title; ?></span></h1>
        <div class="line-title mb20"></div>
        <div class="row mb30">
            <div class="col-xs-12">
                <div class="detail_produk">
                    <h1 class="fs24 mb20"></h1>
                    <div class="detail_image">
                        <img src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/original/<?php echo $detail[0]->filename; ?>" class="pull-left mr30 mb10" alt="<?php echo $detail[0]->title; ?>" style="max-width:400px;">
                        <div>
                            <?php echo $detail[0]->body; ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
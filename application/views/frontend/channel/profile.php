<section class="section-profile">
    <div class="container">
        <h3 class="text-center mt30 "><span class="bg-title-putih">Profile</span></h3>
        <div class="line-title "></div>
        <div class="row mt30 mb30">
            <div class="col-xs-5">
                <img src="<?php echo base_url(); ?>assets/img/produk1.jpg" class="img-responsive" alt="">
            </div>
            <div class="col-xs-7">
                <div class="profile-detail">
                    <h3 class="mt0 judul-compo-banner"><?php echo $profile[0]->title ?></h3>
                    <?php echo $profile[0]->body ?>
                </div>
            </div>
        </div>
    </div> <!-- end of container -->
</section> <!-- end of section-profile -->
<section class="section-banner relative">
    <div class="compo-banner">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <img src="<?php echo base_url(); ?>assets/img/Logo-Raskhasya.png" alt="" class="logo-banner img-responsive">
                    <div class="bg-tipis kontak-banner">
                        <p>Jalan Jenderal Sudirman Timur No.65 Jakarta Selatan</p>
                        <p>Email: raskhasyagroup@gmail.com</p>
                        <p>Telepon: 0812 1975 0000</p>
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="bg-tipis mt20 compo-text">

                        <h3 class="mt0 judul-compo-banner">Raskhasya Group</h3>
                        <p class="mb10">Merupakan sebuah group yg terdiri dari para Arsitek, Ahli Sipil, Konsultan Perencana dan Konsultan Pengawas, Owner dari pemilik alat berat, Pemilik alat pendukung pekerjaan Konstruksi, Pemilik Precast, Pemilik Paving Block, Pemilik AMP Aspalt, Supplier Besar Readymix, Material Bangunan dan para tukang yang sudah profesional.</p>

                        <p class="mb10">Group ini bergabung dengan tujuan untuk mempermudah pekerjaan kami, mempermudah pekerjaan pemerintah dan mempermudah pekerjaan para klien kami.</p>

                        <p class="mb10">Bergabungnya kami dalam satu group akan memberikan dampak luar biasa pada kwalitas pekerjaan yang dipercayakan kepada kami. Dan dengan biaya yang lebih baik bagi semua rekanan kami.</p>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class="swiper-container slider-banner">
        <div class="swiper-wrapper">
            <?php if(isset($slider) && $slider != FALSE): ?>
                <?php foreach($slider as $data): ?>
                    <div class="swiper-slide">
                        <img class="img-responsive" src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/original/<?php echo $data->filename; ?>" alt="<?php echo $data->title; ?>">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</section>

<section class="section-produk bg-f7 pt30 pb30">
    <div class="container">
        <h3 class="text-center mt0 "><span class="bg-title-produk">Produk Kami</span></h3>
        <div class="line-title"></div>
        <div class="row">
            <?php if(isset($category) && $category != FALSE): ?>
                <?php foreach($category as $data): ?>
                    <div class="col-xs-2">
                        <div class="list-produk">
                            <a href="<?php echo base_url().'category/'.$data->permalink; ?>">
                                <div class="img">
                                    <img src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/medium/<?php echo $data->filename; ?>" class="img-responsive" alt="">
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
            <?php endif; ?>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</section> <!-- end of section-produk -->


<section class="baris">
    <div class="container">
        <h3 class="text-center mt30 "><span class="bg-title-putih">Kegiatan</span></h3>
        <div class="line-title"></div>
        <div class="row">
            <div class="col-xs-6">
                <?php if(isset($kegiatan) && $kegiatan != FALSE): ?>
                    <?php foreach($kegiatan as $data): ?>
                        <div class="media mb20">
                            <div class="media-left">
                                <a href="<?php echo base_url().'kegiatan/'.$data->permalink; ?>">
                                  <img class="media-object mr10" width="100" src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/medium/<?php echo $data->filename; ?>" alt="<?php echo $data->title; ?>" >
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="<?php echo base_url().'kegiatan/'.$data->permalink; ?>"><?php echo $data->title; ?></a></h4>
                                <p><?php echo $data->short_desc; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="text-center mb30">
            <a href="<?php echo base_url(); ?>kegiatan" class="btn btn-primary">Lihat Semua Kegiatan</a>
        </div>
    </div>
</section>


<section class="section-customer pt30 pb30">
    <div class="container">
        <h3 class="text-center mt0 "><span class="bg-title-customer">Mitra</span></h3>
        <div class="line-title line-title-customer"></div>
        <div class="row">
            <?php if(isset($mitra) && $mitra != FALSE): ?>
                <?php foreach($mitra as $data): ?>
                    <div class="col-xs-2">
                        <div class="list-customer">
                            <div class="img">
                                <img src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/medium/<?php echo $data->filename; ?>" alt="<?php echo $data->title; ?>" class="img-responsive">
                            </div>
                            <div class="name-customer">
                                <?php echo $data->title; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
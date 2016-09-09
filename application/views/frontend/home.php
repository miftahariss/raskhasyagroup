<section class="section-banner relative">
    <div class="swiper-container slider-banner">
        <div class="swiper-wrapper">
            <?php if(isset($slider) && $slider != FALSE): ?>
                <?php foreach($slider as $data): ?>
                    <div class="swiper-slide">
                        <a href="<?php echo $data->link; ?>" target="_blank">
                            <div class="compo-banner">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <img src="<?php echo base_url(); ?>assets/img/Logo-Raskhasya.png" alt="" class="logo-banner img-responsive">
                                            <div class="bg-tipis kontak-banner">
                                                <p><?php echo $contact[0]->alamat; ?></p>
                                                <p><?php echo $contact[0]->email; ?></p>
                                                <p>Telepon: <?php echo $contact[0]->telepon; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="bg-tipis mt20 compo-text">

                                                <h3 class="mt0 judul-compo-banner"><?php echo $profile[0]->title ?></h3>
                                                <?php echo $profile[0]->body ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <img class="img-responsive img-slider" src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/original/<?php echo $data->filename; ?>" alt="<?php echo $data->title; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</section>

<section class="section-produk bg-f7 pt10 pb20">
    <div class="container">
        <h3 class="text-center mt0 mb0"><span class="bg-title-produk">Produk Kami</span></h3>
        <div class="line-title"></div>
        <div class="row">
            <h3 class="fs18 ml15 mt0 mb10 subtitle-home">ARSITEKTUR</h3>
            <?php if(isset($content_arsitektur) && $content_arsitektur != FALSE): ?>
                <?php foreach($content_arsitektur as $data): ?>
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
            <div class="clearfix"></div>

            <h3 class="fs18 ml15 mt0 mb10 subtitle-home">SIPIL</h3>
            <?php if(isset($content_sipil) && $content_sipil != FALSE): ?>
                <?php foreach($content_sipil as $data): ?>
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
            <div class="clearfix"></div>

            <h3 class="fs18 ml15 mt0 mb10 subtitle-home">ALAT BERAT & PENDUKUNG</h3>
            <?php if(isset($content_alatberat) && $content_alatberat != FALSE): ?>
                <?php foreach($content_alatberat as $data): ?>
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
            <div class="clearfix"></div>

            <h3 class="fs18 ml15 mt0 mb10 subtitle-home">MATERIAL</h3>
            <?php if(isset($content_material) && $content_material != FALSE): ?>
                <?php foreach($content_material as $data): ?>
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
            <div class="clearfix"></div>

            <h3 class="fs18 ml15 mt0 mb10 subtitle-home">PRECAST</h3>
            <?php if(isset($content_precast) && $content_precast != FALSE): ?>
                <?php foreach($content_precast as $data): ?>
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
            <div class="clearfix"></div>

            <h3 class="fs18 ml15 mt0 mb10 subtitle-home">TEKNOLOGI</h3>
            <?php if(isset($content_teknologi) && $content_teknologi != FALSE): ?>
                <?php foreach($content_teknologi as $data): ?>
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
        <div class="line-title line-title-kegiatan"></div>
        <div class="row mt40">
            <?php if(isset($kegiatan) && $kegiatan != FALSE): ?>
                <?php foreach($kegiatan as $data): ?>
                    <div class="col-xs-6">
                        <div class="media mb20 list-kegiatan">
                            <div class="media-left">
                                <a href="<?php echo base_url().'kegiatan/'.$data->permalink; ?>">
                                  <img class="media-object mr10" width="100" src="<?php echo base_url() ?>asset_admin/assets/uploads/cover/medium/<?php echo $data->filename; ?>" alt="<?php echo $data->title; ?>" >
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="<?php echo base_url().'kegiatan/'.$data->permalink; ?>"><?php echo $data->title; ?></a></h4>
                                <p><?php echo substr($data->short_desc, 0, 184) . '...'; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="text-center mb30">
            <a href="<?php echo base_url(); ?>kegiatan" class="btn btn-primary">Lihat Semua Kegiatan</a>
        </div>
    </div>
</section>


<section class="section-customer pt20 pb20">
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
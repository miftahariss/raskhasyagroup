<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="container-navbar">
                <ul class="nav navbar-nav">
                    <li class="first-child active"><a href="<?php echo base_url(); ?>">HOME </a></li>
                    <li><a href="<?php echo base_url(); ?>profile">PROFILE</a></li>

                    <?php if(isset($category) && $category != FALSE): ?>
                        <?php foreach($category as $data): ?>
                            <?php $product = $this->m_frontend->getProduct($data->id); ?>
                            <?php if(isset($product) && $product != FALSE): ?>
                                <li class="dropdown">
                                    <a href="<?php echo base_url().'category/'.$data->permalink; ?>"><?php echo $data->title; ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <?php foreach($product as $value): ?>
                                            <li><a href="<?php echo base_url().'produk/'.$value->permalink; ?>"><?php echo $value->title; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li><a href="<?php echo base_url().'category/'.$data->permalink; ?>"><?php echo $data->title; ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <li><a href="<?php echo base_url(); ?>hubungi-kami">HUBUNGI KAMI</a></li>
                </ul>
            </div> <!-- end of container-navbar -->
        </div><!-- /.navbar-collapse -->
         <!-- <div class="left-nav">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="false"></span>
        </div>
        <div class="right-nav">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="false"></span>
        </div> -->
    </div><!-- /.container-fluid -->
</nav>
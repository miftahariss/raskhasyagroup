<div class="container">
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <a href="#" class="brand"><strong>CMS</strong></a>
            <ul class="nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class=" icon-home"></span> Home</a>
                    <ul class="dropdown-menu">
                        <!-- <li><a href="<?php echo base_url()?>backend/acladmin/add_article"><span class="icon-plus-sign"></span> Add Article</a></li> -->
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_slider"><span class="icon-list"></span> View Slider</a></li>
                        <!-- <li><a href="<?php echo base_url()?>backend/acladmin/view_archive_slider"><span class="icon-list"></span> View Archive Slider</a></li> -->
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/add_menu"><span class="icon-plus-sign"></span> Add Menu</a></li>
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_menu"><span class="icon-list"></span> View Menu</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/add_category"><span class="icon-plus-sign"></span> Add Category</a></li>
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_category"><span class="icon-list"></span> View Category</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Product <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/add_product"><span class="icon-plus-sign"></span> Add Product</a></li>
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_product"><span class="icon-list"></span> View Product</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kegiatan <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/add_kegiatan"><span class="icon-plus-sign"></span> Add Kegiatan</a></li>
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_kegiatan"><span class="icon-list"></span> View Kegiatan</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mitra <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/add_mitra"><span class="icon-plus-sign"></span> Add Mitra</a></li>
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_mitra"><span class="icon-list"></span> View Mitra</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_profile"><span class="icon-list"></span> View Profile</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contact <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_contact"><span class="icon-list"></span> View Contact</a></li>
                    </ul>
                </li>

                <!-- Only Administrator -->
                <?php if( $this->session->userdata('role') == 1 ): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/add_user"><span class="icon-plus-sign"></span> Add New User</a></li>
                        <li><a href="<?php echo base_url()?>backend/acladmin/view_user"><span class="icon-list"></span> View User</a></li>
                        <!--<li><a href="<?php echo base_url()?>backend/acladmin/archive_user"><span class="icon-trash"></span> Archive User</a></li>-->
                    </ul>
                </li>
                <?php endif ?>
                <!-- Only Administrator -->

            </ul>
<!--            <ul class="pull-right nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$this->session->userdata('name')?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url()?>backend/acladmin/edit_password"><span class="icon-edit"></span> Edit Password</a></li>
                        <li><a href="<?php echo base_url()?>backend/cmsauth/logout"><span class="icon-lock"></span> Logout</a></li>
                    </ul>
                </li>
            </ul>-->
<!--            <form class="navbar-search pull-right">-->
<!--                <input type="text" class="input-block-level search-query" placeholder="Search...">-->
<!--            </form>-->
        </div>
    </div><!-- end navbar-->
</div>
<section class="section-profile">
    <div class="container">
        <h3 class="text-center mt30 "><span class="bg-title-putih">Hubungi Kami</span></h3>
        <div class="line-title "></div>
        <div class="row mt30 mb30">
            <?php if($this->session->flashdata('success')): ?>
              <h4>
                <center>
                  <font style="color: blue;"><?php echo $this->session->flashdata('success') ?></font>
                </center>
              </h4>
            <?php endif; ?>
            <div class="col-xs-6">
                <p class="mb5"><span class="glyphicon mr10 glyphicon-map-marker"></span><?php echo $contact[0]->alamat; ?></p>
                <p class="mb5"><span class="glyphicon mr10 glyphicon-envelope"></span><?php echo $contact[0]->email; ?></p>
                <p class="mb20"><span class="glyphicon mr10 glyphicon-phone-alt"></span> Telepon: <?php echo $contact[0]->telepon; ?></p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4637418468137!2d106.82127134973466!3d-6.2023912954879075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f41f488e7521%3A0xe9b64eeefaf0be0c!2sStasiun+Sudirman%2C+Jl.+Jend.+Sudirman%2C+Kb.+Melati%2C+Kota+PusatTanahabang%2C%2C+Menteng%2C+Tanah+Abang%2C+Kota+Jakarta+Pusat%2C+Daerah+Khusus+Ibukota+Jakarta!5e0!3m2!1sen!2sid!4v1472234429200" width="500" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-xs-6">
                <div class="form-kontak">
                    <form method="POST">
                      <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" id="" placeholder="nama" name="nama" required>
                        <?php echo form_error('nama'); ?>
                      </div>
                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" id="" placeholder="Email" name="email" required>
                        <?php echo form_error('email'); ?>
                      </div>
                      <div class="form-group">
                        <label for="">Pesan</label>
                        <textarea class="form-control" id="" rows="5" name="pesan" required></textarea>
                        <?php echo form_error('pesan'); ?>
                      </div>
                      
                      <button type="submit" name="submit" value="submit" class="btn btn-danger">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end of container -->
</section> <!-- end of section-profile -->
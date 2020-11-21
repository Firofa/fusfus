        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="col-lg-8">
              
          <p>Silahkan Isi dan Kirim Keluhan Anda melalui form dibawah ini</p>      
        <?= form_open_multipart('fusfus/kirimkeluhan/'); ?>

          <div class="form-group">
          <label for="kode_produk" class="col-sm-2 col-form-label">Isi Keluhan</label>
          <div class="col-sm-10">
          <input type="textarea" class="form-control" id="keluhan" name="keluhan" placeholder="Masukan Keluhan Anda Disini">
          <?= form_error('keluhan','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>
          


        <div class="form-group row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Kirim Keluhan</button>
          </div>
        </div>
                        




              </form>


            </div>
          </div>

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
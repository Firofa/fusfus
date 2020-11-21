        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="col-lg-8">
              
                
        <?= form_open_multipart('admin/editkategori/'.$id); ?>
        <div class="form-group">
          <label for="id_produk" class="col-sm-2 col-form-label">Id</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="id" name="id" value="<?= $id; ?>" READONLY>
            <?= form_error('id','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div> 
          <div class="form-group">
          <label for="kode_produk" class="col-sm-2 col-form-label">Kategori</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id="category" name="category" value="<?= $category;  ?>">
          <?= form_error('category','<small class="text-danger pl-3">', '</small>');    ?>
          </div>
          </div>

          <div class="form-group">
          <select name="jenis_category" id="jenis_category" class="form-control">
            <option value="<?= $jenis_category; ?>" readonly>Kategori Saat Ini: <?= $jenis_category; ?></option>
            <option value="jualan">Jualan</option>
            <option value="penukaran">Penukaran</option>
            <option value="sampah">Sampah</option>
          </select>
        </div>
          


        <div class="form-group row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
        </div>
                        




              </form>


            </div>
          </div>

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="col-lg-8">
                
        <?= form_open_multipart('admin/editDataSampah/'.$barang_sampah['kode_barang_sampah']); ?>
        <div class="form-group">
      <label for="opsi_penukaran">Opsi Penukaran</label>
      <input type="text" class="form-control" id="opsi_penukaran" value="<?= $barang_sampah['opsi_penukaran']; ?>" name="opsi_penukaran" placeholder="Masukan Opsi Penukaran">
        </div>
        <div class="form-group">
          <select name="id_category" id="id_category" class="form-control">
            <option value="<?= $barang_sampah['id_category']; ?>">Kategori Saat Ini : <?= $barang_sampah['category']; ?></option>
            <?php foreach ($category as $ctg) :?>
            <option value="<?= $ctg['id']; ?>"><?= $ctg['category']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
      <label for="image">Masukan Gambar Produk :</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>


        <div class="form-group">
          <label for="saldo_tambah">Saldo Tambah :</label>
          <input type="text" class="form-control" id="saldo_tambah" name="saldo_tambah" value="<?= $barang_sampah['saldo_tambah']; ?>" placeholder="Masukan Saldo yang didapat setelah penukaran">
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan :</label>
          <input type="textarea" class="form-control" id="keterangan" name="keterangan" value="<?= $barang_sampah['keterangan']; ?>" placeholder="Masukan Keterangan">
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

      
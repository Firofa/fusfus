        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="col-lg-8">
                
        <?= form_open_multipart('admin/editJualan/'.$barang_jualan['kode_barang_jualan']); ?>
        <div class="form-group">
      <label for="nama_produk">Nama Produk :</label>
      <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $barang_jualan['nama_produk']; ?>" placeholder="Nama Produk">
        </div>
        <div class="form-group">
          <select name="id_category" id="id_category" class="form-control">
            <option value="<?= $barang_jualan['id_category']; ?>">Kategori Saat Ini : <?= $barang_jualan['category']; ?></option>
            <?php foreach ($category as $ctg) : ?>
            <option value="<?= $ctg['id']; ?>"><?= $ctg['category']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
           <label for="stok">Stok Produk :</label>
      <input type="text" class="form-control" id="stok" name="stok" value="<?= $barang_jualan['stok']; ?>"  placeholder="Masukan Stok">
        </div>

        <div class="form-group">
      <label for="image">Masukan Gambar Produk :</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>


        <div class="form-group">
      <label for="harga">Masukan Harga Produk :</label>
      <input type="text" class="form-control" id="harga" name="harga" value="<?= $barang_jualan['harga'] ?>" placeholder="Masukan Harga">
        </div>
        <div class="form-group">
          <label for="harga">Masukan Keterangan Produk :</label>
      <input type="textarea" class="form-control" id="keterangan" name="keterangan" value="<?= $barang_jualan['keterangan']; ?>"  placeholder="Masukan Keterangan">
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

      
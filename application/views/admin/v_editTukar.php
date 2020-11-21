        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <?= form_open_multipart('admin/editbarangtukar/'.$barang_tukar['kode_barang_tukar']); ?>
        <div class="form-group">
      <label for="nama_produk">Nama Barang</label>
      <input type="text" class="form-control" value="<?= $barang_tukar['nama_produk']; ?>"  id="nama_produk" name="nama_produk" placeholder="Nama Produk">
        </div>
        <div class="form-group">
          <select name="id_category" id="id_category" class="form-control">
            <option value="<?= $barang_tukar['id_category']; ?>">Kategori Saat Ini : <?= $barang_tukar['category']; ?></option>
            <?php foreach ($category as $ctg) :?>
            <option value="<?= $ctg['id']; ?>"><?= $ctg['category']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="stok">Stok Barang :</label>
          <input type="text" class="form-control" value="<?= $barang_tukar['stok']; ?>"  id="stok" name="stok" placeholder="Masukan Stok">
        </div>

        <div class="form-group">
      <label for="image">Masukan Gambar Produk :</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>


        <div class="form-group">
          <label for="harga_saldo">Harga Saldo :</label>
          <input type="text" class="form-control" id="harga_saldo" value="<?= $barang_tukar['harga_saldo']; ?>"   name="harga_saldo" placeholder="Masukan Harga Saldo Penukaran">
        </div>

        <div class="form-group">
          <label for="harga_uang">Harga Uang :</label>
          <input type="text" class="form-control" value="<?= $barang_tukar['harga_uang']; ?>" id="harga_uang" name="harga_uang" placeholder="Masukan Harga Uang (jika tukar uang)">
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan :</label>
          <input type="textarea" class="form-control" value="<?= $barang_tukar['keterangan']; ?>" id="keterangan" name="keterangan" placeholder="Masukan Keterangan">
        </div>

        <div class="form-group row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Edit</button>
          </div>
        </div>
        </form>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
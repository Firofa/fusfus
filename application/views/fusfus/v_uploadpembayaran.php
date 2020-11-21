        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="col-lg-8">
                
      <?= form_open_multipart('fusfus/douploadPembayaran/'.$pesan['id_pesan']); ?>
      <div class="form-group">
      <label for="nama_produk">Nama Barang Pesan</label>
        <input type="text" class="form-control" id="nama_produk" value="<?= $pesan['nama_produk']; ?>" name="nama_produk" placeholder="Masukan Opsi Penukaran" readonly>
      </div>

      <div class="form-group">
      <label for="tanggal_pesan">Tanggal Pemesanan</label>
      <input type="text" class="form-control" id="tanggal_pesan" value="<?= date('d-M-Y',$pesan['tanggal_pesan']); ?>" name="tanggal_pesan" placeholder="Masukan Opsi Penukaran" readonly>
      </div>

      <div class="form-group">
      <label for="jumlah_pesan">Jumlah Pesan</label>
      <input type="text" class="form-control" id="jumlah_pesan" value="<?= $pesan['jumlah_pesan']; ?>" name="jumlah_pesan" placeholder="Masukan Opsi Penukaran" readonly>
      </div>

      <div class="form-group">
      <label for="total">Total</label>
      <input type="text" class="form-control" id="total" value="<?= $pesan['total']; ?>" name="total" placeholder="Masukan Opsi Penukaran" readonly>
      </div>

      <div class="form-group">
        <label for="image">Upload Bukti Pembayaran :</label>
        <input type="file" class="form-control" id="image" name="image">
      </div>


        <div class="form-group row justify-content-end">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </div>
                        




              </form>


            </div>
          </div>

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
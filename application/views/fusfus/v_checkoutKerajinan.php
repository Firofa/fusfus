

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Form Pesan Kerajinan</h2>
              <p>Isi Form dibawah untuk memesan kerajinan rumah inspirasi</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Checkout Area =================-->
    <?= $this->session->flashdata('message');  ?>
    <section class="checkout_area section_gap">
      <div class="container">
        <div class="billing_details">
          <div class="row">
            <div class="col-lg-8">
              <h3>Detail Pemesanan Kerajinan</h3>
              <?= form_open_multipart('fusfus/doPesanKerajinan'); ?>
                <div class="col-md-6 form-group">
                  <label for="kode_barang_pesan">Kode Produk :</label>
                  <input type="text" class="form-control" id="kode_barang_pesan" value="<?= $inputData['kode_barang_pesan']; ?>" name="kode_barang_pesan" readonly/>
                </div>
                <div class="col-md-12 form-group">
                  <label for="nama_produk">Nama Produk :</label>
                  <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $data['detail_produk']['nama_produk'] ?>" disabled readonly />
                </div>
                <div class="col-md-12 form-group">
                  <label for="jumlah_pesan">Jumlah Pesan :</label>
                  <input type="number" class="form-control" id="jumlah_pesan" name="jumlah_pesan" placeholder="Masukan Jumlah Pesan" required />
                </div>
                <div class="col-md-12 form-group">
                  <label for="image">Upload Bukti Pembayaran :</label>
                 <input type="file" class="form-control" id="image" name="image" />
                </div>
                <div class="col-md-12 form-group">
                  <input type="number" hidden class="form-control" id="harga" name="harga" value="<?= $data['detail_produk']['harga']; ?>" readonly/>
                </div>
                
              
                <button class="main_btn" type="Submit">Check Out</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
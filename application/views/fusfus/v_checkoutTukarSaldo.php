

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Form Penukaran Saldo</h2>
              <p>Klik Check Out jika anda sudah yakin ingin menukarkan saldo</p>
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
              <h3>Detail Penukaran Saldo</h3>
              <?= form_open_multipart('fusfus/doTukarSaldo'); ?>
                <div class="col-md-6 form-group">
                  <label for="id_barang_tukar">Kode Tukar Saldo :</label>
                  <input type="text" class="form-control" id="id_barang_tukar" value="<?= $inputData['id_barang_tukar']; ?>" name="id_barang_tukar" readonly/>
                </div>
                <div class="col-md-12 form-group">
                  <label for="nama_produk">Nama Produk :</label>
                  <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $data['detail_produk']['nama_produk'] ?>" disabled readonly />
                </div>
                <div class="col-md-12 form-group">
                  <label for="harga_saldo">Saldo yang akan ditukar :</label>
                  <input type="number" class="form-control" id="harga_saldo" name="harga_saldo" value="<?= $data['detail_produk']['harga_saldo']; ?>" readonly/>
                </div>
                
              
                <button class="main_btn" type="Submit">Check Out</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
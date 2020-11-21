

    <!--================Home Banner Area =================-->
    <section class="banner_area">
      <div class="banner_inner d-flex align-items-center">
        <div class="container">
          <div
            class="banner_content d-md-flex justify-content-between align-items-center"
          >
            <div class="mb-3 mb-md-0">
              <h2>Form Penambahan Saldo</h2>
              <p>Klik Check Out jika anda sudah yakin ingin menambah saldo</p>
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
              <?= form_open_multipart('fusfus/doTambahSaldoSampah'); ?>
                <div class="col-md-6 form-group">
                  <label for="id_barang_sampah">Kode Tambah Saldo :</label>
                  <input type="text" class="form-control" id="id_barang_sampah" value="<?= $inputData['id_barang_sampah']; ?>" name="id_barang_sampah" readonly/>
                </div>
                <div class="col-md-12 form-group">
                  <label for="nama_produk">Opsi Penukaran :</label>
                  <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $data['detail_produk']['opsi_penukaran'] ?>" disabled readonly />
                </div>
                <div class="col-md-12 form-group">
                  <label for="saldo_tambah">Saldo yang akan diterima :</label>
                  <input type="number" class="form-control" id="saldo_tambah" name="saldo_tambah" value="<?= $data['detail_produk']['saldo_tambah']; ?>" readonly/>
                </div>
                
              
                <button class="main_btn" type="Submit">Check Out</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Checkout Area =================-->
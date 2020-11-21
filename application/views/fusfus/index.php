

  <!--================Home Banner Area =================-->
  <section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
      <div class="container">
        <div class="banner_content row">
          <div class="col-lg-12">
            <p class="sub text-uppercase">Hello, <?= $nama; ?></p>
            <h3><span>Jelajahi</span> dan <br />Support <span>Fusfus</span></h3>
            <h4>Program Rumah Inspirasi From Us For Us </h4>
            <a class="main_btn mt-40" href="#jelajahi">Lihat Lebih Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

  <!-- Start feature Area -->
  <section id="jelajahi" class="feature-area section_gap_bottom_custom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#kerajinan" class="title">
              <i class="flaticon-money"></i>
              <h3>Beli Kerajinan Sampah</h3>
            </a>
            <p>Beli Produk Kerjinan Sampah Rumah Inspirasi.</p>
          </div>    
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="<?= base_url('fusfus/statusPemesanan'); ?>" class="title">
              <i class="flaticon-truck"></i>
              <h3>Cek Pembelian Kerajinan</h3>
            </a>
            <p>Cek Apakah produk anda masih diproses atau sudah dikirim.</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="#opsitukarsampah" class="title">
              <i class="flaticon-money"></i>
              <h3>Tambah Saldo Sampah</h3>
            </a>
            <p>Tukar Sampah Jadi Saldo Sampah Untuk Membeli Produk Barter</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="single-feature">
            <a href="<?= base_url('fusfus/statusPenukaran'); ?>" class="title">
              <i class="flaticon-truck"></i>
              <h3>Cek Status Penukaran</h3>
            </a>
            <p>Cek status barang hasil tukar saldo anda masih diproses / siap ambil.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End feature Area -->

  <!--================ Feature Product Area =================-->
  <section id="kerajinan" class="feature_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <?= $this->session->flashdata('message');  ?>
            <h2><span>Produk Rumah Inspirasi</span></h2>
            <p>Produk - produk kerajinan rumah inspirasi kami</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php foreach ($produkKerajinan as $kerajinan): ?>
        <div class="col-lg-4 col-md-6">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" style="width: 348px; height: 425px;" src="<?= base_url('assets/img/product/').$kerajinan['image'] ?>" alt="" />
              <div class="p_icon">
                <a href="<?= base_url('fusfus/detailProduct/').$kerajinan['kode_barang_jualan']; ?>">
                  <i class="ti-eye"></i>
                </a>
                <a href="<?= base_url('fusfus/pesanKerajinan/').$kerajinan['kode_barang_jualan']; ?>">
                  <i class="ti-shopping-cart"></i>
                </a>
                <a href="<?= base_url('fusfus/likeproductjual/').$kerajinan['kode_barang_jualan']; ?>">
                  <i class="ti-heart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="#" class="d-block">
                <h4><?= $kerajinan['nama_produk']; ?></h4>
                <h6>Stok Produk: <?= $kerajinan['stok']; ?></h6>
                <h6>Produk Disukai: <?= $kerajinan['product_like']; ?> Kali</h6>
              </a>
              <div class="mt-3">
                <span class="mr-4">Rp. <?= number_format($kerajinan['harga']); ?></span>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
    </div>
  </section>
  <!--================ End Feature Product Area =================-->

  <!--================ Offer Area =================-->
  <section class="offer_area">
    <div class="container">
      <div class="row justify-content-center">
        <div class="offset-lg-4 col-lg-6 text-center">
          <div class="offer_content">
            <h3 class="text-uppercase mb-40">Cek Juga Barang - barang lain</h3>
            <h2 class="text-uppercase"><small><b>Bisa tukar saldo sampah</b></small></h2>
            <a href="#barangtukarsampah" class="main_btn mb-20 mt-5">Jelajahi Sekarang</a>
            <p>**Penukaran dengan saldo sampah hanya berlaku bagi member</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================ End Offer Area =================-->

  <!--================ New Product Area =================-->
  <section id="barangtukarsampah" class="new_product_area section_gap_top section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Barang Bisa Tukar Saldo Sampah</span></h2>
            <p>Sudah Jadi Anggota? Tukar Saldo Sampahmu dengan barang - barang berikut</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php foreach ($produkTukar as $tukar): ?>
        <div class="col-lg-4 col-md-6">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" style="width: 348px; height: 425px;" src="<?= base_url('assets/img/product/').$tukar['image'] ?>" alt="" />
              <div class="p_icon">
                <a  href="<?= base_url('fusfus/tukarsaldosampah/').$tukar['kode_barang_tukar']; ?>">
                  <i class="ti-shopping-cart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="#" class="d-block">
                <h4><?= $tukar['nama_produk']; ?></h4>
                <h6>Stok Produk: <?= $tukar['stok']; ?></h6>
              </a>
              <div class="mt-3">
                <span class="mr-4">Harga Poin : <?= number_format($tukar['harga_saldo']); ?></span>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
    </div>

      
  </section>
  <!--================ End New Product Area =================-->

  <!--================ Inspired Product Area =================-->
  <section id="opsitukarsampah" class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="main_title">
            <h2><span>Opsi Penukaran Sampah</span></h2>
            <p>Ubah Sampahmu jadi Saldo Sampah</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php foreach ($opsiTambahSaldo as $tambah): ?>
          
        <div class="col-lg-3 col-md-6">
          <div class="single-product">
            <div class="product-img">
              <img class="img-fluid w-100" style="width: 256px; height:258px;" src="<?= base_url('assets/img/product/').$tambah['image'] ?>" alt="" />
              <div class="p_icon">
                <a href="<?= base_url('fusfus/tambahsaldosampah/').$tambah['kode_barang_sampah']; ?>">
                  <i class="ti-shopping-cart"></i>
                </a>
              </div>
            </div>
            <div class="product-btm">
              <a href="#" class="d-block">
                <h4><?= $tambah['opsi_penukaran']; ?></h4>
              </a>
              <div class="mt-3">
                <span class="mr-4">Tambah Saldo: <?= $tambah['saldo_tambah']; ?></span>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>

        
    </div>
  </section>
  <!--================ End Inspired Product Area =================-->


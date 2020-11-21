    <!--================Single Product Area =================-->
    <div class="product_image_area">
      <div class="container">
        <div class="row s_product_inner">
          <div class="col-lg-6">
            <div class="s_product_img">
              <div
                id="carouselExampleIndicators"
                class="carousel slide"
                data-ride="carousel"
              >
                
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      class="d-block w-100"
                      src="<?= base_url('assets/img/product/').$barang['image'] ?>"
                      alt="First slide"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      class="d-block w-100"
                      src="<?= base_url('assets/img/product/').$barang['image'] ?>"
                      alt="Second slide"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      class="d-block w-100"
                      src="<?= base_url('assets/img/product/').$barang['image'] ?>"
                      alt="Third slide"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 offset-lg-1">
            <div class="s_product_text">
              <h3><?= $barang['nama_produk'] ?></h3>
              <h2>Rp <?= number_format($barang['harga']); ?></h2>
              <ul class="list">
                <li>
                    <span>Category</span> : <?= $barang['category']; ?>

                </li>
                <li>
                    <span>Disukai</span> : <?= $barang['product_like']; ?> Kali
                </li>
                <li>
                  <a href="#"> <span>Availibility</span> : <?= $barang['stok']; ?></a>
                </li>
              </ul>
              <p>
                <?= $barang['keterangan']; ?>
              </p>
              <div class="card_area">
                <a class="main_btn" href="<?= base_url('fusfus/pesanKerajinan/').$barang['kode_barang_jualan']; ?>">Add to Cart</a>
                <a class="icon_btn" href="href=<?= base_url('fusfus/likeproductjual/').$barang['kode_barang_jualan']; ?>">
                  <i class="lnr lnr lnr-heart"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
      <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a
              class="nav-link"
              id="home-tab"
              data-toggle="tab"
              href="#home"
              role="tab"
              aria-controls="home"
              aria-selected="true"
              >Description</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="profile-tab"
              data-toggle="tab"
              href="#profile"
              role="tab"
              aria-controls="profile"
              aria-selected="false"
              >Specification</a
            >
          </li>
          <li class="nav-item">
            <a
              class="nav-link"
              id="contact-tab"
              data-toggle="tab"
              href="#contact"
              role="tab"
              aria-controls="contact"
              aria-selected="false"
              >Comments</a
            >
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade"
            id="home"
            role="tabpanel"
            aria-labelledby="home-tab"
          >
            <p><?= $barang['keterangan']; ?></p>
          </div>
          <div
            class="tab-pane fade"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab"
          >
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>
                      <h5>Nama Produk</h5>
                    </td>
                    <td>
                      <h5><?= $barang['nama_produk']; ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Jenis Barang</h5>
                    </td>
                    <td>
                      <h5><?= $barang['category']; ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Harga Barang</h5>
                    </td>
                    <td>
                      <h5><?= $barang['harga']; ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Stok</h5>
                    </td>
                    <td>
                      <h5><?= $barang['stok'] ?></h5>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5>Keterangan</h5>
                    </td>
                    <td>
                      <h5><?= $barang['keterangan'] ?></h5>
                    </td>
                  </tr>                 
                </tbody>
              </table>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="contact"
            role="tabpanel"
            aria-labelledby="contact-tab"
          >
            <div class="row">
              <div class="col-lg-6">
                <div class="comment_list">
                  <?php if($komentar == NULL) { ?>
                    Belum Ada Komentar
                  <?php } else { ?>
                  <?php foreach ($komentar as $komen): ?>
                    <div class="review_item">
                    <div class="media">
                      <div class="d-flex">
                        <img
                          src="<?= base_url('assets/img/profiles/').$komen['image'] ?>"
                          alt="Foto Profil"
                        />
                      </div>
                      <div class="media-body">
                        <h4><?= $komen['name']; ?></h4>
                        <h5><?php 
  $offset=7*60*60; //converting 5 hours to seconds.
  $dateFormat="d-m-Y H:i";
  $timeNdate=gmdate($dateFormat, $komen['date_comment']+$offset);
  echo $timeNdate;
?></h5>
                      </div>
                    </div>
                    <p>
                      <?= $komen['komentar']; ?>
                    </p>
                    </div>
                  <?php endforeach ?>
                <?php } ?>
                  
  
                </div>
              </div>
              <div class="col-lg-6">
                <div class="review_box">
                  <h4>Post a comment</h4>
                   <?= form_open_multipart('fusfus/inputKomentar'); ?>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          value="<?= $user['name']; ?>"
                          readonly="true"
                        />
                        <input
                          type="text"
                          class="form-control"
                          id="id_barang"
                          name="id_barang"
                          value="<?= $barang['kode_barang_jualan']; ?>"
                          readonly="true"
                          hidden
                        />
                        <input
                          type="text"
                          class="form-control"
                          id="id_user"
                          name="id_user"
                          value="<?= $user['id']; ?>"
                          readonly="true"
                          hidden
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          id="email"
                          name="email"
                          value="<?= $user['email']; ?>"
                          readonly="true"
                        />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea
                          class="form-control"
                          name="komentar"
                          id="komentar"
                          rows="1"
                          placeholder="Masukan Komentar"
                        ></textarea>
                      </div>
                    </div>
                    <div class="col-md-12 text-right">
                      <button
                        type="submit"
                        value="submit"
                        class="btn submit_btn"
                      >
                        Submit Now
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================End Product Description Area =================-->
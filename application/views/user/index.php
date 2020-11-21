          <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <div class="row">
            <div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
          </div>

          <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="<?= base_url('assets/img/profiles/').$user['image']; ?>" class="card-img" alt="Foto Profil">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">Nama : <?= $user['name']; ?></h5>
                  <p class="card-text">Email : <?= $user['email']; ?></p>
                  <p class="card-text">No.Hp : <?= $user['no_hp']; ?></p>
                  <p class="card-text">Saldo Anda : <?= $user['saldo_user']; ?> Poin</p>
                  <p class="card-text"><small>Address : <?= $user['alamat']; ?></small></p>
                  <p class="card-text"><small class="text-muted">Member since <?= date('d M Y', $user['date_created']); ?></small></p>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
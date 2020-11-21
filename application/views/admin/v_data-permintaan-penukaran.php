        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          	<div class="row">
          	<div class="col-lg">
          		<?php if (validation_errors()): ?>
              <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?= validation_errors(); ?>
              </div>
              <?php endif ?>
          


			<?= $this->session->flashdata('message');  ?>
  <div class="card-body">
  <div class="table-responsive">    		
  <table class="table table-bordered" id="dataTable">
  <thead class="table-primary">
    <tr align="center">
      <th scope="col">Id Penukaran</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Id User</th>
      <th scope="col">Nama User</th>
      <th scope="col">Tanggal Pemesanan</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	
  	<?php foreach($tukarSaldo as $ts) : ?>
    <tr>
      <td align="center"><?= $ts['kode_tukar_saldo']; ?></td>
      <td align="center"><?= $ts['kode_barang_tukar']; ?></td>
      <td align="center"><?= $ts['nama_produk']; ?></td>
      <td align="center"><?= $ts['id_user']; ?> </td>
      <td align="center"><?= $ts['name']; ?></td>
      <td align="center"><?= date('d M Y',$ts['tanggal_permintaan']); ?></td>
      <td align="center"><?= $ts['status']; ?></td>
      <td align="center">
      <?php if($ts['status'] == "Sedang Diproses") { ?>
			<a href="<?= base_url('admin/changeStatusTukarToSiapAmbil/'.$ts['kode_tukar_saldo']); ?>" class="badge badge-info"><span class="fas fa-fw fa-paper-plane"></span>Siap Ambil</a>
      <?php } else { ?>      	
			<a href="<?= base_url('admin/changeStatusTukarToSelesai/'.$ts['kode_tukar_saldo']); ?>" class="badge badge-success">Selesai</a>      	
      <?php } ?>
      </td>
    </tr>

  		<?php endforeach; ?>
	
  </tbody>
</table>
</div>
</div>

          	</div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
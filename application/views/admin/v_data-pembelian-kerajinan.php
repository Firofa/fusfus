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
      <th scope="col">Id Pesanan</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Id User</th>
      <th scope="col">Nama User</th>
      <th scope="col">Tanggal Pemesanan</th>
      <th scope="col">Jumlah Pesan</th>
      <th scope="col">Total</th>
      <th scope="col">Bukti Pembayaran</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	
  	<?php foreach($pesanKerajinan as $pk) : ?>
    <tr>
      <td><?= $pk['id_pesan']; ?></td>
      <td align="center"><?= $pk['kode_barang_pesan']; ?></td>
      <td align="center"><?= $pk['nama_produk']; ?></td>
      <td align="center"><?= $pk['id_user']; ?> </td>
      <td align="center"><?= $pk['name']; ?></td>
      <td align="center"><?= date('d M Y',$pk['tanggal_pesan']); ?></td>
      <td align="center"><?= $pk['jumlah_pesan']; ?></td>
      <td align="center"><?= $pk['total']; ?></td>
      <td align="center"><img src="<?= base_url('assets/img/buktipembayaran/').$pk['resi']; ?>" style="width:100px; height:100px;"></td>
      <td align="center"><?= $pk['status']; ?></td>
      <td align="center">
			<?php if($pk['status'] == 'Sedang Diproses') { ?>
      <a href="<?= base_url('admin/changeStatusSendPesanan/'.$pk['id_pesan']); ?>" class="badge badge-info"><span class="fas fa-fw fa-paper-plane"></span>Terkirim</a>
      <?php } else { ?>      	
			<a href="<?= base_url('admin/changeStatusPesanan/'.$pk['id_pesan']); ?>" class="badge badge-success">Selesai</a>      	
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
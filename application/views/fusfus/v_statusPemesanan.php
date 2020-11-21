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
      <th scope="col">No</th>
      <th scope="col">Nama Barang Pesan</th>
      <th scope="col">Tanggal Pemesanan</th>
      <th scope="col">Jumlah Pesan</th>
      <th scope="col">Total</th>
      <th scope="col">Bukti Pembayaran</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $no = 1; ?>
  	<?php foreach($barang_jualan as $jualan) : ?>
    <tr>
      <td><?= $no; ?></td>
      <td><?= $jualan['nama_produk']; ?></td>
      <td align="center"><?= date('d M Y', $jualan['tanggal_pesan']); ?></td>
      <td align="center"><?= $jualan['jumlah_pesan']; ?></td>
      <td align="center"><?= $jualan['total']; ?> </td>
      <td align="center"><img alt="bukti pembayaran belum diupload" src="<?= base_url('assets/img/buktipembayaran/').$jualan['resi']; ?>" style="width:100px; height:100px;"></td>
      <td align="center"><?= $jualan['status']; ?></td>
      <td align="center"><a href="<?= base_url('fusfus/uploadpembayaran/'.$jualan['id_pesan']) ?>" class="badge badge-info">Upload Bukti Pembayaran</a></td>
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
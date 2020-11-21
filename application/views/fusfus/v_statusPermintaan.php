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
      <th scope="col">Opsi Penukaran</th>
      <th scope="col">Penambahan Saldo</th>
      <th scope="col">Tanggal Permintaan</th>
      <th scope="col">Status</th>
      </tr>
  </thead>
  <tbody>
  	<?php $no = 1; ?>
  	<?php foreach($barang_sampah as $bs) : ?>
    <tr>
      <td><?= $no; ?></td>
      <td><?= $bs['opsi_penukaran']; ?></td>
      <td align="center"><?= $bs['saldo_tambah']; ?></td>
      <td align="center"><?= date('d M Y', $bs['tanggal_permintaan']); ?></td>
      <td align="center"><?= $bs['status']; ?></td>
      
    </tr>
    <?php $no++ ?>

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


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
      <th scope="col">Nama User</th>
      <th scope="col">Komentar di</th>
      <th scope="col">Isi Komentar</th>
      <th scope="col">Tanggal Komentar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $no = 1; ?>
  	<?php foreach($dataKomentar as $dk) : ?>
    <tr>
      <td align="center"><?= $no; ?></td>
      <td align="center"><?= $dk['name']; ?></td>
      <td align="center"><?= $dk['nama_produk']; ?></td>
      <td align="center"><?= $dk['komentar']; ?></td>
      <td align="center"><?= date('d M Y',$dk['date_comment']); ?></td>
      <td align="center"> 	
			<a href="<?= base_url('fusfus/detailProduct/').$dk['kode_barang_jualan']; ?>" class="badge badge-secondary">Cek Komentar</a>      	
      <a href="<?= base_url('admin/deleteKomentar/'.$dk['id_komentar']); ?>" class="badge badge-danger">Hapus Komentar</a>       
      </td>
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
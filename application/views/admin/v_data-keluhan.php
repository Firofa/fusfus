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
      <th scope="col">Email</th>
      <th scope="col">No Hp</th>
      <th scope="col">Isi Keluhan</th>
      <th scope="col">Tanggal Keluhan</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $no = 1; ?>
  	<?php foreach($dataKeluhan as $dk) : ?>
    <tr>
      <td align="center"><?= $no; ?></td>
      <td align="center"><?= $dk['name']; ?></td>
      <td align="center"><?= $dk['email']; ?></td>
      <td align="center"><?= $dk['no_hp']; ?></td>
      <td align="center"><?= $dk['keluhan']; ?></td>
      <td align="center"><?= date('d M Y',$dk['date_keluhan']); ?></td>
      <td align="center"><a href="<?= base_url('admin/deletekeluhan/'.$dk['id_keluhan']); ?>" class="badge badge-danger">Hapus Keluhan</a> </td>
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
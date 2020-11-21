        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

          <div class="row">
          	<div class="col-lg">
          		<?= form_error('menu','<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>',
  						
				'</div>'); ?>



  <div class="card-body">
  <div class="table-responsive">        		
  <table class="table table-bordered" id="dataTable">
  <thead class="table-primary">
    <tr align="center">
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">No. HP</th>
      <th scope="col">Saldo</th>
      <th scope="col">Alamat</th>
      <th scope="col">Active</th>
      <th scope="col">Date Created</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
  	<?php foreach($anggota as $user) : ?>
    <tr>
      <td><?= $user['name']; ?></td>
      <td><?= $user['email']; ?> </td>
      <td align="center"><?= $user['no_hp']; ?> </td>
      <td align="center"><?= $user['saldo_user']; ?> Poin</td>
      <td align="center"><?= $user['alamat']; ?> </td>
      <td align="center"><?= $user['is_active']; ?></td>
      <td align="center"><?= date('d M Y', $user['date_created']); ?></td>
      <td align="center"><img src="<?= base_url('assets/img/profiles/').$user['image']; ?>" style="width:100px; height:100px;"></td>
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

      
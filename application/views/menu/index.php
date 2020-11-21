        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          

          <div class="row">
          	<div class="col-lg-6">
          		<?= form_error('menu','<div class="alert alert-dismissible alert-danger">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>',
  						
				'</div>'); ?>


				<?= $this->session->flashdata('message');  ?>

          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>

  <div class="card-body">
  <div class="table-responsive">    		
  <table class="table table-bordered" id="dataTable">
  <thead class="table-primary">
    <tr align="center">
      <th scope="col">#</th>
      <th scope="col">Menu</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $i = 1; ?>
  	<?php foreach($menu as $m) : ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $m['menu']; ?></td>
      <td align="center">
			<a href="<?= base_url('menu/editmenu/'.$m['id']); ?>" class="btn btn-info">Edit</a>      	
			<a href="<?= base_url('menu/hapus_menu/'.$m['id']); ?>" onclick="return confirm('Delete Menu with ID: <?= $m['id']; ?>')" class="btn btn-danger">Delete</a>      	
      </td>
    </tr>
    <?php $i++; ?>
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

      

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu'); ?>" method="POST">
      <div class="modal-body">
        <div class="form-group">
    	<input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>
    </div>
  </div>
</div>
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

          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Sub Menu</a>

  <div class="card-body">
  <div class="table-responsive">        
  <table class="table table-bordered" id="dataTable">        		
  <thead class="table-primary">
    <tr align="center">
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Menu</th>
      <th scope="col">Url</th>
      <th scope="col">Icon</th>
      <th scope="col">Active</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $i = 1; ?>
  	<?php foreach($subMenu as $sm) : ?>
    <tr>
      <th scope="row"><?= $i; ?></th>
      <td><?= $sm['title']; ?></td>
      <td><?= $sm['menu']; ?></td>
      <td><?= $sm['url']; ?></td>
      <td><?= $sm['icon']; ?></td>
      <td><?= $sm['is_active']; ?></td>
      <td align="center">
			<a href="<?= base_url('menu/editsubmenu/'.$sm['id']); ?>" class="btn btn-info">Edit</a>      	
			<a href="<?= base_url('menu/hapus_sub_menu/'.$sm['id']); ?>" class="btn btn-danger">Delete</a>      	
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="POST">
      <div class="modal-body">
        <div class="form-group">
    	<input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
        </div>
        <div class="form-group">
          <select name="menu_id" id="menu_id" class="form-control">
            <option value="">Select Menu</option>
            <?php foreach ($menu as $m) :?>
            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
      <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu Url">
        </div>
        <div class="form-group">
      <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon">
        </div>
        <div class="form-group">
          <div class="form-check">
  <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
  <label class="form-check-label" for="is_active">
    Active?
  </label>
</div>

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

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
			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKategoriModal">Tambah Kategori</a>



  <div class="card-body">
  <div class="table-responsive">     		
  <table class="table table-bordered"  id="dataTable">
  <thead class="table-primary">
    <tr align="center">
      <th scope="col">No</th>
      <th scope="col">Kategori</th>
      <th scope="col">Jenis Kategori</th>
      <th scope="col">Action</th>
      </tr>
  </thead>
  <tbody>
  	<?php $no = 1; ?>
  	<?php foreach($category as $ctg) : ?>
    <tr>
      <td><?= $no; ?></td>
      <td align="center"><?= $ctg['category']; ?></td>
      <td align="center"><?= $ctg['jenis_category']; ?> </td>
      <td align="center">
			<a href="<?= base_url('admin/editkategori/').$ctg['id']; ?>" data-id="<?= $ctg['id']; ?>" class="badge badge-info">Edit</a>      	
			<a href="<?= base_url('admin/deletekategori/').$ctg['id']; ?>"  class="badge badge-danger">Delete</a>      	
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

      

<!-- Input Modal -->
<div class="modal fade" id="newKategoriModal" tabindex="-1" role="dialog" aria-labelledby="newTukaranLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newTukaranLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('admin/dataKategori'); ?>
      <div class="modal-body">
        <div class="form-group">
    	<input type="text" class="form-control" id="category" name="category" placeholder="Nama Kategori">
        </div>
        <div class="form-group">
          <select name="jenis_category" id="jenis_category" class="form-control">
            <option value="" readonly>Pilih Jenis Kategori</option>
            <option value="jualan">Jualan</option>
            <option value="penukaran">Penukaran</option>
            <option value="sampah">Sampah</option>
          </select>
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


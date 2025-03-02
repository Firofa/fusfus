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
			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newTukaranModal">Tambah Barang Tukar</a>



  <div class="card-body">
  <div class="table-responsive">     		
  <table class="table table-bordered"  id="dataTable">
  <thead class="table-primary">
    <tr align="center">
      <th scope="col">Nama</th>
      <th scope="col">Kategori</th>
      <th scope="col">Stok</th>
      <th scope="col">Image</th>
      <th scope="col">Harga Saldo</th>
      <th scope="col">Harga Uang</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Date Updated</th>
      <th scope="col">Action</th>
      </tr>
  </thead>
  <tbody>
  	
  	<?php foreach($barang_tukar as $bt) : ?>
    <tr>
      <td><?= $bt['nama_produk']; ?></td>
      <td align="center"><?= $bt['category']; ?></td>
      <td align="center"><?= $bt['stok']; ?> </td>
      <td align="center"><img src="<?= base_url('assets/img/product/').$bt['image']; ?>" style="width:100px; height:100px;"></td>
      <td align="center"><?= $bt['harga_saldo']; ?></td>
      <td align="center"><?= $bt['harga_uang']; ?></td>
      <td align="center"><?= $bt['keterangan']; ?></td>
      <td align="center"><?= date('d M Y', $bt['date_updated']); ?></td>
      <td align="center">
			<a href="<?= base_url('admin/editbarangtukar/'.$bt['kode_barang_tukar']); ?>"  class="badge badge-info">Edit</a>      	
			<a href="<?= base_url('admin/hapusbarangtukar/'.$bt['kode_barang_tukar']); ?>" class="badge badge-danger">Delete</a>      	
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

      

<!-- Input Modal -->
<div class="modal fade" id="newTukaranModal" tabindex="-1" role="dialog" aria-labelledby="newTukaranLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newTukaranLabel">Tambah Barang Tukar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('admin/dataBarangTukar'); ?>
      <div class="modal-body">
        <div class="form-group">
    	<input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk">
        </div>
        <div class="form-group">
          <select name="id_category" id="id_category" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php foreach ($category as $ctg) :?>
            <option value="<?= $ctg['id']; ?>"><?= $ctg['category']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
      		<input type="text" class="form-control" id="stok" name="stok" placeholder="Masukan Stok">
        </div>

        <div class="form-group">
  		<label for="image">Masukan Gambar Produk :</label>
        <input type="file" class="form-control" id="image" name="image">
  		</div>


        <div class="form-group">
      		<input type="text" class="form-control" id="harga_saldo" name="harga_saldo" placeholder="Masukan Harga Saldo Penukaran">
        </div>

        <div class="form-group">
      		<input type="text" class="form-control" id="harga_uang" name="harga_uang" placeholder="Masukan Harga Uang (jika tukar uang)">
        </div>

        <div class="form-group">
      		<input type="textarea" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan Keterangan">
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


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
          <?= $this->session->flashdata('message');  ?>

  <div class="card-body">
  <div class="table-responsive">     		
  <table class="table table-bordered"  id="dataTable">
  <thead class="table-primary">
    <tr align="center">
      <th scope="col">No</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Harga Saldo</th>
      <th scope="col">Tanggal Permintaan</th>
      <th scope="col">Status</th>
     </tr>
  </thead>
  <tbody>
  	<?php 	$no = 1; ?>
  	<?php foreach($barang_tukar as $bt) : ?>
    <tr>
      <td align="center"><?= $no; ?></td>
      <td align="center"><?= $bt['nama_produk']; ?></td>
      <td align="center"><?= $bt['harga_saldo']; ?></td>
      <td align="center"><?= date('d M Y', $bt['tanggal_permintaan']); ?></td>
      <td align="center"><?= $bt['status']; ?></td>
    </tr>
    <?php $no++ ?>

  		<?php endforeach; ?>
	
  </tbody>
</table>
</div>
</div>
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
          	<div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
          	<div class="col-lg-8">
          		
          		  
				<?= form_open_multipart('menu/doeditmenu'); ?>
				<div class="form-group row">
			    <label for="id" class="col-sm-2 col-form-label">Id Menu</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="id" name="id" value="<?= $id; ?>" READONLY>
			    </div>
			    </div> 
			    <div class="form-group row">
			    <label for="menu" class="col-sm-2 col-form-label">Nama Menu</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="menu" name="menu" value="<?= $menu; ?>" required>
			       <?= form_error('menu','<small class="text-danger pl-3">', '</small>');    ?>
			    </div>	
				</div>

				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Edit</button>
					</div>
				</div>
			            			




          		</form>


          	</div>
          </div>

          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      
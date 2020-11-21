        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


          <div class="row">
          	<div class="col-lg-6">
              <?= $this->session->flashdata('message'); ?>
            </div>
          	<div class="col-lg-8">
          		
          		  
				<?= form_open_multipart('menu/doeditsubmenu'); ?>
				<div class="form-group">
			    <label for="id" class="col-sm-2 col-form-label">Id Sub Menu</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="id" name="id" value="<?= $id; ?>" READONLY>
			      <?= form_error('id','<small class="text-danger pl-3">', '</small>');    ?>
			    </div>
			    </div> 
			    <div class="form-group">
			    <label for="title" class="col-sm-2 col-form-label">Title</label>
    			<input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title" value="<?= $title;  ?>">
    			<?= form_error('title','<small class="text-danger pl-3">', '</small>');    ?>
        	</div>
        	<div class="form-group">
        	<label for="menu_id" class="col-sm-2 col-form-label">Menu Id</label>
            <input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="Sub Menu Title" value="<?= $menu_id;  ?>" readonly>
            <?= form_error('menu_id','<small class="text-danger pl-3">', '</small>');    ?>
        </div>
        <div class="form-group">
        <label for="url" class="col-sm-2 col-form-label">URL</label>
      <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu Url" value="<?= $url;  ?>">
      <?= form_error('url','<small class="text-danger pl-3">', '</small>');    ?>
        </div>
        <div class="form-group">
        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
      <input type="text" class="form-control" id="icon" name="icon" value="<?= $icon;  ?>" placeholder="Sub Menu Icon">
      <?= form_error('icon','<small class="text-danger pl-3">', '</small>');    ?>
        </div>
        <div class="form-group">
          <div class="form-check">
  		<input class="form-check-input" type="checkbox" value="1" 		id="is_active" name="is_active" checked>
  		<label class="form-check-label" value="<?= $is_active; ?>" for="is_active">
    		Active?
  		</label>
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

      
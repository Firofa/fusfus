<div class="jumbotron">
  <h1 class="display-3">Selamat Datang di Sistem Fusfus</h1>
  <p class="lead">Web ini adalah salah satu unit rumah inspirasi, sebuah tempat untuk menukarkan sampah menjadi poin.</p>
  <hr class="my-4">
  <p>Poin yang didapatkan dapat anda tukarkan menjadi barang - barang yang tersedia di web ini.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="<?= base_url('auth') ?>/Registration_fus" role="button">Register to Learn more</a>
  </p>
</div>
<blockquote class="blockquote text-center ">
  <p class="mb-0">Manfaatkan sampah untuk masa depan yang lebih baik.</p>
  <footer class="blockquote-footer">CO Founder <cite title="Source Title">Syifa Rizkita Ananda</cite></footer>
</blockquote>

<div class="d-flex justify-content-center border-top ">
  <?= $this->session->flashdata('message');  ?>
	<form class="text-center" method="POST" action="<?= base_url('auth'); ?>">
	  	<br><br><br>
      <fieldset>
		    <legend>Login untuk Masuk Sistem</legend>
		   	 <div class="form-group">
      			<label for="username">Email</label>
      			<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email Adress..." value="<?= set_value('email'); ?>">
            <?= form_error('email','<small class="text-danger pl-3">', '</small>');    ?>
   			 </div>
   			<div class="form-group">
      			<label for="exampleInputPassword1">Password</label>
      			<input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" value="<?= set_value('email'); ?>">
            <?= form_error('email','<small class="text-danger pl-3">', '</small>');    ?>
    		</div>
    		<button type="submit" class="btn btn-primary">Submit</button>
		</fieldset>
	       <div class="text-center">
            <a class="small" href="<?= base_url('auth') ?>/forgotPassword">Forgot Password?</a>
         </div>
          <div class="text-center">
            <a class="small" href="<?= base_url('auth') ?>/Registration_fus">Create an Account!</a>
          </div>
  </form>
                  
</div>


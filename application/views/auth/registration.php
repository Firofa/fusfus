  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block"><img src="<?= base_url('assets/');?>img/kerajinan-tas-rumah-inspirasi.png" style="width: 503px; height: 605px;"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST" action="<?= base_url('Auth/Registration_fus'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>" />
                  <?= form_error('name','<small class="text-danger pl-3">', '</small>');    ?> 
                  
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>" />
                  <?= form_error('email','<small class="text-danger pl-3">', '</small>');    ?> 
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="Enter Phone Number" value="<?= set_value('no_hp'); ?>" />
                  <?= form_error('no_hp','<small class="text-danger pl-3">', '</small>');    ?> 
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Enter Your Address" value="<?= set_value('alamat'); ?>" />
                  <?= form_error('alamat','<small class="text-danger pl-3">', '</small>');    ?> 
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1','<small class="text-danger pl-3">', '</small>');    ?> 
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
                <!-- <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
              <hr>
              <div class="text-center">
                    <a class="small" href="<?= base_url('Home'); ?>"> &larr;Back To Home</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('Auth/forgotPassword'); ?>">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth') ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
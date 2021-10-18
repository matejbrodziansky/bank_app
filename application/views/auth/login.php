<style>
  .login,
  .image {
    min-height: 100vh;
  }

  .bg-image {
    background-image: url('https://img2.goodfon.com/wallpaper/nbig/3/bf/computer-security-credit.jpg');
    background-size: cover;
    background-position: center center;
  }
</style>

<div class="container-fluid">
  <div class="row no-gutter">
    <!-- The image half -->
    <div class="col-md-6 d-none d-md-flex bg-image"></div>


    <!-- The content half -->
    <div class="col-md-6 bg-light">
      <div class="login d-flex align-items-center py-5">

        <!-- Demo content-->
        <div class="container">
          <div class="row">
            <div class="col-lg-10 col-xl-7 mx-auto">
              <h3 class="display-4">Login </h3>
              <!-- <p class="text-muted mb-4">Create a login split page using Bootstrap 4.</p> -->
              <form action="<?= base_url('auth/login') ?>" method="post">
                <div class="form-group mb-3">
                  <input id="inputEmail" type="text" placeholder="id" required="" name="identity" class="form-control rounded-pill border-0 shadow-sm px-4">
                </div>
                <div class="form-group mb-3">
                  <input id="inputPassword" type="password" name="password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                </div>
                <div class="custom-control custom-checkbox mb-3">
                  <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                  <label for="customCheck1" class="custom-control-label">Remember password</label>
                </div>
                <button type="submit" name="submit" value="login" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                <div class="text-center d-flex justify-content-between mt-4">
                  <p>Snippet by <a href="https://bootstrapious.com/snippets" class="font-italic text-muted">
                      <u>Boostrapious</u></a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- 
<h1>
  < ?php echo lang('login_heading');?>
</h1>
<p>
  < ?php echo lang('login_subheading');?>
</p>

<div id="infoMessage">
  < ?php echo $message;?>
</div>

< ?php echo form_open("auth/login"); ?>

<p>
  < ?php echo lang('login_identity_label', 'identity'); ?>
  < ?php echo form_input($identity); ?>
</p>

<p>
  < ?php echo lang('login_password_label', 'password'); ?>
  < ?php echo form_input($password); ?>
</p>

<p>
  < ?php echo lang('login_remember_label', 'remember'); ?>
  < ?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?>
</p>


<p>< ?php echo form_submit('submit', lang('login_submit_btn')); ?></p>

< ?php echo form_close(); ?>

<p><a href="forgot_password">< ?php echo lang('login_forgot_password'); ?></a></p> -->
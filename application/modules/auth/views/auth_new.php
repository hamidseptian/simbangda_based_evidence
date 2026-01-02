

<style>
  .lb_auth {
      background-color: white;
      background-image: url('../assets/sbe/image/bg1_ok.jpg');
      background-attachment: fixed;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: top;

  }
</style>
<div class="app-container app-theme-white body-tabs-shadow login-box">
        <div class="app-container">
            <div class="h-100 lb_auth">
                <div class="d-flex h-100 justify-content-center align-items-center">
                    <div class="mx-auto app-login-box col-md-8">
                        <div class="app-logo-inverse mx-auto mb-3"></div>
                                    <form id="form-login" method="post">
                        <div class="modal-dialog w-100 mx-auto">
                            <div class="modal-content">
                                <div class="modal-body">
                                      <img src="<?php echo base_url() ?>/assets/sbe/image/logo_sbe.png" width="100%" alt="img-logo" class="logo-app text-left">
                                    <div class="h5 modal-title text-center">
                                        <h4 class="mt-2">
                                            <div>Welcome back,</div>
                                            <span>Please sign in to your account below.</span>

                                        </h4>
                                    </div>
                                            <div class="notifikasi"></div>

                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input type="text" class="form-control" id="email" placeholder="Email/Username" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="true">
                                                </div>
                                            </div>
                                        </div>
                                      
                                </div>
                                <div class="modal-footer clearfix">
                                        <button type="submit" class="btn btn-info btn-block btn-flat" id="btn-signin">Sign In</button>
                                </div>
                            </div>
                        </div>
                                    </form>
                        <!-- <div class="text-center text-white opacity-8 mt-3">Copyright © ArchitectUI 2019</div> -->
                    </div>
                </div>
            </div>
        </div>
</div>
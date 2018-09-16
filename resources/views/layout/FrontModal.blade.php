<div class="modal fade" id="login-now" aria-hidden="true" aria-labelledby="login-now" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-sidebar modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">Login</h4></div>
            <div class="modal-body">
                <div class="panel">
                    <div class="row">
                        <div class="social-login google-login"><a
                                    href="#"
                                    class="btn btn-block social-google-plus"><i
                                        class="icon jssico-google-plus bd-google-plus"></i><em> Login with</em> Google
                                Plus</a>
                        </div>
                        <form method="post" action="https://www.multimedia.pub/login" class="mtop10 modal-form">
                            <div class="form-group form-material floating"><input type="email" autocomplete="email"
                                                                                  class="form-control" name="email"
                                                                                  required
                                                                                  data-error="Your e-mail must be valid."/><label
                                        class="floating-label">Email</label></div>
                            <div class="form-group form-material floating"><input type="password"
                                                                                  autocomplete="current-password"
                                                                                  class="form-control" name="password"
                                                                                  required/><label
                                        class="floating-label">Password</label></div>
                            <div class="form-group clearfix">
                                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg pull-left">
                                    <input type="checkbox" id="inputCheckbox" name="remember" checked=checked><label
                                            for="inputCheckbox">Remember me</label></div>
                                <a class="pull-right" data-target="#forgot-pass" data-toggle="modal"
                                   href="javascript:void(0)">Forgot password?</a></div>
                            <button type="submit" class="btn btn-primary btn-block mtop20">Sign In</button>
                        </form>
                        <p class="mtop10">Still no account? Please go to <a data-target="#register-now"
                                                                            data-toggle="modal"
                                                                            href="javascript:void(0)">Sign up</a></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="forgot-pass" aria-hidden="true" aria-labelledby="forgot-pass" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-sidebar modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">Forgotten password</h4></div>
            <div class="modal-body">
                <div class="panel">
                    <div class="row">
                        <form method="post" action="https://www.multimedia.pub/login" class="modal-form">
                            <div class="form-group form-material floating"><input type="hidden" name="forgot-pass"
                                                                                  value="1"/><input type="email"
                                                                                                    class="form-control"
                                                                                                    name="remail"
                                                                                                    data-error="Your e-mail must be valid."
                                                                                                    required/><label
                                        class="floating-label">Your e-mail</label></div>
                            <button type="submit" class="btn btn-primary btn-block mtop20">Recover now</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="register-now" aria-hidden="true" aria-labelledby="register-now" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-sidebar modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">Create an account</h4></div>
            <div class="modal-body">
                <div class="panel">
                    <div class="row">
                        <div class="social-login google-login"><a
                                    href="#"
                                    class="btn btn-block social-google-plus"><i
                                        class="icon jssico-google-plus bd-google-plus"></i><em> Login with</em> Google
                                Plus</a>
                        </div>
                        <form method="post" action="#" class="mtop10 modal-form">
                            <div class="form-group form-material floating"><input type="name" class="form-control"
                                                                                  name="name" required/><label
                                        class="floating-label">Your name</label></div>
                            <div class="form-group form-material floating"><input type="email" class="form-control"
                                                                                  name="email" required/><label
                                        class="floating-label">Email</label></div>
                            <div class="form-group form-material floating"><input type="password" id="password1"
                                                                                  class="form-control" name="password"
                                                                                  required/><label
                                        class="floating-label">Password</label></div>
                            <div class="form-group form-material floating"><input type="password" class="form-control"
                                                                                  name="password2"
                                                                                  data-match="#password1"
                                                                                  data-match-error="Passwords do not match"
                                                                                  required/><label
                                        class="floating-label">Repeat password</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mtop20">Create account</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="search-now" aria-hidden="true" data-backdrop="false" aria-labelledby="search-now"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-sidebar modal-searcher">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="panel panel-transparent">
                    <div class="row search-now-clone"></div>
                </div>
            </div>
        </div>
    </div>
</div>
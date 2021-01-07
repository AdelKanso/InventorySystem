<div class="container">
    <div class="row">
        <div class="col-10">
            <div class="login-panel panel panel-default" style="margin-top: 25%;width: 400px;padding: 0;margin-left: 0;">
                <div class="panel-heading" style="  background-color: #337ab7;">
                    <h3 class="panel-title" style="color: white;">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="/api/login" role="form" class="form-signin">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email"
                                   autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="password"  type="password">
                        </div>
                        <div class="checkbox">
                            <label style="color: #337ab7;font-weight:bold" >
                                <input name="remember" id="remember" type="checkbox" value="Remember Me" checked>Remember Me
                            </label>
                        </div>
                        <button type="submit" id="submit-login-form" class="btn btn-lg btn-success btn-block" style="  background-color: #337ab7;">Login
                        </button>
                    </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


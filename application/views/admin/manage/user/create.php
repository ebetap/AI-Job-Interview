        <!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Create User</h3>
      </div>

    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <label for="fullname">Nomor KTP :</label>
                  <input type="text" id="fullname" class="form-control" name="noktp" required />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <label for="fullname">Nama Lengkap :</label>
                  <input type="text" id="fullname" class="form-control" name="fullname" required />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <label for="fullname">Username :</label>
                  <input type="text" id="fullname" class="form-control" name="username" required />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <label for="email">E-mail :</label>
                  <input type="email" id="email" class="form-control" name="email" data-parsley-trigger="change" required />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <label>Gender :</label>
                  <p>
                    Male:
                    <input type="radio" class="flat" name="gender" id="genderM" value="Male" checked="" required /> | Female:
                    <input type="radio" class="flat" name="gender" id="genderF" value="Female" />
                  </p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <label for="fullname">Password :</label>
                  <input type="text" id="fullname" class="form-control" name="password" required />
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a href="<?php echo base_url(); ?>admin/home"><button class="btn btn-primary" type="button" href=>Cancel</button></a>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success" name="submit">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>
<!-- /page content -->

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Create Soal</h3>
      </div>

    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST">
              
              <?php
              if ($status) {
              echo $status;
              } else {
                foreach ( $soal as $var ){
                      echo "<div  class=question>
                            <p>".$var["no"].". ".$var["soal"]."</p>
                            <textarea name=answer[] placeholder=Isi sesuai dengan kata hati anda..... class=txtArea></textarea><br>
                          </div>";
                    }
                  echo "<div class=ln_solid></div>
              <div class=form-group>
                <div class=col-md-6 col-sm-6 col-xs-12 col-md-offset-3>
                  <button class=btn btn-primary type=button>Cancel</button>
                  <button class=btn btn-primary type=reset>Reset</button>
                  <button type=submit class=btn btn-success name=submit>Submit</button>
                </div>
              </div>";
                  }
              ?>

            </form>
          </div>
        </div>
      </div>
    </div>
 </div>
</div>
<!-- /page content -->

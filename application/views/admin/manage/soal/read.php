  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Users <small>Some examples to get you started</small></h3>
        </div>

        <div class="title_right">
          <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Pertanyaan Interview <small>Users</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a href="<?php echo base_url(); ?>admin/manage/soal/create"><i class="fa fa-plus"></i></a></li>
                <li><a href="><?php echo base_url(); ?>admin/manage/soal/edit"<i class="fa fa-wrench"></i></a></li>
                <li><a href="<?php echo base_url(); ?>admin/manage/soal/delete"><i class="fa fa-close"></i></a></li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Pertanyaan</th>
                    <th>Answer 1</th>
                    <th>Answer 2</th>
                    <th>Answer 3</th>
                    <th>Answer 4</th>
                    <th>Answer 5</th>
                    <th>Answer 6</th>
                  </tr>
                </thead>

                <tbody>
                  <?php 
                    foreach ( $soal as $var ) {
                    echo "<tr>";
                      echo "<td>".$var['no']."</td>";
                      echo "<td>".$var['soal']."</td>";
                      echo "<td>".$var['system_answer']."</td>";
                      echo "<td>".$var['system_answer2']."</td>";
                      echo "<td>".$var['system_answer3']."</td>";
                      echo "<td>".$var['system_answer4']."</td>";
                      echo "<td>".$var['system_answer5']."</td>";
                      echo "<td>".$var['system_answer6']."</td>";
                    echo "</tr>";
                    } 
                   ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->
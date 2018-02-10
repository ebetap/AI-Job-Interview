<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Total Pelamar <small></small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a href="<?php echo base_url(); ?>admin/manage/user/create"><i class="fa fa-plus"></i></a></li>
              <li><a href="><?php echo base_url(); ?>admin/manage/user/edit"<i class="fa fa-wrench"></i></a></li>
              <li><a href="<?php echo base_url(); ?>admin/manage/user/delete"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nomor KTP</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>E-Mail</th>
                  <th>Jenis Kelamin</th>
                  <th>Skor</th>
                  <th>Status</th>
                  </tr>
              </thead>

              <tbody>
                <?php 
                  foreach ( $user as $var ) {
                  echo "<tr>";
                    echo "<td>".$var['userID']."</td>";
                    echo "<td>".$var['noktp']."</td>";
                    echo "<td>".$var['fullname']."</td>";
                    echo "<td>".$var['username']."</td>";
                    echo "<td>".$var['email']."</td>";
                    echo "<td>".$var['gender']."</td>";
                    echo "<td>".$var['result']."</td>";
                    if ($var['result']==-1) {
                      echo "<td>Belum Mengerjakan</td>";
                    } else if ($var['result']<=5) {
                      echo "<td>Lolos</td>";
                    } else {
                      echo "<td>Tidak Lolos</td>";
                    }
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
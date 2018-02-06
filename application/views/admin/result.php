<!-- page content -->
<div class="right_col" role="main">
  <div class="">
        <h3 align="center">Hasil Interview<small></small></h3>

    <div class="page-title">
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- Charts Interview -->
      <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="x_panel">
          <div id="container" style="height: 300%"></div>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-gl/echarts-gl.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts-stat/ecStat.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/dataTool.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/world.js"></script>
       <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/extension/bmap.min.js"></script>
       <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/simplex.js"></script>
       <script type="text/javascript">
        var dom = document.getElementById("container");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        option = {
            title : {
                text: 'Graph',
                subtext: 'Interview',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['Lolos','Tidak Lolos','Belum Mengerjakan']
            },
            series : [
                {
                    name: 'Interview',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        {value:<?php echo $lolos; ?>, name:'Lolos'},
                        {value:<?php echo $gagal; ?>, name:'Tidak Lolos'},
                        {value:<?php echo $belum; ?>, name:'Belum Mengerjakan'}
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        ;
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
       </script>
        </div>
      </div>
      <div class="col-md-5 col-sm-5 col-xs-12">
        <div class="">
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nomor KTP</th>
                <th>Nama Lengkap</th>
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
<!-- /page content -->

<script src="<?php echo base_url(); ?>/assets/resource/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>/assets/resource/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>/assets/resource/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo base_url(); ?>/assets/resource/vendors/nprogress/nprogress.js"></script>
<!-- ECharts -->
<script src="<?php echo base_url(); ?>/assets/resource/vendors/echarts/dist/echarts.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/resource/vendors/echarts/map/js/world.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>/assets/resource/build/js/custom.min.js"></script>
<!doctype html>
<?php
    require_once('../connection/conn.php');
    $sql = 'SELECT YEAR(borrow_date) FROM borrow
        JOIN `return` ON `return`.borrow_id = borrow.borrow_id
        GROUP BY YEAR(borrow_date) ORDER BY YEAR(borrow_date) DESC';
    $result = $conn->query($sql);
?>
<?php include 'title.php'; ?>

<body>
<?php include 'left-panel.php'; ?>
<?php include('navbar.php'); ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Member Report</h1> <?php $member_id = $_GET["tech_id"];?>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Member Report</a></li>
                            <li class="active">Individual Member Report</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- <div class="col-lg-6"> -->
                                    <div class="row form-group">
                                        <div class="col col-md-5">
                                            <label for="" class="px-1  form-control-label">Select Year</label>
                                        </div>

                                        <div class="col col-md-7">
                                            <select id="year_choosen" name="year" class="form-control" onchange="//showHint(this.value)" required="">
                                            <!-- <option></option> -->
                                            <option>Select Year</option>
                                            <?php
                                            while($row = $result->fetch_assoc()){
                                                echo '<option value="'.$row['YEAR(borrow_date)'].'">'.$row['YEAR(borrow_date)'].'</option>';
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div><!-- /# column -->
                    <div class="col-lg-6">
                    </div>
                    <?php

                      include "db_conn.php";

                        $stmt0 = $conn->prepare("SELECT member_fullname, k.type_name as type_name
                                                 FROM member AS e
                                                 JOIN type AS k ON e.type_id = k.type_id
                                                 AND e.member_id=?");

                        $stmt0->bind_param("s", $member_id);
                        $stmt0->execute();
                        $result0 = $stmt0->get_result();
                        $row0 = $result0->fetch_assoc();
                          $member_fullname = $row0 ['member_fullname'];
                          $type_name = $row0 ['type_name'];

                          function totalPenalty(){

                            include "../connection/conn.php";

                            $return_status = 0;

                            $member_id = $_GET["tech_id"];

                              $stmt2 = $conn->prepare("SELECT SUM(a.penalty_amount)
                                                       FROM `return` AS a
                                                       JOIN book AS b ON a.book_id = b.book_id
                                                       JOIN category AS d ON b.category_id = d.category_id
                                                       JOIN borrow c ON a.borrow_id = c.borrow_id
                                                       JOIN member AS e ON c.member_id=e.member_id
                                                       AND e.member_id=? AND a.return_status=?");

                              $stmt2->bind_param("ss", $member_id, $return_status);
                              $stmt2->execute();
                              $result2 = $stmt2->get_result();
                              $row2 = $result2->fetch_row();

                                $total = $row2[0];

                                if($total==0){
                                  echo "RM 0";
                                }else{
                                  echo "RM ".$total;
                                }
                          }

                          function recentBook(){

                            include "../connection/conn.php";

                            $return_status = 1;

                            $member_id = $_GET["tech_id"];

                              $stmt3 = $conn->prepare("SELECT count(1) FROM `return` AS a
                                                       JOIN book AS b ON a.book_id = b.book_id
                                                       JOIN category AS d ON b.category_id = d.category_id
                                                       JOIN done g ON a.done_id = g.done_id
                                                       JOIN member AS e ON g.member_id=e.member_id
                                                       AND e.member_id=? AND a.return_status=?");

                              $stmt3->bind_param("ss", $member_id, $return_status);
                              $stmt3->execute();
                              $result3 = $stmt3->get_result();
                              $row3 = $result3->fetch_row();

                                $total = $row3[0];

                                  echo $total." Books";
                          }

                     ?>
                    <div class="col-lg-6">
                          <aside class="profile-nav alt">
                              <section class="card">
                                  <div class="card-header user-header alt bg-dark">
                                      <div class="media">
                                          <a href="#">
                                              <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                                          </a>
                                          <div class="media-body">
                                              <h2 class="text-light display-6"><?php echo $member_fullname; ?></h2>
                                              <p><?php echo $type_name; ?></p>
                                          </div>
                                      </div>
                                  </div>

                                  <ul class="list-group list-group-flush">
                                      <li class="list-group-item">
                                          <i class="fa fa-comments-o"></i> Total Penalty <span class="badge badge-info pull-right"><?php echo totalPenalty(); ?></span>
                                      </li>
                                      <li class="list-group-item">
                                          <i class="fa fa-tasks"></i> Recent Book <span class="badge badge-success pull-right"><?php echo recentBook(); ?></span>
                                      </li>
                                  </ul>

                              </section>
                          </aside>
                      </div>
                </div>
            </div>


            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">
                      <div class="col-md-12">
                          <div class="card">
                              <div class="card-header">
                                  <small>Individual Member Report</small>
                              </div>
                              <div class="card-body">
                                  <div class="card-body" style="border: 1px solid #eeeedd;">
                                  <h4 class="mb-3">Book Borrowed :</h4>
                                  <div id="chart"><canvas id="sales-chart"></canvas></div>
                                  </div><br><br>

                                  <div class="card-body" style="border: 1px solid #eeeedd;">
                                   <h4 class="mb-3">Penalty Charged :</h4>
                                   <div id="chart2"><canvas id="sales-chart2"></canvas></div>
                                   </div>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>

   </body>
   <?php include 'script.php'; ?>

<script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>
   <script type="text/javascript">
    // ( function ( $ ) {
    jQuery(function($){
        $('#year_choosen').change(function(){
          $('#sales-chart').remove();
          $('#chart').append('<canvas id="sales-chart"></canvas>');
          $('#sales-chart2').remove();
          $('#chart2').append('<canvas id="sales-chart2"></canvas>');
            var year1 = $("#year_choosen").val();
            var member_id = <?php echo $_GET['tech_id'];?>;
            var data1;
            if(year1){
                $.ajax({
                    type:'POST',
                    url:'ajax_MemberBorrow.php',
                    dataType:"JSON",
                    data:{
                        year:year1,
                        member_id:member_id
                        },
                    cache: false,
                    success:function(data){
                        // alert("event"+data.type);
                        // document.getElementById("sc_1").innerHTML = data;
                        data1=data;
                        // alert("event"+data1.type);
                        // var canvas = $('#sales-chart')[0]; // or document.getElementById('canvas');
                        var ctx = document.getElementById( "sales-chart" );

                        // ctx.height = 150;
                    var myChart = new Chart( ctx, {
                        type: 'line',
                        data: {
                        labels: data1.labels,
                        type: 'line',
                        defaultFontFamily: 'Montserrat',
                        datasets: [ {
                            label: "Book",
                            data:
                                data1.datasets.data
                            ,
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(40,167,69,0.75)',
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(40,167,69,0.75)',
                            } ]
                        }
                        ,
                        options: {
                            responsive: true,

                            tooltips: {
                                mode: 'index',
                                titleFontSize: 12,
                                titleFontColor: '#000',
                                bodyFontColor: '#000',
                                backgroundColor: '#fff',
                                titleFontFamily: 'Montserrat',
                                bodyFontFamily: 'Montserrat',
                                cornerRadius: 3,
                                intersect: false,
                            },
                            legend: {
                                display: false,
                                labels: {
                                    usePointStyle: true,
                                    fontFamily: 'Montserrat',
                                },
                            },
                            scales: {
                                xAxes: [ {
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: false,
                                        labelString: 'Year'
                                    }
                                        } ],
                                yAxes: [ {
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Book'
                                    }
                                        } ]
                            },
                            title: {
                                display: false,
                                text: 'Normal Legend'
                            }
                        }
                    } );
                    },
                    error:function(data){
                    }
                });

                $.ajax({
                    type:'POST',
                    url:'ajax_MemberPenalty.php',
                    dataType:"JSON",
                    data:{
                        year:year1,
                        member_id:member_id
                        },
                    cache: false,
                    success:function(data){
                        // alert("event"+data.type);
                        // document.getElementById("sc_1").innerHTML = data;
                        data1=data;
                        // alert("event"+data1.type);
                        // var canvas = $('#sales-chart')[0]; // or document.getElementById('canvas');
                        var ctx = document.getElementById( "sales-chart2" );

                        // ctx.height = 150;
                    var myChart = new Chart( ctx, {
                        type: 'line',
                        data: {
                        labels: data1.labels,
                        type: 'line',
                        defaultFontFamily: 'Montserrat',
                        datasets: [ {
                            label: "Penalty (RM)",
                            data:
                                data1.datasets.data
                            ,
                            backgroundColor: 'transparent',
                            borderColor: 'rgba(40,167,69,0.75)',
                            borderWidth: 3,
                            pointStyle: 'circle',
                            pointRadius: 5,
                            pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(40,167,69,0.75)',
                            } ]
                        }
                        ,
                        options: {
                            responsive: true,

                            tooltips: {
                                mode: 'index',
                                titleFontSize: 12,
                                titleFontColor: '#000',
                                bodyFontColor: '#000',
                                backgroundColor: '#fff',
                                titleFontFamily: 'Montserrat',
                                bodyFontFamily: 'Montserrat',
                                cornerRadius: 3,
                                intersect: false,
                            },
                            legend: {
                                display: false,
                                labels: {
                                    usePointStyle: true,
                                    fontFamily: 'Montserrat',
                                },
                            },
                            scales: {
                                xAxes: [ {
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: false,
                                        labelString: 'Penalty (RM)'
                                    }
                                        } ],
                                yAxes: [ {
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Penalty (RM)'
                                    }
                                        } ]
                            },
                            title: {
                                display: false,
                                text: 'Normal Legend'
                            }
                        }
                    } );
                    },
                    error:function(data){
                    }
                });
            }else{
            }

        });
    });
</script>

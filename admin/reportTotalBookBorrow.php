<!doctype html>
<?php
    include ('../connection/conn.php');
    $sql = 'SELECT YEAR(borrow_date) FROM borrow
        JOIN `return` ON `return`.borrow_id = borrow.borrow_id
        GROUP BY YEAR(borrow_date) ORDER BY YEAR(borrow_date) DESC';
    $result = $conn->query($sql);
?>
<html class="no-js" lang="">
<?php include 'title.php'; ?>

<body>
    <?php include 'left-panel.php' ?>
    <div id="right-panel" class="right-panel">
        <?php include 'header2.php'; ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Book Report</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Book Report</a></li>
                            <li class="active">Total Borrowed Book</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                              <small>Total Borrowed Book</small>
                          </div>
                          <div class="card-body">
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
                                <div id="chart"><canvas id="sales-chart"></canvas></div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>

    <?php include 'script.php'; ?>

<script src="../assets/js/lib/chart-js/Chart.bundle.js"></script>
<script type="text/javascript">
    // ( function ( $ ) {
    jQuery(function($){
        $('#year_choosen').change(function(){
          $('#sales-chart').remove();
          $('#chart').append('<canvas id="sales-chart"></canvas>');
            var year1 = $("#year_choosen").val();
            var data1;
            if(year1){
                $.ajax({
                    type:'POST',
                    url:'ajax_TotalBookBorrow.php',
                    dataType:"JSON",
                    data:{year:year1},
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
                        // alert("error");
                        var ctx = document.getElementById( "sales-chart" );
                        // ctx.restore();
                        // ctx.height = 0;
                        // ctx.clearRect(0,0,0,0);
                        // document.getElementById( "sales-chart" ).innerHTML = clearRect(0,0);
                    }
                });
                // alert(data1.type);

            }else{
                // $('#year_choosen').html('<option value="">Select Category First!</option>');
            }
            // alert(data1);

        });
    });
// } );

</script>
</body>
</html>

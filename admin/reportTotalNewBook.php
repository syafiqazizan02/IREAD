<!doctype html>
<?php
    require_once('../connection/conn.php');
    $sql = 'SELECT YEAR(book_receive) FROM book
        GROUP BY YEAR(book_receive) ORDER BY YEAR(book_receive) DESC';
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
                            <li class="active">Total Registered Book</li>
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
                              <small>Total Registered Book</small>
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
                                            echo '<option value="'.$row['YEAR(book_receive)'].'">'.$row['YEAR(book_receive)'].'</option>';
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
                    url:'ajax_TotalNewBook.php',
                    dataType:"JSON",
                    data:{year:year1},
                    cache: false,
                    success:function(data){
                        data1=data;
                        var ctx = document.getElementById( "sales-chart" );
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
                        var ctx = document.getElementById( "sales-chart" );
                    }
                });

            }else{
            }

        });
    });

</script>
</body>
</html>

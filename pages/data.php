
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hydro Control</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poiret+One" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/justgage/1.2.9/justgage.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body>

    <div id="wrapper" style="background-color: #00BF9A; font-family: 'Vollkorn', serif;">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #00BF9A;" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="index.php"> <i class="fa fa-pagelines fa-fw" style="color:white"></i>  <font color="#FAFAFA">GROW PANEL</font></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right"  style="left:0">

                <!-- /.dropdown -->
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw" style="color:white"></i>
                        <i class="fa fa-caret-down" style="color:white"></i>
                    </a>
                    <!-- data-toggle="modal" data-target="#watersensor" -->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="" data-toggle="modal" data-target="#userprofile"><i class="fa fa-user fa-fw"></i> User Profile &nbsp; | &nbsp; <span><?php echo $_SESSION["name"]; ?></span> </a>
                        </li>
                        <li><a href="../php/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"></i> <font color="black"> Home</font></a>
                        </li>
                        <li>
                            <a href="data.php"></i> <font color="black"> Data</font></a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



        <div id="page-wrapper"><br>
            <div class="row">

                <div class="col-lg-6">
                  <div class="panel panel-default" >
                  <div class="panel-heading" style="background-color: #00BF9A;">


              </div>
                <canvas id="myChart3"></canvas>
</div>


                </div>

                <div class="col-lg-6">
                  <div class="panel panel-default" >
                  <div class="panel-heading" style="background-color: #00BF9A;">


              </div>
                <canvas id="myChart4" ></canvas>
</div>


                </div>




         </div>
         <div class="row">

             <div class="col-lg-6">
               <div class="panel panel-default" >
               <div class="panel-heading" style="background-color: #00BF9A;">


           </div>

             <canvas id="myChart3_1"></canvas>

</div>


             </div>
             <!-- /.col-lg-8 -->

             <div class="col-lg-6">

               <div class="panel panel-default" >
               <div class="panel-heading" style="background-color: #00BF9A;">


           </div>
             <canvas id="myChart3_2"></canvas>
</div>

      </div>

      </div>
         </div>





    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


</body>

</html>

<script>
var ctx3 = document.getElementById("myChart3");
var myChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
        labels: ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
        datasets: [{
            label: 'ความชื้นในอากาศเมื่อวาน',
            data: [1,2,3,4,5,6,7,8,9,10,11,1,2,3,3,4,5,6,7,8,9,6,8,7],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {

        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});


var ctx4 = document.getElementById("myChart4");
var myChart4 = new Chart(ctx4, {
    type: 'line',
    data: {
        labels: ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
        datasets: [{
            label: 'ความชื้นในอากาศเมื่อวาน',
            data: [1,2,3,4,5,6,7,8,9,10,11,1,2,3,3,4,5,6,7,8,9,6,8,7],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});



var ctx3_1 = document.getElementById("myChart3_1");
var myChart3_1 = new Chart(ctx3_1, {
    type: 'bar',
    data: {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
        datasets: [{
            label: 'ความชื้นในอากาศสูงสุด',
            data: [1,2,3,4,5,6,7,8,9,10,11,12],
            backgroundColor: [
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)'
            ],
            borderColor: [
                'rgba(0,255,0,1)',
                 'rgba(0,255,0,1)',
                  'rgba(0,255,0,1)',
                   'rgba(0,255,0,1)',
                    'rgba(0,255,0,1)',
                     'rgba(0,255,0,1)',
                      'rgba(0,255,0,1)',
                       'rgba(0,255,0,1)',
                        'rgba(0,255,0,1)',
                         'rgba(0,255,0,1)',
                          'rgba(0,255,0,1)',
                           'rgba(0,255,0,1)'
            ],
            borderWidth: 1
        },
        {
            label: 'ความชื้นในอากาศต่ำสุด',
            data: [],
            backgroundColor: [
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)'

            ],
            borderColor: [
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)'

            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

var ctx3_2 = document.getElementById("myChart3_2");
var myChart3_2 = new Chart(ctx3_2, {
    type: 'bar',
    data: {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"],
        datasets: [{
            label: 'ความชื้นในอากาศสูงสุด',
            data: [1,2,3,4,5,6,7,8,9,10,11,12],
            backgroundColor: [
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)',
                'rgba(0,255,0,0.3)'
            ],
            borderColor: [
                'rgba(0,255,0,1)',
                 'rgba(0,255,0,1)',
                  'rgba(0,255,0,1)',
                   'rgba(0,255,0,1)',
                    'rgba(0,255,0,1)',
                     'rgba(0,255,0,1)',
                      'rgba(0,255,0,1)',
                       'rgba(0,255,0,1)',
                        'rgba(0,255,0,1)',
                         'rgba(0,255,0,1)',
                          'rgba(0,255,0,1)',
                           'rgba(0,255,0,1)'
            ],
            borderWidth: 1
        },
        {
            label: 'ความชื้นในอากาศต่ำสุด',
            data: [],
            backgroundColor: [
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)',
                'rgba(255,255,0,0.3)'

            ],
            borderColor: [
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)',
                'rgba(255,255,0,1)'

            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script>

<?php
include ('includes/notification.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Money Manager</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="dist/output.css" rel="stylesheet"> -->
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="js/plugins/fullcalender/fullcalendar.css" rel="stylesheet">

     <!-- Datepicker CSS -->
     <link href="css/datepicker.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
            *{
  font-family: sans-serif;

  /* system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue',  */
}

#wrapper{
    position: relative;
}
/* Tùy chỉnh màu nền cho thanh navbar */
.navbar {
    background-color: #3498db; /* Đổi màu nền thành màu xanh dương, bạn có thể thay đổi mã màu tùy thích */
    border: none; /* Loại bỏ đường viền */
    margin-bottom: 0; /* Loại bỏ khoảng cách dưới thanh navbar */
    border-radius: 0; /* Loại bỏ góc bo tròn */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Đổ bóng nhẹ */
}


    </style>
<!-- Thêm thư viện js-cookie để quản lý cookie -->

     <script src="js/jquery-1.11.0.js"></script>
     <script src="js/plugins/metisMenu/metisMenu.js"></script>

</head>

<body>

    <div id="wrapper "  >

        <!-- Navigation -->
        <nav class="navbar navbar-static-top"  role="navigation" >
        <div class="headmain" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                      
              
                <!-- <a style="border-radius: 10px;" class="navbar-brand" href="index.php"><img class="logo" src="https://scontent.fsgn5-10.fna.fbcdn.net/v/t39.30808-6/305569612_470847148387982_6675724635697332367_n.png?_nc_cat=107&ccb=1-7&_nc_sid=5f2048&_nc_ohc=lO0kJPlyGEwAX_OwOHi&_nc_ht=scontent.fsgn5-10.fna&oh=00_AfC81-KnF96EmNzaCDPeKWtAG--4PSt1Y5W_YYYt6yHZtQ&oe=65326436" width="35" height="32" alt=""></a> -->
            <a  class="navbar-brand" href="">Money Manager</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
               
                    
                           


    <!-- <h1 data-lang="welcome">Welcome</h1>
    <p data-lang="dashboard">Dashboard</p>
    <p data-lang="settings">Settings</p> -->
                
                <li>
                    
                     <?php 
                    echo $Welcome;?>, 
                    <?php 
                    echo $ColUser['FirstName'];?>
                </li>
                
               
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li> <a <?php ActiveClass("index.php?page=Settings");?> href="index.php?page=Settings"><i class="fa fa-gear fa-fw"></i> <?php echo $Settings;?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="index.php?action=logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo $Logout;?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
                        

            <!-- /.navbar-top-links -->
        </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav font-sidebar" id="side-menu">
                      
                        <li>
                            <a <?php ActiveClass("index");?> href="index.php"><i class="glyphicon glyphicon-home"></i>  <?php echo $Dashboard;?><span ></a>
                        </li>
                        <li>
                            <a <?php ActiveClass("index.php?page=Transaction");?>  href="index.php?page=Transaction"><i class="glyphicon glyphicon-refresh"></i>  <?php echo $Transaction;?><span ></a>
                        </li>
                        <li>
                            <a <?php ActiveClass("index.php?page=AssetReport");?> href="index.php?page=AssetReport"><i class="glyphicon glyphicon-stats"></i>  <?php echo $Incomes;?><span ></span></a>
                        </li>
                        
                        <li>
                            <a <?php ActiveClass("index.php?page=ExpenseReport");?> href="index.php?page=ExpenseReport" ><i class="glyphicon glyphicon-list-alt"></i> <?php echo $Expenses;?><span ></span></a>
                        <li> 
                        <li>
                            <a <?php ActiveClass("index.php?page=Sotietkiem");?> href="index.php?page=Sotietkiem"><i class="glyphicon glyphicon-book"></i>  <?php echo $Sotietkiem;?><span ></span></a>
                        </li>   
                                <li>
                            <a <?php ActiveClass("index.php?page=ChartHanmuc");?> href="index.php?page=ChartHanmuc"><i class="glyphicon glyphicon-book"></i>  <?php echo $ChartHanmuc;?><span ></span></a>
                        </li> 
                                <li>
                                    <a <?php ActiveClass("index.php?page=ManageAccount");?> href="index.php?page=ManageAccount"> <i class="fa fa-tags"></i> <?php echo $Account;?><span ></a>
                                </li>
                         
                            <!-- /.nav-second-level -->
                    

                                    
                        </li>                           
                        </li>
                        <li><a <?php ActiveClass("index.php?page=ManageBudget");?> href="index.php?page=ManageBudget"><i class="fa fa-archive"></i> <?php echo $BudgetsM;?></a>
                        </li>
                        
                    <li>
                        <a class="parent" href="javascript:void(0)"><i class="fa fa-gears"> </i> <?php echo $Settings;?><span class="fa arrow"></a>
                        <ul class="nav nav-second-level" id="subitem">
                                <li>
                                    <a <?php ActiveClass("index.php?page=ManageExpenseCategory");?> href="index.php?page=ManageExpenseCategory"><i class="fa fa-caret-right"></i> <?php echo $CategoryExpense;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=ManageIncomeCategory");?> href="index.php?page=ManageIncomeCategory"><i class="fa fa-caret-right"></i> <?php echo $CategoryIncome;?></a>
                                </li>
                                
                        </ul>
                    </li>

                    <li>
                         <a class="parent" href="javascript:void(0)"><i class="fa fa-print"> </i> <?php echo $ReportsGraphs;?><span class="fa arrow"></a>
                         <ul class="nav nav-second-level" >
                                <li>
                                    <a <?php ActiveClass("index.php?page=IncomeVsExpense");?> id="subitem" href="index.php?page=IncomeVsExpense"><i class="fa fa-caret-right"> </i> <?php echo $IncomeVsExpense;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=IncomeCalender");?> id="subitem" href="index.php?page=IncomeCalender"><i class="fa fa-caret-right"> </i> <?php echo $IncomeCalender;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=ExpenseCalender");?> id="subitem" href="index.php?page=ExpenseCalender"><i class="fa fa-caret-right"> </i> <?php echo $ExpenseCalender;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=AllIncomeReports");?> id="subitem" href="index.php?page=AllIncomeReports"><i class="fa fa-caret-right"></i> <?php echo $IncomeReportsM ;?></a>
                                </li>
                                <li>
                                    <a <?php ActiveClass("index.php?page=AllExpenseReports");?> id="subitem" href="index.php?page=AllExpenseReports"><i class="fa fa-caret-right"></i> <?php echo $ExpenseReportsM;?></a>
                                </li>
                                
                        </ul>
                    </li> 
                       <li>
                            <a <?php ActiveClass("index.php?page=Settings");?> href="index.php?page=Settings"><i class="fa fa-user"> </i> <?php echo $ProfileSettings;?>    </a>
                        </li>
                        
                         <li>
                            <a href="index.php?action=logout"><i class="glyphicon glyphicon-log-out"></i>  <?php echo $Logout;?>    </a>
                        </li>
                    </ul>
                    <ul>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav >

<script>

$(document).ready(function () {
    $(this).parent().addClass("collapse");
    $(".parent").on('click', function () {
        $(this).parent().find("#subitem").slideToggle();
    });
});

</script>
      

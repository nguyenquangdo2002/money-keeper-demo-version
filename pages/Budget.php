        <!-- Page Content -->
        <!-- <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Budgets</h1>
                </div>
            </div>
            <div class="row">
                  <div class="col-lg-6 ">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Budget Settings
                        </div>
                            <div class="panel-body">
                                <form role="form">
                                    <fieldset>
                                    <div class="form-group pull-left">
                                        <label for="name">Category</label>
                                        <select name="month" class="form-control">
                                            <option>January</option>
                                          </select>
                                    </div>
                                    <div class="form-group pull-right">
                                         <label for="amount">Amount</label>
                                        <input class="form-control" required placeholder="amount" width="10" name="amount" type="text" value="">
                                   </div>
                                   <hr class="clearbothh">
                                  
                                   <div class="form-group pull-left clearbothh">
                                        <label for="month">Month</label>
                                        <select name="month" class="form-control">
                                            <option>January</option>
                                            <option>February</option>
                                            <option>March</option>
                                            <option>April</option>
                                            <option>May</option>
                                            <option>June</option>
                                            <option>July</option>
                                            <option>August</option>
                                            <option>September</option>
                                            <option>October</option>
                                            <option>November</option>
                                            <option>December</option>
                                        </select>
                                    </div>
                                    <div class="form-group pull-left">
                                         <label for="year">Year</label>
                                        <select name="year" class="form-control">
                                            <option></option>
                                            <option>2014</option>
                                            <option>2015</option>
                                            <option>2016</option>
                                        </select>
                                   </div>
                                   
                                                              
                                </fieldset>
                                </form>
                            </div>
                            <div class="panel-footer">
                            <button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-log-in"></span>  Save Budget</button>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-5">
                <div class="panel panel-green">
                        <div class="panel-heading">
                            Budget based on Graph
                        </div>
                        <div class="panel-body">
                            <p>Please add your budget with your category and for month and year </p>
                        </div>
                        <div class="panel-footer">
                           
                        </div>
                    </div>
                </div>   
            </div>

        </div>
 

  
 -->
<?php
//  Budget Progress
$Getbudgets = "SELECT AmountIncome As Amount, (AmountIncome - AmountExpense) As Totals, AmountExpense/(AmountIncome - AmountExpense) * 100/100 AS Per,CategoryName
					  FROM ( SELECT  UserId,CategoryId, 
                      SUM(Amount) AS AmountExpense
                      FROM bills
				      GROUP BY CategoryId) AS b
					  LEFT JOIN ( SELECT  CategoryId,
                      SUM(Amount) AmountIncome
				      FROM budget WHERE MONTH(Dates) = MONTH (CURRENT_DATE())
					  GROUP BY CategoryId) AS a ON b.CategoryId = a.CategoryId
                      LEFT JOIN (SELECT CategoryId, CategoryName 
                      FROM category
                      GROUP BY CategoryId) AS c
					  ON b.CategoryId = c.CategoryId WHERE b.UserId = $UserId";
$Budgets = mysqli_query($mysqli, $Getbudgets);


?>
<div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $BudgetProgressOn ;?> <b><?php echo date("F Y");?></b>
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">   
                                <div class="col-lg-12">
									<?php while($BudgetCols =mysqli_fetch_assoc($Budgets)) { 
										
										// calculate out expense
										$Out	= ($BudgetCols['Amount'] - $BudgetCols['Totals']);
										
										$Exceed = Percentages($BudgetCols['Per']/$Out).' %';

										if($Exceed<0 OR $Exceed >100){
												$Exceed = '<label class="label label-danger">Over Budget</label>';
												
											}else{
                                                $Exceed = 100*$BudgetCols['Per']/$Out.' %';
                                            }
										
										?>
											<div>
											<p>
                                                 
												<label class="label label-info"><?php echo $BudgetCols['CategoryName'];?></label> 
												<span class="pull-right text-muted"><?php echo $Budgetss;?> <?php echo $ColUser['Currency'].' '.number_format($BudgetCols['Amount']);?></span>
											</p>
											
											<div class="text-right panel panel-yellow"><div class="panel-heading"><?php echo $Outs;?>: <?php echo $ColUser['Currency'].' '.number_format($Out);?> <?php echo $RemainingBudget;?>: <?php echo $ColUser['Currency'].' '.number_format($BudgetCols['Totals']);?></div></div><br/>
										</div>
										<?php } ?>
                                </div>
                                <div class="text-center"></div>
                                <!-- /.col-lg-4 (nested) -->
                                
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>


                    -----------------------------------------------------------------------------------fa-border

                     <?php

//Include Functions
include('includes/Functions.php');

//Include Notifications
include ('includes/notification.php');

// add new budget

//Edit budget

//delete budget



?>
<?

	
	
?>

       
				
              
 
<!-- //  Budget Progress
// $Getbudgets = "SELECT AmountIncome As Amount, (AmountIncome - AmountExpense) As Totals, AmountExpense/(AmountIncome - AmountExpense) * 100/100 AS Per,CategoryName
// 					  FROM ( SELECT  UserId,CategoryId, 
//                       SUM(Amount) AS AmountExpense
//                       FROM bills
// 				      GROUP BY CategoryId) AS b
// 					  LEFT JOIN ( SELECT  CategoryId,
//                       SUM(Amount) AmountIncome
// 				      FROM budget WHERE MONTH(Dates) = MONTH (CURRENT_DATE())
// 					  GROUP BY CategoryId) AS a ON b.CategoryId = a.CategoryId
//                       LEFT JOIN (SELECT CategoryId, CategoryName 
//                       FROM category
//                       GROUP BY CategoryId) AS c
// 					  ON b.CategoryId = c.CategoryId WHERE b.UserId = $UserId";
// $Budgets = mysqli_query($mysqli, $Getbudgets);

// $Getbudgets = "SELECT b.BudgetId, b.CategoryId, b.Dates, b.Amount, c.CategoryName from budget b, category c WHERE YEAR(Dates) = $Year  AND MONTH(Dates) = $Month AND b.UserId = $UserId AND c.CategoryId = b.CategoryId";
// $Budgets = mysqli_query($mysqli, $Getbudgets); -->
   
<!--            
            <div class="row">
                
<?php
// history budget
$Year 	= date("Y");
$Month  = date("m");
$Getbudgets = "SELECT b.BudgetId, b.CategoryId, b.Dates, b.Amount, c.CategoryName from budget b, category c WHERE YEAR(Dates) = $Year  AND MONTH(Dates) = $Month AND b.UserId = $UserId AND c.CategoryId = b.CategoryId";
$Budgets = mysqli_query($mysqli, $Getbudgets);

//Include Global page
	include ('includes/global.php');
$budgetData = array();

while ($BudgetCols = mysqli_fetch_assoc($Budgets)) {
    $budgetData[] = array(
        "CategoryName" => $BudgetCols['CategoryName'],
        "Amount" => $BudgetCols['Amount']
    );
}
?>
<head>
    <style>
        .panel-body{
            max-width: 100rem;
            max-width: 40rem;

        }
        /* .panel-success{
            max-width: 120rem;
            margin-left: 2rem;
            max-height: 60rem;
            display:flex; align-items: center;
        } */
    </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

</head>
<body>
    <div class="panel panel-success" style="width: 46rem; height: 40rem;display:flex; align-items: center;">
    <div class="panel-heading">
        <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $BudgetProgressOn ;?> <b><?php echo date("F Y");?></b>
    </div>
    <div class="panel-body" style="width: 46rem;">
        <div class="row">   
            <div class="col-lg-12" s>
                <canvas id="budgetPieChart" width="300" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // Tạo dữ liệu cho biểu đồ hình tròn
    var data = {
        labels: <?php echo json_encode(array_column($budgetData, 'CategoryName')); ?>,
        datasets: [{
            data: <?php echo json_encode(array_column($budgetData, 'Amount')); ?>,
            backgroundColor: [
                'red',
                'green',
                'blue',
                'orange',
                'purple',
                'pink'
                // Thêm màu sắc khác tùy ý cho các hạn mức khác
            ]
        }]
    };

    var ctx = document.getElementById('budgetPieChart').getContext('2d');

    // Tạo biểu đồ hình tròn
    var budgetPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Budgets Pie Chart'
            }
        }
    });
</script>

</body>





 -->
<?php

$msgBox='';


// Get all Income
$GetAllIncome 	 = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId";
$GetAIncome		 = mysqli_query($mysqli, $GetAllIncome);
$IncomeCol 		 = mysqli_fetch_assoc($GetAIncome);


// Get all Expense
$GetAllExpense   = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId";
$GetAExpense         = mysqli_query($mysqli, $GetAllExpense);
$ExpenseCol          = mysqli_fetch_assoc($GetAExpense);

//Count current totals Income
$CountTotals = $IncomeCol['Amount'] - $ExpenseCol['Amount'];

//Get Recent Income History
$GetIncomeHistory = "SELECT * from assets left join category on assets.CategoryId = category.CategoryId left join account on assets.AccountId = account.AccountId where assets.UserId = $UserId ORDER BY assets.Date DESC LIMIT 10";
$IncomeHistory = mysqli_query($mysqli,$GetIncomeHistory); 

//Get Recent Expense History
$GetExpenseHistory = "SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = $UserId ORDER BY bills.Dates DESC LIMIT 10";
$ExpenseHistory = mysqli_query($mysqli,$GetExpenseHistory); 


// Get all by month Income
$GetAllIncomeDate 	 = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND MONTH(Date) = MONTH (CURRENT_DATE())";
$GetAIncomeDate		 = mysqli_query($mysqli, $GetAllIncomeDate);
$IncomeColDate 		 = mysqli_fetch_assoc($GetAIncomeDate);

// Get all by month Expense
$GetAllExpenseDate 	 = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND MONTH(Dates) = MONTH (CURRENT_DATE())";
$GetAExpenseDate		 = mysqli_query($mysqli, $GetAllExpenseDate);
$ExpenseColDate 		 = mysqli_fetch_assoc($GetAExpenseDate);


// Budget Progress
$Getbudgets = "SELECT AmountIncome As Amount, (AmountIncome - AmountExpense) As Totals, AmountExpense/(AmountIncome - AmountExpense) * 100/100 AS Per,CategoryName
					  FROM ( SELECT  UserId,CategoryId, 
                      SUM(Amount) AS AmountExpense
                      FROM bills
				      GROUP BY CategoryId) AS b
					  LEFT JOIN ( SELECT  CategoryId,
                      SUM(Amount) AmountIncome
				      FROM budget WHERE MONTH(Dates) = MONTH (CURRENT_DATE())
					  GROUP BY CategoryId) AS a ON b.CategoryId = a.CategoryId
                      LEFT JOIN (SELECT CategoryId, CategoryName 
                      FROM category
                      GROUP BY CategoryId) AS c
					  ON b.CategoryId = c.CategoryId WHERE b.UserId = $UserId";
$Budgets = mysqli_query($mysqli, $Getbudgets);


//Include Global page
	include ('includes/global.php');
?>

        <div id="page-wrapper" >
            
            <!-- /.row -->
            <div class="row ">
                
                
                
                
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    
                    <!-- /.panel -->
                    
                    <!-- /.panel -->
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $BudgetProgressOn ;?> <b><?php echo date("F Y");?></b>
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?php while($BudgetCols =mysqli_fetch_assoc($Budgets)) { 
										
										// calculate out expense
										$Out	= ($BudgetCols['Amount'] - $BudgetCols['Totals']);
										
										$Exceed = Percentages($BudgetCols['Per']/$Out).' %';

										if($Exceed<0 OR $Exceed >100){
												$Exceed = '<label class="label label-danger">Over Budget</label>';
												
											}else{
                                                $Exceed = 100*$BudgetCols['Per']/$Out.' %';
                                            }
										
										?>
											<div>
											<p>
                                                 
												<label class="label label-info"><?php echo $BudgetCols['CategoryName'];?></label> 
												<span class="pull-right text-muted"><?php echo $Budgetss;?> <?php echo $ColUser['Currency'].' '.number_format($BudgetCols['Amount']);?></span>
											</p>
											
											<div class="text-right panel panel-yellow"><div class="panel-heading"><?php echo $Outs;?>: <?php echo $ColUser['Currency'].' '.number_format($Out);?> <?php echo $RemainingBudget;?>: <?php echo $ColUser['Currency'].' '.number_format($BudgetCols['Totals']);?></div></div><br/>
										</div>
										<?php } ?>
                                </div>
                                <div class="text-center"></div>
                                <!-- /.col-lg-4 (nested) -->
                                
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                   
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                 <div class="panel panel-red">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $TenExpense;?>
                            
                        </div>
                        <!-- /.panel-heading -->
                        
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->   
                    <!-- /.panel -->
                    
                    <div class="panel panel-info" style="width: 60rem; height: 45rem; margin-top: 150px;">
                        <div class="panel-heading" >
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $ReportsExpenseIncome ;?>
                        </div>
                        <div class="panel-body" style="width: 40rem; height: 20rem; margin-left: 10rem;">
                           <canvas id="budgetPieChart"></canvas>
                            
                        </div>
                        </div>
                    <!-- /.panel -->
                   
                   <!-- /.panel -->
                    
                    <!-- /.panel -->
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->



</body>

</html>
<?php
// history budget
$Year 	= date("Y"); 
$Month  = date("m");
$Getbudgets = "SELECT b.BudgetId, b.CategoryId, b.Dates, b.Amount, c.CategoryName from budget b, category c WHERE YEAR(Dates) = $Year  AND MONTH(Dates) = $Month AND b.UserId = $UserId AND c.CategoryId = b.CategoryId";
$Budgets = mysqli_query($mysqli, $Getbudgets);

//Include Global page
$budgetData = array();

while ($BudgetCols = mysqli_fetch_assoc($Budgets)) {
    $budgetData[] = array(
        "CategoryName" => $BudgetCols['CategoryName'],
        "Amount" => $BudgetCols['Amount']
    );
}
?>
<head>
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

</head>
<body>


<script>
    // Tạo dữ liệu cho biểu đồ hình tròn
var data = {
    labels: <?php echo json_encode(array_column($budgetData, 'CategoryName')); ?>,
    datasets: [{
        data: <?php echo json_encode(array_column($budgetData, 'Amount')); ?>,
        backgroundColor: [
            '#FF4040',
            '#FFD39B',
            '#98F5FF',
            '#7FFF00',
            '#FF7F24',
            '#FF7256',
            '#6495ED',
            '#FFF8DC',
            '#FFB90F',
            '#00FFFF',
            '#CAFF70',
            '#8B008B',
            '#FFD700',
            '#030303'
        ]
    }]
};





    var ctx = document.getElementById('budgetPieChart').getContext('2d');

    // Tạo biểu đồ hình tròn
    var budgetPieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Budgets Pie Chart'
            }
        }
    });
</script>

</body>
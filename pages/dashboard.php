 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
 <script src="sweetalert2.all.min.js"></script>
 <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    
    Swal.fire({
  title: 'Error!',
  text: 'Do you want to continue',
  icon: 'error',
  confirmButtonText: 'Cool'
})
 </script>
 
<?php

$msgBox='';
//Include Functions
include('includes/Functions.php');

//Include Notifications
include ('includes/notification.php');

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

// Now, you can use the modified $Budgets query results in the provided HTML code.


//Include Global page
	include ('includes/global.php');
?>
<!-- background-color: #0f172a; -->
        <div id="page-wrapper"  >
            <div class="row">
                <div class="col-lg-12">
                    <h1 class=""><?php echo $Dashboard;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row ">
                <div class="col-lg-3 col-md-6">
                    <div class="panel-red" >
                            <div class="panel-heading " style="border-radius:10px; background-color: #DC143C;">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-calendar fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2><?php echo $ColUser['Currency'].' '.number_format($ExpenseColDate['Amount']); ?></h2>
                                    <div><?php echo $CurrentExpense;?></div>
                                </div>
                            </div>
                        </div>  
                        <!-- <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel-primary">
                        <div class="panel-heading " style="border-radius:10px; background-color: #00688B;">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-calendar fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2><?php echo $ColUser['Currency'].' '.number_format($IncomeColDate['Amount']); ?></h2>
                                    <div><?php echo $CurrentIncome;?></div>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel-red">
                        <div class="panel-heading" style="border-radius:10px; background-color: #8B2252;">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="glyphicon glyphicon-resize-full fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2><?php echo $ColUser['Currency'].' '.number_format($ExpenseCol['Amount']);?> </h2>
                                    <div><?php echo $TotalExpenseDashboard;?></div>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel-yellow">
                        <div class="panel-heading" style="border-radius:10px; background-color: #9ACD32;">
                            <div class="row">
                                <div class="col-xs-1">
                                    <i class="glyphicon glyphicon-resize-small fa-4x"></i>
                                </div>
                                <div class="col-xs-12 text-left">
                                    <h2><?php echo $ColUser['Currency'].' '.number_format($CountTotals);?> </h2>
                                    <div><?php echo $CurrentBalance;?></div>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"></span>
                                <span class="pull-right"></span>
                                <div class="clearfix"></div>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>





    <div class="row">
                <div class="col-lg-12 col-md-12">

                        <?php include("pages/ChartThuchi.php")?>
                </div>

            </div>

            <!-- /.row -->
            
                    <!-- /.panel -->   
                    <!-- /.panel -->
                    <style>
/* Sử dụng media query để làm cho biểu đồ responsive */
@media screen and (max-width: 1080px) {
    #aaa {
       margin-top: 300px;
         /* Điều chỉnh kích thước chiều rộng để đảm bảo nó đầy đủ trên mọi thiết bị nhỏ hơn hoặc bằng 768px */
    }
    
}
@media screen and (max-width: 700px) {
    #aaa {
       margin-top: 210px;
         /* Điều chỉnh kích thước chiều rộng để đảm bảo nó đầy đủ trên mọi thiết bị nhỏ hơn hoặc bằng 768px */
    }
    
}
@media screen and (max-width: 500px) {
    #aaa {
        margin-top: 150px;
         /* Điều chỉnh kích thước chiều rộng để đảm bảo nó đầy đủ trên mọi thiết bị nhỏ hơn hoặc bằng 768px */
    }
    
}
</style>
                        <div class="row" id="aaa">
                <div class="col-lg-6 ">
                    <div  class="panel panel-primary rounded-lg" style="width:100%; border:none;height: 45rem;margin-top : 150px ; background-color:#f9f9f9; ">
                        <div class="panel-heading" style=" font-weight:bold; width: 100%;">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo "Biểu đồ hạn mức" ;?> <?php echo date("F Y");?>
                        </div>
                        <div class="panel-body" style="width: 40rem; height: 20rem; margin-left: 10rem;">
                           <canvas id="budgetPieChart"></canvas>
                            
                        </div>
                        </div>
                        </div>
                <div class="col-lg-6">

                        <div class="panel panel-info" style="width:100%; border:none;height: 45rem;margin-top : 150px ; background-color:#f9f9f9;">
                        <div class="panel-heading" style=" font-weight:bold; width: 100%;">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo "Biểu đồ tài khoản ví" ;?>
                        </div>
                        <div class="panel-body" style="width: 40rem; height: 20rem; margin-left: 10rem;">
                           <canvas id="accountBalancePieChart" width="400" height="400"></canvas>
                            
                        </div>
                        </div>
                        </div>
                         
                        </div>
                    <!-- <div class="panel panel-primary"> -->
                        <!-- <div class="panel-heading">
                           
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $TenIncome;?>
                            
                        </div> -->
                        <!-- /.panel-heading -->
                        <!-- <div class="panel-body">
                           <div>
								<div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $Title;?></th>
                                                    <th><?php echo $Date;?></th>
                                                    
                                                    <th><?php echo $Account;?></th>
                                                    
                                                    <th><?php echo $Amount;?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php while($col = mysqli_fetch_assoc($IncomeHistory)){ ?>
												<tr>
													<td><?php echo $col['Title'];?></td>
													<td><?php echo date("M d Y",strtotime($col['Date']));?></td>
													
													<td><?php echo $col['AccountName'];?></td>
													
													<td><?php echo $ColUser['Currency'].' '.number_format($col['Amount']);?></td>
                                                </tr>
                                               <?php } ?>   
                                            </tbody>
                                        </table>
								</div>
                           <div class="text-center"><a href="index.php?page=AssetReport"><?php echo $ViewDetails;?></a></div>
                           </div>
                        </div> -->
                        <!-- /.panel-body -->
                    <!-- </div> -->
                    
                    <div class="row">

                    <!-- /.panel budgeeeeeeeeeeeeet -->
                    <div class="col-lg-6">
<div class="panel  panel-primary" style="border-radius: 10px 10px 1px 1px;" >
    <div class="panel-heading" style="border-radius: 10px 10px 1px 1px; font-weight:bold;">
        <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $BudgetProgressOn ;?> <b><?php echo date("F Y");?></b>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <?php $alertMessages = array(); // Array to store alert messages
                while($BudgetCols = mysqli_fetch_assoc($Budgets)) { 
                    $hanmuc =$BudgetCols['Totals'];
                    // Calculate the amount over budget
                    $Out = ($BudgetCols['Amount'] - $BudgetCols['Totals']);
                    $ExceedPercentage = 100 * $BudgetCols['Per'] / $Out;
                    $ExceedLabel = '';

                    if ($ExceedPercentage < 0) {
        $ExceedLabel = '<label class="label label-danger">Vượt quá hạn mức</label>';
    // $alertMessages[] = 'Budget for '.$BudgetCols['CategoryName'].' is over.';
        // Display both the native JavaScript alert and SweetAlert
        // echo '<script>alert("Budget for '.$BudgetCols['CategoryName'].' is over.");</script>';
    
            
            
    } else if ($hanmuc > 900000 ) {
                        $ExceedLabel = '<label class="label label-success">Hạn mức rất tốt</label>';
                    }else if ($hanmuc > 700000 ) {
                        $ExceedLabel = '<label class="label label-success">Hạn mức ổn</label>';
                    }else if ($hanmuc > 500000 ) {
                        $ExceedLabel = '<label class="label label-success">Hạn mức ổn</label>';
                    }else if ($hanmuc < 300000 ) {
                        $ExceedLabel = '<label class="label label-warning">Hạn mức sắp đạt ngưỡng</label>';
                    }
      
                     
                    
                    if (!empty($alertMessages)) {
    echo '<script>
        Swal.fire({
            title: "Error!",
            html: "'.implode('<br>', $alertMessages).'<br>Do you want to continue?",
            icon: "error",
            confirmButtonText: "Cool"
        });
    </script>';
}
                    ?>
                    <div>
                    <p>
                        <label class="label label-info"><?php echo $BudgetCols['CategoryName'];?></label> 
                        <span class="pull-right text-muted"><?php echo $Budgetss;?> <?php echo $ColUser['Currency'].' '.number_format($BudgetCols['Amount']);?></span>
                    </p>
                    
                    <div class="text-right panel panel-yellow">
                        <div class="panel-heading">
                            <?php echo $Outs;?>: <?php echo $ColUser['Currency'].' '.number_format($Out);?>
                            <?php echo $RemainingBudget;?>: <?php echo $ColUser['Currency'].' '.number_format($BudgetCols['Totals']);?>
                            <?php echo $ExceedLabel; ?>
                        </div>
                    </div><br/>
                </div>
                <?php } ?>
            </div>
            <div class="text-center"></div>
            <!-- /.col-lg-4 (nested) -->
            
            <!-- /.col-lg-8 (nested) -->
        </div>
        <!-- /.row -->
    </div>
</div>
</div>
    <!-- /.panel-body -->
                    <!-- /.panel ACCOUNT -->

                        <div class="col-lg-6">
                    <div class="panel panel-info" style="border-radius: 10px 10px 1px 1px;">
    <div class="panel-heading" style="border-radius: 10px 10px 1px 1px; font-weight: bold;">
        <i class="fa fa-bar-chart-o fa-fw"></i> Account Balance
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Account Name</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Create an array to store account data
                            $accountData = array();
                            while ($col = mysqli_fetch_assoc($Dount)) {
                                $accountData[] = array(
                                    "AccountName" => $col['AccountName'],
                                    "Amount" => $col['Amount'],
                                    "Currency" => $ColUser['Currency']
                                );
                            ?>
                                <tr>
                                    <td><?php echo $col['AccountName']; ?></td>
                                    <td class="text-right"><?php echo $ColUser['Currency'] . ' ' . number_format($col['Amount']); ?></td>
                                </tr>
                            <?php
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
   <!-- acccccoutttttttttttttttttttttttttttttttttttttttttt-->
</div>

                    <!-- /.panel -->
                   
                   
               
                <!-- /.col-lg-8 -->
                <!-- <div class="col-lg-6"> -->
                 <!-- <div class="panel panel-red">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $TenExpense;?>
                            
                        </div> -->
                        <!-- /.panel-heading -->
                        <!-- <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                                <tr>
                                                    <th><?php echo $Title;?></th>
                                                    <th><?php echo $Date;?></th>
                                                    
                                                    <th><?php echo $Account;?></th>
                                                    
                                                    <th><?php echo $Amount;?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php while($cols = mysqli_fetch_assoc($ExpenseHistory)){ ?>
                                                <tr>
                                                    <td><?php echo $cols['Title'];?></td>
                                                    <td><?php echo date("M d Y",strtotime($cols['Dates']));?></td>
                                                    
                                                    <td><?php echo $cols['AccountName'];?></td>
                                                    
                                                    <td><?php echo $ColUser['Currency'].' '.number_format($cols['Amount']);?></td>
                                                </tr>
                                               <?php } ?>   
                                            </tbody>
                                        </table>
                                    </div>
                                    /.table-responsive -->
                                </div>
                                <!-- <div class="text-center"><a href="index.php?page=ExpenseReport"><?php echo $ViewDetails;?></a></div> -->
                                <!-- /.col-lg-4 (nested) -->
                                
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                        <!-- /.panel-body -->
                     
                    <!-- /.panel -->
                   
                   <!-- /.panel -->
                    <!-- <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> <?php echo $ReportsExpenseIncomeM ;?>
                        </div>
                        <div class="panel-body">
                            <div id="incomevsexpensemonth">
								
                            </div>
                            
                        </div>
                        </div> -->
                        <!-- /.panel-body -->
                    
                    <!-- /.panel -->
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

   <!-- <script>


    $(function() {
		 		
		Morris.Donut({
        element: 'incomevsexpense',
        data: [
			
			{
            label: "<?php echo 'Expense '.$ColUser['Currency'];?>",
            value: <?php  echo $colsDounat['AmountExpense'] ;?>
			},
			{
            label: "<?php echo 'Income '.$ColUser['Currency'];?>",
            value: <?php  echo $colsDounat['AmountIncome'] ;?>
			},		
        ],
        resize: true
		});
		
		Morris.Donut({
        element: 'incomevsexpensemonth',
        data: [
			
			{
            label: "<?php echo 'Expense '.$ColUser['Currency'];?>",
            value: <?php  echo $ColsDounatMonth['AmountExpense'] ;?>
			},
			{
            label: "<?php echo 'Income '.$ColUser['Currency'];?>",
            value: <?php  echo $ColsDounatMonth['AmountIncome'] ;?>
			},		
        ],
        resize: true
    });
     $('.notification').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    });
    </script> -->
   

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
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>



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
        type: 'doughnut', // Sử dụng loại biểu đồ doughnut
        data: data,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Budgets Doughnut Chart'
            },
            cutout: 70 // Điều chỉnh phần trăm lỗ giữa hình tròn tại đây
        }
    });
</script>



<script>
    var accountNames = <?php echo json_encode(array_column($accountData, 'AccountName')); ?>;
    var accountAmounts = <?php echo json_encode(array_column($accountData, 'Amount')); ?>;
    var accountCurrency = '<?php echo $ColUser['Currency']; ?>';

    var accountBalanceData = {
        labels: accountNames,
        datasets: [{
            data: accountAmounts,
            backgroundColor: ['#6495ED',
            '#FFB90F',
            '#00FFFF',
            '#CAFF70',
            '#8B008B',
            '#FFD700',
            '#030303'] // You can customize colors
        }]
    };

    var accountBalanceCtx = document.getElementById('accountBalancePieChart').getContext('2d');

    var accountBalancePieChart = new Chart(accountBalanceCtx, {
        type: 'doughnut',
        data: accountBalanceData,
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Account Balance Doughnut Chart (' + accountCurrency + ')'
            },
            cutout: 70 // Điều chỉnh giá trị cutoutPercentage ở đây để điều chỉnh kích thước của lỗ giữa hình tròn
        }
    });
</script>



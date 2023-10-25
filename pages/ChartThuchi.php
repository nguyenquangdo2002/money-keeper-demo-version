<script src="">
    import Chart from "chart.js";
</script>

<?
//Include Functions
include('includes/Functions.php');

//Include Notifications
include ('includes/notification.php');
?>

<?php
//Include Global page
	include ('includes/global.php');

// Get all  Income
$GetAllIncomeOverall    = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId" ;
$GetAIncomeOverall      = mysqli_query($mysqli, $GetAllIncomeOverall);
$IncomeColOverall       = mysqli_fetch_assoc($GetAIncomeOverall);
$IncomeOverall          = $IncomeColOverall['Amount'];
	
// Get all by month Income
$GetAllIncomeDate    = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND MONTH(Date) = MONTH (CURRENT_DATE())";
$GetAIncomeDate      = mysqli_query($mysqli, $GetAllIncomeDate);
$IncomeColDate       = mysqli_fetch_assoc($GetAIncomeDate);
$IncomeThisMonth     = $IncomeColDate['Amount'];

// Get all by today Income
$GetAllIncomeDateToday       = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND Date = CURRENT_DATE()";
$GetAIncomeDateToday         = mysqli_query($mysqli, $GetAllIncomeDateToday);
$IncomeColDateToday          = mysqli_fetch_assoc($GetAIncomeDateToday);
$IncomeToday                 = $IncomeColDateToday['Amount'];

// Get all Expense
$GetAllBillsOverall    = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId ";
$GetABillsOverall      = mysqli_query($mysqli, $GetAllBillsOverall);
$BillsColOverall       = mysqli_fetch_assoc($GetABillsOverall);
$BillsOverall          = $BillsColOverall['Amount'];

// Get all by month Expense
$GetAllBillsDate    = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND MONTH(Dates) = MONTH (CURRENT_DATE())";
$GetABillsDate      = mysqli_query($mysqli, $GetAllBillsDate);
$BillsColDate       = mysqli_fetch_assoc($GetABillsDate);
$BillThisMonth      = $BillsColDate['Amount'];

// Get all by today Expense
$GetAllBillsToday           = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND Dates = CURRENT_DATE()";
$GetABillsDateToday         = mysqli_query($mysqli, $GetAllBillsToday);
$BillsColDateToday          = mysqli_fetch_assoc($GetABillsDateToday);
$BillToday              	= $BillsColDateToday['Amount'];



// Get all by this week Income
$GetAllIncomeThisWeek = "SELECT SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND WEEK(Date) = WEEK(CURRENT_DATE())";
$GetAIncomeThisWeek = mysqli_query($mysqli, $GetAllIncomeThisWeek);
$IncomeColThisWeek = mysqli_fetch_assoc($GetAIncomeThisWeek);
$IncomeThisWeek = $IncomeColThisWeek['Amount'];

// Get all by this week Expense
$GetAllBillsThisWeek = "SELECT SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND WEEK(Dates) = WEEK(CURRENT_DATE())";
$GetABillsThisWeek = mysqli_query($mysqli, $GetAllBillsThisWeek);
$BillsColThisWeek = mysqli_fetch_assoc($GetABillsThisWeek);
$BillThisWeek = $BillsColThisWeek['Amount'];
//Get Recent Income History
$GetIncomeHistory = "SELECT * from assets left join category on assets.CategoryId = category.CategoryId left join account on assets.AccountId = account.AccountId where assets.UserId = $UserId ORDER BY assets.Date DESC LIMIT 10";
$IncomeHistory = mysqli_query($mysqli,$GetIncomeHistory); 

//Get Recent Expense History
$GetExpenseHistory = "SELECT * from bills left join category on bills.CategoryId = category.CategoryId left join account on bills.AccountId = account.AccountId where bills.UserId = $UserId ORDER BY bills.Dates DESC LIMIT 10";
$ExpenseHistory = mysqli_query($mysqli,$GetExpenseHistory);


?>
<!DOCTYPE html>
<html>
<head>
  <title>Income and Expense</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  
</head>

<style>
  
    #canvastoday{
      top: 60px;
      margin-left: 2rem;
        max-height: 35rem;
        position: absolute; 
        
    }
    #canvasmonth{
        position: absolute; 
            top: 60px;

        margin-left: 2rem;
        max-height: 35rem;
    }
    #canvasweek{
      margin-left: 2rem;
        position: absolute; 
            top: 60px;

        
        max-height: 35rem;
    }
    #canvasall{
      margin-left: 2rem;
        position: absolute; 
          top: 60px;

        
        max-height: 35rem;
    }
    #canvasAll{
        display: flex;
       margin-bottom: 30rem;
        position: relative;
    }
    .selectChart{
        gap: 2rem;
        display: flex; 
        margin-left: 10rem;
        align-items: center;
        position: absolute; 
       top: 10px;
    }
    .selectChart button {
      font-weight:600;
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  background-color: #3498db; /* Màu nền */
  color: #fff; /* Màu chữ */
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin: 5px;
  transition: background-color 0.3s; /* Hiệu ứng khi di chuột qua nút */
}

.selectChart button:hover {
  background-color: #2980b9; /* Màu nền khi di chuột qua */
}
@media screen and (max-width: 1089px) {
  .selectChart{
        gap: 0rem;
        display: flex; 
        margin-left: 0rem;
        align-items: center;
        position: absolute; 
       top: 0px;
    }
  .selectChart button {
    padding: 2px; /* Điều chỉnh lề trong khi giữ kích thước nút tương đối */
    font-size: 12px; /* Giảm kích thước chữ */
  }
}
@media screen and (max-width: 740px) {
  .selectChart{
        gap: 0rem;
        display: flex; 
        margin-left: 0rem;
        align-items: center;
        position: absolute; 
       top: 0px;
    }
  .selectChart button {
    padding: 2px; /* Điều chỉnh lề trong khi giữ kích thước nút tương đối */
    font-size: 12px; /* Giảm kích thước chữ */
  }
}
@media screen and (max-width: 340px) {
  .selectChart{
        gap: 0rem;
        display: flex; 
        margin-left: 0rem;
        align-items: center;
        position: absolute; 
       top: 0px;
    }
  .selectChart button {
    padding: 0px; /* Điều chỉnh lề trong khi giữ kích thước nút tương đối */
    font-size: 12px; /* Giảm kích thước chữ */
  }
}
</style>

  
<body>
  <div id="canvasAll">
    <canvas id="canvastoday"></canvas>
    <canvas id="canvasweek"></canvas>
    <canvas id="canvasmonth"></canvas>
    <canvas id="canvasall"></canvas>
</div>

    <!-- <div class="selectChart">
        <button onclick="timeFrame(this)" type="submit" id="todayChart" value="charttoday">today</button>
    <button  onclick="timeFrame(this)" type="submit" id="weekChart" value="chartweek">week</button>
    <button   onclick="timeFrame(this)" type="submit" id="monthChart" value="chartmonth">month</button>
    <button  onclick="timeFrame(this)" type="submit" id="allChart" value="all">all</button>
    </div> -->
    <div class="selectChart">
        <button onclick="showCharttoday()" type="submit" id="todayChart" value="charttoday">Xem thu chi hôm nay</button>
    <button  onclick="showChartweek()" type="submit" id="weekChart" value="chartweek">Xem thu chi tuần này</button>
    <button   onclick="showChartmonth()" type="submit" id="monthChart" value="chartmonth">Xem thu chi tháng này</button>
    <button  onclick="showChartall()" type="submit" id="allChart" value="chartall">Xem tất cả thu nhập&chi tiêu</button>
    </div>

<script>
     // Lấy các thẻ canvas biểu đồ
const chartToday = document.getElementById("canvastoday");
const chartWeek = document.getElementById("canvasweek");
const chartMonth = document.getElementById("canvasmonth");
const chartAll = document.getElementById("canvasall");

// Ẩn tất cả các biểu đồ
function hideAllChart() {
  chartWeek.style.display = "none";
  chartMonth.style.display = "none";
  chartAll.style.display = "none";
}

// Hiển thị biểu đồ 'charttoday' và gọi hàm today()
function showCharttoday() {
  hideAllChart();
  chartToday.style.display = "block";

  today();
}

// Hiển thị biểu đồ 'chartweek' và gọi hàm week()
function showChartweek() {
  hideAllChart();
  chartWeek.style.display = "block";
  chartToday.style.display = "none";

  week();
}

// Hiển thị biểu đồ 'chartmonth' và gọi hàm month()
function showChartmonth() {
  hideAllChart();
  chartMonth.style.display = "block";
  chartToday.style.display = "none";

  month();
}

// Hiển thị biểu đồ 'chartall' và gọi hàm all()
function showChartall() {
  hideAllChart();
  chartAll.style.display = "block";
  chartToday.style.display = "none";

  all();
}

// Mặc định hiển thị biểu đồ 'charttoday' khi trang tải lên
window.onload = function() {
  showChartweek();
};

</script>
<script>
// Tạo dữ liệu cho biểu đồ
function today(){
  
        const datatoday = {
  labels: ["Thu nhập và Chi tiêu HÔM NAY"],
  datasets: [
    {
      label: "Income",
      data: [<?php echo $IncomeToday; ?>],
      backgroundColor: "rgba(75, 192, 192, 0.7)",
      borderColor: "rgba(75, 192, 192, 1)",
      borderWidth: 1,
    },
    {
      label: "Expense",
      data: [<?php echo $BillToday; ?>],
      backgroundColor: "rgba(255, 99, 132, 0.7)",
      borderColor: "rgba(255, 99, 132, 1)",
      borderWidth: 1,
    },
  ],
};

// Tạo biểu đồ
const chartoday = new Chart(document.getElementById("canvastoday"), {
  type: "bar",
  data: datatoday,
  options: {
    responsive: true,
    title: {
      display: true,
      text: "Income and Expense",
    },
  },
});
}


  </script>
  
  <script>
    function month(){
        // Đặt mã ở đây nếu bạn muốn thực hiện một hành động nào đó khi không chọn 'chartweek'
        const datamonth = {
    labels: ["Thu nhập và Chi tiêu THÁNG này"],


  datasets: [
    {
      label: "Income",
      data: [<?php echo $IncomeThisMonth; ?>],
      backgroundColor: "rgba(75, 192, 192, 100)",
      borderColor: "rgba(75, 192, 192, 1)",
    },
    {
      label: "Expense",
      data: [<?php echo $BillThisMonth; ?>],
      backgroundColor: "rgba(255, 99, 132, 100)",
      borderColor: "rgba(255, 99, 132, 1)",
    },
  ],
};
// Tạo biểu đồ
const chartmonth = new Chart(document.getElementById("canvasmonth"), {
  type: "bar",
  data: datamonth,
  options: {
    responsive: true,
    title: {
      display: true,
      text: "Income and Expense",
    },
  },
});

    }

  </script>

    <script>
    function all(){
        // Đặt mã ở đây nếu bạn muốn thực hiện một hành động nào đó khi không chọn 'chartweek'
        const dataall = {
    labels: ["Biểu đồ  TẤT CẢ Thu nhập và Chi tiêu"],

  datasets: [
    {
      label: "Income",
      data: [<?php echo $IncomeOverall; ?>],
      backgroundColor: "rgba(75, 255, 255, 100)",
      borderColor: "rgba(75, 255, 255, 1)",
    },
    {
      label: "Expense",
      data: [<?php echo $BillsOverall; ?>],
      backgroundColor: "rgba(255, 99, 255, 100)",
      borderColor: "rgba(255, 99, 255, 1)",
    },
  ],
};
// Tạo biểu đồ
const chartall = new Chart(document.getElementById("canvasall"), {
  type: "bar",
  data: dataall,
  options: {
    responsive: true,
    title: {
      display: true,
      text: "Income and Expense",
    },
  },
});

    }

  </script>
<!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam expedita 
ducimus ipsa vitae ipsum adipisci possimus facilis nam praesentium, vel sunt quam quae mai
ores saepe fugit quasi aliquam provident similique? -->
  
 <script>
  function week(){
    <?php
    // Truy vấn dữ liệu thu và chi cho 7 ngày gần nhất
    $GetIncomeData = "SELECT DATE(Date) AS Date, SUM(Amount) AS Amount FROM assets WHERE UserId = $UserId AND Date >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY DATE(Date) ORDER BY Date";
    $GetExpenseData = "SELECT DATE(Dates) AS Date, SUM(Amount) AS Amount FROM bills WHERE UserId = $UserId AND Dates >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY DATE(Dates) ORDER BY Date";

    $dates = []; // Mảng chứa dữ liệu ngày
    $incomeData = [];
    $expenseData = [];

    $incomeResult = mysqli_query($mysqli, $GetIncomeData);
    $expenseResult = mysqli_query($mysqli, $GetExpenseData);

    // Tạo một mảng các ngày gần đây (7 ngày)
    $recentDays = [];
    for ($i = 6; $i >= 0; $i--) {
        $recentDays[] = date('Y-m-d', strtotime('-' . $i . ' day'));
    }

    // Duyệt qua các ngày gần đây để tạo dữ liệu
    foreach ($recentDays as $day) {
        $dates[] = $day; // Lưu ngày vào mảng ngày
        $incomeData[] = 0; // Mảng thu, khởi tạo giá trị ban đầu là 0
        $expenseData[] = 0; // Mảng chi, khởi tạo giá trị ban đầu là 0
    }

    // Duyệt qua dữ liệu thu và cập nhật vào mảng thu
    while ($row = mysqli_fetch_assoc($incomeResult)) {
        $index = array_search($row['Date'], $dates); // Tìm vị trí của ngày trong mảng ngày
        if ($index !== false) {
            $incomeData[$index] = $row['Amount']; // Cập nhật giá trị thu
        }
    }

    // Duyệt qua dữ liệu chi và cập nhật vào mảng chi
    while ($row = mysqli_fetch_assoc($expenseResult)) {
        $index = array_search($row['Date'], $dates); // Tìm vị trí của ngày trong mảng ngày
        if ($index !== false) {
            $expenseData[$index] = $row['Amount']; // Cập nhật giá trị chi
        }
    }
    ?>
    
    // Dữ liệu thu và chi từ PHP
    var incomeData = <?php echo json_encode($incomeData); ?>;
    var expenseData = <?php echo json_encode($expenseData); ?>;
    var days = <?php echo json_encode($dates); ?>;
    
    // Biểu đồ thu chi cho 7 ngày gần nhất
    var ctx = document.getElementById('canvasweek').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: days,
            datasets: [
                {
                    label: 'Thu',
                    data: incomeData,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Chi',
                    data: expenseData,
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                x: {
                    stacked: false
                },
                y: {
                    beginAtZero: true,
                    callback: function (value, index, values) {
                        return '$' + value;
                    }
                }
            }
        }
    });
  }
</script>



  
</body>
</html>














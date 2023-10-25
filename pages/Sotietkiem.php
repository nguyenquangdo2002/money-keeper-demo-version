<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compound Interest Calculator</title>
    <link rel="stylesheet" href="styles/main.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <style>
      * {
  padding: 0;
  margin: 0;
  font-family: "Montserrat", sans-serif;
  box-sizing: border-box;
}
body{
  background-color: #f2edf3;
}
.dialog{

  margin-top: 60px;
  margin-left: 30rem;
  width: 70%;
  height: 85%;
  padding: 10px;
}
.container {
  display: flex;
  flex-direction: row;
  justify-content: center;
  margin: 0px;
  margin-left: 30rem;
}

.calculator {
  width: 37%;
  color: #063102;
  float: left;
}

.heading h3 {
  font-size: 25px;
  color: rgb(52,152,219);
}
#message {
  font-size: 20px;
  color: #063102;
}

.input-group {
  margin: 5px 0;
}

.input-group label {
  display: block;
}
.a{
  margin-top: 50px;

  margin-left: 250px;
}
.input-group input,
.input-group button,
.input-group select {
  
  width: 100%;
  padding: 5px;
  border: 1px solid rgb(52,152,219);
  outline: none;
  border-radius: 3px;
}
.input-group button {
  background-color: rgb(52,152,219);
  
  color: #fff;
}

.results {
  box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.09);
  width: 55%;
  height: 80% ;
  margin: 20px;
  padding: 0px;

  float: left;
}
    </style>
</head>
<body>
        <div class="a">
          <button data-open-modal>Thêm sổ tiết kiệm</button>
        </div>

      <section class="container">

        <dialog class="dialog">
          <div class="calculator" style=" height: 100%; overflow: auto;" >
            <div class="heading">
                <h3 style="font-weight: bold;">Thêm sổ tiết kiệm</h3>
            </div>
            <form class="compound-form">
                <div class="input-group"style=" width: 90%">
                    <label for="initialamount">Số tiền</label>
                    <input required placeholder="Nhập số tiền" type="number" id="initialamount" required />
                </div>
                <div class="input-group" style=" width: 90%">
                   <label for="category"><?php echo $Account; ?></label>
                  <input   placeholder="Nhập tên tài khoản sổ tiết kiệm" name="account" type="text" required autofocus>
                    </div>                                                                 
                
                <div class="input-group"style=" width: 90%">
                    <label for="bank">Tên ngân hàng</label>
                    <input type="text" id="bank" />
                </div>
                <div class="input-group"style=" width: 90%">
                    <label for="bank">Ngày gửi</label>
                    <input type="date" id="bank" />
                </div>
                <div class="input-group" style=" width: 90%">
                    <label for="rates">Kỳ hạn</label>
                    <select id="compound">
                        <option value="1">Annualy</option>
                        <option value="4">Quartely</option>
                        <option value="2">Semiannualy</option>
                        <option value="12">Monthly</option>
                    </select>
                </div>
                
                <div class="input-group"style=" width: 90%">
                    <label for="rates">Lãi suất(%)/Năm</label>
                    <input type="number" placeholder="0.08%" id="rates" />
                </div>
                <div class="input-group"style=" width: 90%">
                    <label for="ratesNolimit">Lãi suất không kỳ hạn(%)/Năm</label>
                    <input type="number" placeholder="0.02%" id="ratesNolimit" />
                </div>
                <div class="input-group" style=" width: 90%">
                    <label for="returnRate">Trả lãi</label>
                    <select id="returnRate">
                        <option value="1">Cuối kì</option>
                        <option value="4">Đầu kì</option>
                        <option value="12">Định kì hàng tháng</option>
                        <!-- <option value="12">Monthly</option> -->
                    </select>
                </div>
                <div class="input-group" style=" width: 90%">
                    <label for="taituc">Tái tục gốc và lãi</label>
                    <select id="taituc">
                        <option value="1">Tái tục gốc và lãi</option>
                        <option value="4">Tái tục gốc</option>
                        <option value="12">Tất toán sổ</option>
                        <!-- <option value="12">Monthly</option> -->
                    </select>
                </div>
                <div class="input-group"style=" width: 90%">
                    <label for="years">Số ngày tính lãi/năm </label>
                    <input type="number" placeholder="Nhập số ngày" id="years" />
                </div>
                <div class="input-group"style=" width: 90%">
                    <label for="iaccount">Tiền được chuyển từ tài khoản ví</label>
                                        <select name="iaccount" class="form-control" >
                                            <?php while($col = mysqli_fetch_assoc($AccountIncome)){ ?>
                                            <option  value="<?php echo $col['AccountId'];?>"><?php echo $col['AccountName'];?></option>
                                            <?php } ?>
                                        </select>
                </div>
                <div class="input-group"style=" width: 90%">
                    <label for="desc">Diễn dải </label>
                    <textarea name="" id="desc" style="width:100%" cols="30" rows="1.5"></textarea>
                </div>
                <div class="input-group"style=" width: 90%">
                    <label for="" style="font-weight: lighter; color: black; text-align : center;">Mọi thông tin vừa nhập sẽ tính vào báo cáo
                      nên bạn hãy cân nhắc trước khi thêm sổ
                    </label>
                    
                </div>
                <div class="input-group"style="margin-top: 5px; width: 90%">
                    <button >tính toán</button>
                </div>
                <div class="input-group" style="margin-top: 70px; width: 90%">
                    <button>Thêm sổ tiết kiệm</button>  
                </div>
            </form>
        </div>

        <div class="results">
            <h3 id="message"></h3>
            <canvas id="data-set"></canvas>
        

        </div>
        <button data-close-modal> close</button>
        </dialog>
      </section>
    <script>
      const openModal = document.querySelector("[data-open-modal]");
        const closeModal = document.querySelector("[data-close-modal]");
        const dialog = document.querySelector(".dialog");

        openModal.addEventListener("click", () => {
            dialog.showModal();
        });

        closeModal.addEventListener("click", () => {
            dialog.close();
        });

      const context = document.getElementById("data-set").getContext("2d");
let line = new Chart(context, {});
//Values from the form
const intialAmount = document.getElementById("initialamount");
const years = document.getElementById("years");
const rates = document.getElementById("rates");
const compound = document.getElementById("compound");

//Messge
const message = document.getElementById("message");

//The calculate button
const button = document.querySelector(".input-group button");
//Attach an event listener
button.addEventListener("click", calculateGrowth);

const data = [];
const labels = [];

function calculateGrowth(e) {
    e.preventDefault();
    data.length = 0;
    labels.length = 0;
    let growth = 0;
    try {
        const initial = parseInt(intialAmount.value);
        const period = parseInt(years.value);
        const interest = parseFloat(rates.value);

        const comp = parseInt(compound.value);

        // for(let i = 1; i <= period; i++) {
        //     const final = initial * Math.pow(1 + ((interest / 100) / comp), comp * i);
        //     data.push(toDecimal(final, 2));
        //     labels.push("Year " + i);
        //     growth = toDecimal(final, 2);
        // }
                for (let i = 1; i <= period; i++) {
            // Tính lãi kép theo ngày
            const daysInYear = 1;
            const daysInPeriod = daysInYear * i;
            const final = initial * Math.pow(1 + ((interest / 100) / comp), comp * (daysInPeriod / daysInYear));
            data.push(toDecimal(final, 2));
            labels.push("Ngày " + daysInPeriod);
            growth = toDecimal(final, 2);
        }
        //
        // message.innerText = `You will have this amount ${growth} after ${period} years`;
        // drawGraph();
                message.innerText = `Với lãi suất ${interest}% thì bạn sẽ nhận được ${parseInt(growth).toLocaleString()}đ sau ${period} ngày`;

        drawGraph();
    } catch (error) {
        console.error(error);
    }
}
// function calculateGrowth(e) {
//     e.preventDefault();
//     data.length = 0;
//     labels.length = 0;
//     let growth = 0;
//     try {
//         const initial = parseInt(initialAmount.value);
//         const period = parseInt(years.value);
//         const interest = parseInt(rates.value);
//         const comp = parseInt(compound.value);

        // for (let i = 1; i <= period; i++) {
        //     // Tính lãi kép theo ngày
        //     const daysInYear = 365;
        //     const daysInPeriod = daysInYear * i;
        //     const final = initial * Math.pow(1 + ((interest / 100) / comp), comp * (daysInPeriod / daysInYear));
        //     data.push(toDecimal(final, 2));
        //     labels.push("Year " + daysInPeriod);
        //     growth = toDecimal(final, 2);
        // }
        
        // message.innerText = `You will have this amount ${growth} after ${period} days`;
        // drawGraph();
//     } catch (error) {
//         console.error(error);
//     }
// }

function drawGraph() {
    line.destroy();
    line = new Chart(context, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: "compound",
                data,
                fill: true,
                backgroundColor: "rgba(12, 141, 0, 0.7)",
                borderWidth: 3
            }]
        }
    });
}

function toDecimal(value, decimals) {
    return +value.toFixed(decimals);
}
    </script>
</body>
</html>
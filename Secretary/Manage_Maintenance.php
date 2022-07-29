<?php
include_once '../Connection.php';
include_once 'Secretary_Dashboard.php';
//  include_once '../links.php';

// $q = "select * from tbl_maintenance where sid = " . $_SESSION['socid'] . " and year = " . date("Y");
// $sel = mysqli_query($conn, $q);
// $data = mysqli_fetch_array($sel);

// if(!empty($data['mnid']))
// {
//     header("location:Secretary_Dashboard.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <!-- datatable cdn -->
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/milligram.min.css">
    <link rel="stylesheet" href="../css/styles.css">

    <style>
        html {
            font-family: Raleway;
            background-color: #f7f2dfe7;
        }

        #lgForm {
            width: 1050px;
            margin-left: 330px;
        }

        body {
            background-color: #f7f2dfe7;
        }

        #user {
            margin-top: -45px;
        }

        #toast-container .toast {
            font-size: 15px;
        }

        .alert {
            padding: 20px;
            background-color: #ff9800;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_REQUEST['btnAdd_Mt'])) {
        $sid = $_SESSION['socid'];
        $wing = $_SESSION['wing'];
        $year = $_REQUEST['year'];
        $amo = $_REQUEST['price'];
        $dis = $_REQUEST['afterDiscount'];
        $dis1 = $_REQUEST['afterDiscount1'];
        $dis2 = $_REQUEST['afterDiscount2'];

        $q = "insert into tbl_maintenance (sid,wing,year,amount,dis_12,dis_6,dis_4) values ($sid,'$wing',$year,$amo,$dis,$dis1,$dis2)";
        mysqli_query($conn, $q);
    }
    ?>

    <form id="lgForm" name="discountCalculator" onsubmit="return validateForm()" action="" method="POST" novalidate>
        <h3><b style="color:#35cebe;">Manage Maintenance</b></h3>
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Warning!</strong> Once you add , it willn't change.
        </div>
        Year :<input type="number" name="year" id="year" placeholder="YYYY" min="2021" max="2100">

        <label for="price">Total Maintenance of Year</label>
        <input type="text" name="price" id="price">

        <label style="color:#bb7945;">12 Months</label>
        <br>
        <div class="row">
            <div class="col-sm-2"><label for="discount">Discount</label></div>
            <div class="col-sm-2"><input type="number" name="discount" id="discount" maxlength="4" min="0" max="100"></div>
            <div class="col-sm-2"><label for="afterdiscount">After Discount</label></div>
            <div class="col-sm-2"><input type="number" name="afterDiscount" id="afterdiscount" readonly></div>
            <div class="col-sm-2"><input type="button" value="count" onclick="calculate()"></div>
        </div>

        <label style="color:#bb7945;">6 Months</label>
        <br>
        <div class="row">
            <div class="col-sm-2"><label for="discount">Discount</label></div>
            <div class="col-sm-2"><input type="number" name="discount1" id="discount1" maxlength="4" min="0" max="100"></div>
            <div class="col-sm-2"><label for="afterdiscount1">After Discount</label></div>
            <div class="col-sm-2"><input type="number" name="afterDiscount1" id="afterdiscount1" readonly></div>
            <div class="col-sm-2"><input type="button" value="count" onclick="calculate1()"></div>
        </div>

        <label style="color:#bb7945;">4 Months</label>
        <br>
        <div class="row">
            <div class="col-sm-2"><label for="discount">Discount</label></div>
            <div class="col-sm-2"><input type="number" name="discount2" id="discount2" maxlength="4" min="0" max="100"></div>
            <div class="col-sm-2"><label for="afterdiscount">After Discount</label></div>
            <div class="col-sm-2"><input type="number" name="afterDiscount2" id="afterdiscount2" readonly></div>
            <div class="col-sm-2"><input type="button" value="count" onclick="calculate2()"></div>
        </div>
        <br>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="submit" id="btnAdd_Mt" name="btnAdd_Mt" style="width:fit-content; font-size: 15px;">SEND</button>
            </div>
        </div>
    </form>

    <script>
        function calculate() {
            var price = 40;
            var discount = 0;
            var afterDiscount = 0;
            price = Number(document.discountCalculator.price.value);
            numberOfMembers = Number(document.discountCalculator.value);
            discount = Number(document.discountCalculator.discount.value);

            if (discount > 100) {
                discount = 100;
            }

            afterDiscount = price - (price * discount / 100);


            document.discountCalculator.price.value = price;
            document.discountCalculator.discount.value = discount;
            document.discountCalculator.afterDiscount.value = afterDiscount;

        }

        function calculate1() {

            var discount1 = 0;
            var afterDiscount1 = 0;
            price = Number(document.discountCalculator.price.value);
            numberOfMembers = Number(document.discountCalculator.value);
            discount1 = Number(document.discountCalculator.discount1.value);

            if (discount1 > 100) {
                discount1 = 100;
            }

            afterDiscount1 = price - (price * discount1 / 100);


            document.discountCalculator.price.value = price;
            document.discountCalculator.discount1.value = discount1;
            document.discountCalculator.afterDiscount1.value = afterDiscount1;

        }

        function calculate2() {
            var discount2 = 0;
            var afterDiscount2 = 0;
            price = Number(document.discountCalculator.price.value);
            numberOfMembers = Number(document.discountCalculator.value);
            discount2 = Number(document.discountCalculator.discount2.value);

            if (discount2 > 100) {
                discount2 = 100;
            }

            afterDiscount2 = price - (price * discount2 / 100);


            document.discountCalculator.price.value = price;
            document.discountCalculator.discount2.value = discount2;
            document.discountCalculator.afterDiscount2.value = afterDiscount2;

        }

        function validateForm() {
            var year = $('#year').val();
            var price = $('#price').val();
            var err = false;
            var dis = $('#discount').val();
            var dis1 = $('#discount1').val();
            var dis2 = $('#discount2').val();

            if (year == "") {
                err = true;
                toastr.error('Please enter a year');
            }

            if (price == "" || !/^\d+$/.test(price) || price <= 0) {
                err = true;
                toastr.error('Please enter a valid maintainance amount.');
            }

            if (dis == "" || dis1 == "" || dis2 == "") {
                err = true;
                toastr.error('Please enter a valid discount for all three components.');
            }

            if (err == true) {
                return false;
            }
        }
    </script>
</body>

</html>
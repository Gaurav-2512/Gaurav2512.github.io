<!DOCTYPE html>
<html>
<head>
    <?php include './db.php'?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form method="post">
        <div class="row">
          <div class="col-50">
            <h3>Billing System</h3>
            <label for="name"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="name" name="name" value="" placeholder="Enter Name" required>
            <label for="amount"><i class="fa fa-envelope"></i> Amount</label>
            <input type="text" id="amount" name="amount" value="" placeholder="Enter Amount" required>
          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
          </div>  
        </div>
        <input type="button" name="btn" id="btn" value="Pay Now" onclick="pay_now()" class="btn">
      </form>
    </div>
  </div>
</div>

</body>
</html>

<script type="text/javascript">
    function pay_now(){
        var name = jQuery('#name').val();
        var amount  = jQuery('#amount').val();
        jQuery.ajax({
            type:'post',
            url:'payment_process.php',
            data:"&amount="+amount+"&name="+name,
            success:function(result){
                var options = {    
                "key": "rzp_test_jw7yhlDMokwH0M", 
                "amount": amount *100,
                "currency": "INR",   
                "name": name,    
                "description": "Test Transaction",
                "handler": function(response){
                    jQuery.ajax({
                        type:'post',
                        url:'payment_process.php',
                        data:"payment_id="+response.razorpay_payment_id,
                    success:function(result){
                    window.location.href="thank.php";
                }
            });
        }   
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();   
            }
        });    
    }
</script>
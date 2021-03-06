<?php include('menu.php');?>
<?php $orderid=Helper::GenerateOrderId(); ?>

<h2>3D OOS Pay Satış </h2>
<br />
<fieldset>

    <legend><label style="font-weight:bold;width:250px;">İşlem Bilgileri</label></legend>
    <label style="font-weight:bold;">İşlem Tipi &nbsp; :   &nbsp; </label> Sales<br>
    <label style="font-weight:bold;">Terminal ID &nbsp; :&nbsp; </label> 30691299 <br>
    <label style="font-weight:bold;">MerchantID  &nbsp;:   &nbsp;</label> 7000679 <br>
    <label style="font-weight:bold;">ProvUserID &nbsp;:  &nbsp;</label> PROVAUT <br>
    <label style="font-weight:bold;">UserID &nbsp;:  &nbsp;</label> PROVAUT<br>

</fieldset>

<form action="" method="post" class="form-horizontal">
    <fieldset>
        <!-- Form Name -->
        <legend><label style="font-weight:bold;width:250px;">Ödeme Bilgileri</label></legend>
        <!-- Text input-->
        <div class="form-group">
            <br />
            <label class="col-md-4 control-label" for=""> Ödeme Tipi :</label>
            <div class="col-md-4">
                <select name="secure3dsecuritylevel">
                    <option value="3D_OOS_PAY">3D_OOS_PAY</option>
                    <option value="3D_OOS_FULL">3D_OOS_FULL</option>
                    <option value="3D_OOS_HALF">3D_OOS_HALF</option>
                </select>
            </div>
        </div>
       
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  OrderID:</label>
            <div class="col-md-4">
			<input value="<?php echo $orderid; ?>" name="orderID" class="form-control input-md">

            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  İşlem Tutarı:</label>
            <div class="col-md-4">
                <input value="" name="transactionAmount" class="form-control input-md">
            </div>
        </div>
    </fieldset>
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for=""></label>
        <div class="col-md-4">
            <button type="submit" id="" name="" class="btn btn-danger"> Ödeme Yap</button>
        </div>
    </div>
</form>

<?php if (!empty($_POST)): ?>
<?php
   
   
    $settings3D=new Settings3D();
    $terminal=new Terminal();

    $request = new Sale3DOOSPayRequest();
    $request->apiversion = $settings3D->apiversion;
    $request->mode = $settings3D->mode;

    $request->terminalid="30691299";
    $request->terminaluserid="PROVOOS";
    $request->terminalprovuserid ="PROVOOS";
    $request->terminalmerchantid = "7000679";



    $request->successurl = "http://garantiphp.codevist.com/OOSSuccess.php";
    $request->errorurl = "http://garantiphp.codevist.com/OOSError.php";
    $request->customeremailaddress = "fatih@codevist.com";
   
    $request->customeripaddress = "127.0.0.1";
    $request->secure3dsecuritylevel = $_POST["secure3dsecuritylevel"];
    $request->orderid = $_POST["orderID"];
    $request->txnamount = $_POST["transactionAmount"];
	$request->txntype = "sales";
	$request->txninstallmentcount = "";
	$request->txncurrencycode = "949";
	$request->storekey = "12345678";
	$request->txntimestamp = date("d-m-Y H:i:s");
	$request->lang = "tr";
	$request->refreshtime = "10";
	$request->companyname = "deneme";
    
    $request->secure3dhash=Sale3DOOSPayRequest::Compute3DHash($request,$settings3D);
    $response = Sale3DOOSPayRequest::execute($request,$settings3D); //Sale3DOOSPayRequest servisi başlatılması için gerekli servis çağırısını temsil eder.
    print $response;
	?>

<?php endif; ?>	 



<?php include('footer.php');?>
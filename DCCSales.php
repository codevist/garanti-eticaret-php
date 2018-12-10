<?php include('menu.php');?>
<h2>DCC Satış </h2>
<br />
<fieldset>

    <legend><label style="font-weight:bold;width:250px;">İşlem Bilgileri</label></legend>
    <label style="font-weight:bold;">İşlem Tipi &nbsp; :   &nbsp; </label> Sales<br>
    <label style="font-weight:bold;">Alt İşlem Tipi &nbsp; :   &nbsp; </label> Dcc<br>
    <label style="font-weight:bold;">Terminal ID &nbsp; :&nbsp; </label> 30690133 <br>
    <label style="font-weight:bold;">MerchantID  &nbsp;:   &nbsp;</label> 3424113 <br>
    <label style="font-weight:bold;">ProvUserID &nbsp;:  &nbsp;</label> PROVAUT <br>
    <label style="font-weight:bold;">UserID &nbsp;:  &nbsp;</label> PROVAUT<br>

</fieldset>

<form action="" method="post" class="form-horizontal">
    <fieldset>
        <!-- Form Name -->
        <legend><label style="font-weight:bold;width:250px;">Ödeme Bilgileri</label></legend>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  Kart Numarası:</label>
            <div class="col-md-4">
                <input value="4005520000000129" name="creditCardNo" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  Son Kullanma Tarihi Ay/Yıl: </label>
            <div class="col-md-4">
                <input value="1222" name="expireDate" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  CVC: </label>
            <div class="col-md-4">
                <input value="" name="cvv" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  OrderID:</label>
            <div class="col-md-4">
        
                <input value="" name="orderID" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="">  İşlem Tutarı:</label>
            <div class="col-md-4">
                <input value="" name="transactionAmount" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for=""> OriginalRetRefNum Değeri:</label>
            <div class="col-md-4">
                <input value="" name="originalRetrefNum" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <br />
            <label class="col-md-4 control-label" for=""> Kur :</label>
            <div class="col-md-4">
                <select name="currency">
                    <option value="949">TL</option>
                    <option value="840">USD</option>
                    <option value="978">EUR</option>
                    <option value="826">GBP</option>
                    <option value="392">JPY</option>
                </select>
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
    
   
    $settings=new Settings();
    $terminal=new Terminal();

    $request = new DCCSalesRequest();
    $request->Version = $settings->Version;
    $request->Mode = $settings->Mode;

    $request->Customer = new Customer();
    $request->Customer->EmailAddress="eticaret@garanti.com.tr";
    $request->Customer->IPAddress="127.0.0.1";

    $request->Card = new Card();
    $request->Card->CVV2=$_POST["cvv"];
    $request->Card->ExpireDate=$_POST["expireDate"];
    $request->Card->Number=$_POST["creditCardNo"] ;

    $request->Order = new Order();
    $request->Order->OrderID=$_POST["orderID"];
    $request->Order->Description="";
   
    $request->Terminal= new Terminal();
    $request->Terminal->ProvUserID=$terminal->ProvUserID;
    $request->Terminal->UserID=$terminal->UserID;
    $request->Terminal->ID="30690133";
    $request->Terminal->MerchantID="3424113";

    $request->Transaction = new Transaction();
    $request->Transaction->Amount=$_POST["transactionAmount"];
    $request->CurrencyCode="949";
    $request->Transaction->Type="sales";
    $request->MotoInd="H";
    $request->SubType="dcc";
    $request->OriginalRetrefNum=$_POST["originalRetrefNum"];// sorgu sonucu dönen değeri alacaktır.
    $request->DCCCurrency=$_POST["currency"];
  
    $request->Hash=Helper::ComputeHash($request,$settings);

    $response = DCCSalesRequest::execute($request,$settings); //DCCSalesRequest servisi başlatılması için gerekli servis çağırısını temsil eder.
    print "<h3>Sonuç:</h3>";
	echo "<pre>";
    echo htmlspecialchars ($response);  
    echo "</pre>";
	?>

<?php endif; ?>	 
<?php include('footer.php');?>

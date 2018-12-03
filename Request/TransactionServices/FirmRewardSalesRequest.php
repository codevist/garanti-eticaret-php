<?php
//Firma Bonus Kullanım istek çağrısının yapıldığı sınıfı temsil etmektedir.
class FirmRewardSalesRequest extends VPOSRequest
{
    public $CurrencyCode;
    public $MotoInd;
    public $Hash;
    public $Type;
    public $UsedAmount;

    public static function Execute(FirmRewardSalesRequest $request,Settings $settings)
    {
        return  restHttpCaller::post($settings->BaseUrl, $request->toXmlString());
    }
      //Post edilmesi istenen xml metni oluşturulup bu xml metni belirtilen adrese post edilir.
      public function toXmlString()
      {
         
          $xml_data =
          "<GVPSRequest>\n" .
          "    <Mode>" . $this->Mode . "</Mode>\n" .
          "    <Version>" . $this->Version . "</Version>\n" .
          "    <Terminal>\n" .
          "       <ProvUserID>" .$this->Terminal->ProvUserID . "</ProvUserID>\n" .
          "       <HashData>" .$this->Hash. "</HashData>\n" .
          "       <UserID>" .$this->Terminal->UserID . "</UserID>\n" .
          "       <ID>" .$this->Terminal->ID . "</ID>\n" .
          "       <MerchantID>" .$this->Terminal->MerchantID . "</MerchantID>\n" .
          "    </Terminal>\n" .
          "    <Customer>\n" .
          "       <IPAddress>" .$this->Customer->IPAddress . "</IPAddress>\n" .
          "       <EmailAddr>" .$this->Customer->EmailAddr . "</EmailAddr>\n" .
          "    </Customer>\n" .
          "    <Card>\n" .
          "       <Number>" .$this->Card->Number . "</Number>\n" .
          "       <ExpireDate>" .$this->Card->ExpireDate . "</ExpireDate>\n" .
          "       <CVV2>" .$this->Card->CVV2 . "</CVV2>\n" .
          "    </Card>\n" .
          "    <Order>\n" .
          "       <OrderID>" .$this->Order->OrderID . "</OrderID>\n" .
          "       <Description/>" .
          "    </Order>\n" .
          "    <Transaction>\n" .
          "         <Type>" .$this->Transaction->Type . "</Type>\n" .
          "         <Amount>" .$this->Transaction->Amount . "</Amount>\n" .
          "         <CurrencyCode>" .$this->CurrencyCode . "</CurrencyCode>\n" .
          "         <MotoInd>" .$this->MotoInd . "</MotoInd>\n" .
          "          <RewardList>\n" .
          "             <Reward>\n" .
          "                 <Type>" .$this->Type . "</Type>\n" .
          "                 <UsedAmount>" .$this->UsedAmount. "</UsedAmount>\n" .
          "             </Reward>\n" .
          "          </RewardList>\n" .
          "    </Transaction>\n" .
          "</GVPSRequest>";
           return $xml_data;
      }  
}

<?php
//Tekrarlı Güncelleme istek çağrısının yapıldığı sınıfı temsil etmektedir.
class RecurringUpdateRequest extends VPOSRequest
{
    public $CurrencyCode;
    public $MotoInd;
    public $Hash;
    public $Number;
    public $Amount;
    public $Number1;
    public $Amount1;

    public static function Execute(RecurringUpdateRequest $request,Settings $settings)
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
          "       <EmailAddress>" .$this->Customer->EmailAddress . "</EmailAddress>\n" .
          "    </Customer>\n" .
          "    <Card>\n" .
          "       <Number>" .$this->Card->Number . "</Number>\n" .
          "       <ExpireDate>" .$this->Card->ExpireDate . "</ExpireDate>\n" .
          "       <CVV2>" .$this->Card->CVV2 . "</CVV2>\n" .
          "    </Card>\n" .
          "    <Order>\n" .
          "       <OrderID>" .$this->Order->OrderID . "</OrderID>\n" .
          "       <Description/>" .
          "       <Recurring>\n" .
          "         <PaymentList>\n" .
          "             <Payment>\n" .
          "                 <PaymentNum>" .$this->Number . "</PaymentNum>\n" .
          "                 <Amount>" .$this->Amount . "</Amount>\n" .
          "             </Payment>\n" .
          "             <Payment>\n" .
          "                 <PaymentNum>" .$this->Number1 . "</PaymentNum>\n" .
          "                 <Amount>" .$this->Amount1 . "</Amount>\n" .
          "             </Payment>\n" .
          "         </PaymentList>\n" .
          "       </Recurring>\n" .
          "    </Order>\n" .
          "    <Transaction>\n" .
          "         <Type>" .$this->Transaction->Type . "</Type>\n" .
          "         <Amount>" .$this->Transaction->Amount . "</Amount>\n" .
          "         <CurrencyCode>" .$this->CurrencyCode . "</CurrencyCode>\n" .
          "         <MotoInd>" .$this->MotoInd . "</MotoInd>\n" .
          "    </Transaction>\n" .
          "</GVPSRequest>";
           return $xml_data;
      }  
}

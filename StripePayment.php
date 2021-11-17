<?php
namespace Allopro\StripePayment;
require_once '/home/Aleaupro2020/public_html/Stripe/init.php';

use \Stripe\Stripe;
//use \Stripe\lib\Stripe;
use \Stripe\Customer;
use \Stripe\ApiOperations\Create;
use \Stripe\Charge;

class StripePayment
{

    private $apiKey;

    private $stripeService;

    public function __construct()
    {
        $this->apiKey = "sk_test_51HtJFZDIjS3LQgSd8kh4AmzwIWUP4KUeIv15cbhGNny4zMeN66cBknYRZB8ktyr93hX0syXWj18VCevoIEpweoSV00Ssh5MGjZ";
        $this->stripeService = new \Stripe\Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey($this->apiKey);
    }

    public function addCustomer($customerDetailsAry)
    {
        
        $customer = new Customer();
        
        $customerDetails = $customer->create($customerDetailsAry);
        return $customerDetails;
    }

    public function chargeAmountFromCard($cardDetails)
    {
        $customerDetailsAry = array(
            'email' => $cardDetails['email'],
            'source' => $cardDetails['token']
        );
        $customerResult = $this->addCustomer($customerDetailsAry);
        $charge = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $cardDetails['amount']*100 ,
            'currency' => $cardDetails['currency_code'],
            'description' => $cardDetails['item_name'],
            'metadata' => array(
                'order_id' => $cardDetails['item_number']
            )
        );
        $result = $charge->create($cardDetailsAry);

        return $result->jsonSerialize();
    }
}

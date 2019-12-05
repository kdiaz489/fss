<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\User;
use Auth;

class AuthorizeController extends Controller
{
    public function index()
    {
        return view('checkout.authorize');
    }

    public function makepaymentform($id)
    {
        $user_id = $id;
        $user = User::find($user_id);
        return view('checkout.makepayment')->with('user', $user);
    }

    public function makepayment(Request $request)
    {
        
        
        $id = auth()->user()->id;
        $user = User::find($id);

        // Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('services.authorize.login'));
        $merchantAuthentication->setTransactionKey(config('services.authorize.key'));

        // Set the transaction's refId
        $refId = 'ref' . time();


        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($request->ccardnum);
        // $creditCard->setExpirationDate( "2038-12");
        $expiry = $request->card_expiry_year . '-' . $request->card_expiry_month;
        $creditCard->setCardCode($request->ccvv);
        $creditCard->setExpirationDate($expiry);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);


        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($request->invoiceid);
        $order->setDescription($request->prod_desc);
        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($request->cname);
        $customerAddress->setLastName($request->clastname);
        $customerAddress->setCompany(auth()->user()->company_name);
        $customerAddress->setAddress($request->cstreetaddress);
        $customerAddress->setCity($request->ccity);
        $customerAddress->setState($request->cstate);
        $customerAddress->setZip($request->czip);

        $customerAddress->setCountry("USA");
        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId(auth()->user()->id);
        $customerData->setEmail($request->cemail);

        // Create a customer shipping address This is the object that I added
        /*
        $customerShippingAddress = new AnetAPI\CustomerAddressType();
        $customerShippingAddress->setFirstName("James");
        $customerShippingAddress->setLastName("White");
        $customerShippingAddress->setCompany("Addresses R Us");
        $customerShippingAddress->setAddress(rand() . " North Spring Street");
        $customerShippingAddress->setCity("Toms River");
        $customerShippingAddress->setState("NJ");
        $customerShippingAddress->setZip("08753");
        $customerShippingAddress->setCountry("USA");
        */

         // Create a TransactionRequestType object and add the previous objects to it
        
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        //$transactionRequestType->setShipTo($customerShippingAddress);
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $amount = (float)$request->amount;
        //$amount = 0.01;
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        $message = "N/A";
        $respcode = 200;
        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $acc_bal = $user->account_balance - $amount; 
                $user->account_balance = $acc_bal;
                $user->save();
                $message = "Your payment to FillStorShip was successful. Authorization Code : " . $tresponse->getAuthCode() . "\n" . "Transaction ID  : " . $tresponse->getTransId() . "\n";
               
                $respcode = 200;
            } 
            elseif(($tresponse != null) && ($tresponse->getResponseCode() == "2")) {
                $message = "Payment Error :  Your card was declined. Please try again.\n";
                $respcode = 500;
            }
            elseif(($tresponse != null) && ($tresponse->getResponseCode() == "3")) {
                $message = "Payment Error :  There was an error with your submission. Please try again.\n";
                $respcode = 500;
            }
            else {
                $message = "Payment Error :  Action by FillStorShip is required. Please contact us at ship@fillstorship.com.\n";
                $respcode = 500;
            }            

        } else {
            $message = "Charge Credit Card Null response returned";
            $respcode = 500;
        }

        return back()->with('message', $message);
        //return response()->json(['message' => $message], $respcode);
    }

    public function chargeCreditCard(Request $request)
    {
        // Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('services.authorize.login'));
        $merchantAuthentication->setTransactionKey(config('services.authorize.key'));

        // Set the transaction's refId
        $refId = 'ref' . time();


        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($request->ccardnum);
        // $creditCard->setExpirationDate( "2038-12");
        $expiry = $request->card_expiry_year . '-' . $request->card_expiry_month;
        $creditCard->setCardCode($request->ccvv);
        $creditCard->setExpirationDate($expiry);

        // Add the payment data to a paymentType object
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);


        // Create order information
        $order = new AnetAPI\OrderType();
        $order->setInvoiceNumber($request->invoiceid);
        $order->setDescription($request->prod_desc);
        // Set the customer's Bill To address
        $customerAddress = new AnetAPI\CustomerAddressType();
        $customerAddress->setFirstName($request->cname);
        $customerAddress->setLastName($request->clastname);
        $customerAddress->setCompany(auth()->user()->company_name);
        $customerAddress->setAddress($request->cstreetaddress);
        $customerAddress->setCity($request->ccity);
        $customerAddress->setState($request->cstate);
        $customerAddress->setZip($request->czip);

        $customerAddress->setCountry("USA");
        // Set the customer's identifying information
        $customerData = new AnetAPI\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId(auth()->user()->id);
        $customerData->setEmail($request->cemail);

        // Create a customer shipping address This is the object that I added
        $customerShippingAddress = new AnetAPI\CustomerAddressType();
        $customerShippingAddress->setFirstName("James");
        $customerShippingAddress->setLastName("White");
        $customerShippingAddress->setCompany("Addresses R Us");
        $customerShippingAddress->setAddress(rand() . " North Spring Street");
        $customerShippingAddress->setCity("Toms River");
        $customerShippingAddress->setState("NJ");
        $customerShippingAddress->setZip("08753");
        $customerShippingAddress->setCountry("USA");

         // Create a TransactionRequestType object and add the previous objects to it
        
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setShipTo($customerShippingAddress);
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $amount = (float)$request->quote;
        //$amount = 0.01;
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);

        // Assemble the complete transaction request
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);

        $message = "N/A";
        $respcode = 200;
        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) {
                $message = "Your payment to FillStorShip was successful. <br> Charge Credit Card Authorization Code : " . $tresponse->getAuthCode() . "\n" . "Charge Credit Card Transactio ID  : " . $tresponse->getTransId() . "\n";
                $respcode = 200;
            } 
            elseif(($tresponse != null) && ($tresponse->getResponseCode() == "2")) {
                $message = "Payment Error :  Your card was declined. Please try again.\n";
                $respcode = 500;
            }
            elseif(($tresponse != null) && ($tresponse->getResponseCode() == "3")) {
                $message = "Payment Error :  There was an error with your submission. Please try again.\n";
                $respcode = 500;
            }
            else {
                $message = "Payment Error :  Action by FillStorShip is required. Please contact us at ship@fillstorship.com.\n";
                $respcode = 500;
            }            

        } else {
            $message = "Charge Credit Card Null response returned";
            $respcode = 500;
        }

        return response()->json(['message' => $message], $respcode);
    }
}

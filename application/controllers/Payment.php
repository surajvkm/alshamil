<?php
/*
@project 				: Alshamil
@project Module 		: Payment 
@developrt				: Arun Vasanth Samraj 
@lastmodification date	: 15-04-2018
@controller 			: Payment

*/
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/NetworkonlieBitmapPaymentIntegration_Controller.php';
class Payment extends CI_Controller {
	
	public function __construct(){
    parent::__construct();   
    is_logged_in();
    $this->load->database();
    $this->load->Model('Trader_Model' ,'trd');     
    
         $this->mId      = '201611201000001';
        $this->mKey     = 'L0Iml+JieUcBy8B6SQrT0zJlGp1l1E4vqYSWM1BhO9w=';
        $this->iv       = '0123456789abcdef';
        $this->amount   =  0;
        $this->user_id  = '';
    }


    function OnlinePay(){
    	
        $this->user1iD = $this->input->get('user_id');
        $this->amount = $this->input->get('amount');
       
       if(!null===($this->input->get('order_id'))){
        $this->order1iD = $this->input->get('order_id');   
        $order=$this->input->get_where('orderitem',array('orderId' => $this->input->get('order_id')),1)->result();
        $this->amount=$order->orderAmount;
       }else{
        $this->order1iD=NULL;
        $this->db->join('subscriptionplan ','subscriptionplan.planId = tradersubscription.planId ');
        $order=$this->db->get_where('tradersubscription',array('traderId' => $this->input->get('user_id')),1)->row();
        $this->amount=$order->amount;
        
      }

        //Network International Payment Gateway Details
        $this->networkOnlineArray[]= array('Network_Online_setting' => array(
                                            'merchantKey'    => $this->mKey,            // Your key provided by network international
                                            'merchantId'     => $this->mId, //  Your merchant ID ex: 201408191000001
                                            'collaboratorId' => 'NI',                // Constant used by Network Online international
                                            'iv'             => $this->iv, // Used for initializing CBC encryption mode
                                            'url'            => false              // Set to false if you are using testing environment , set to true if you are using live environment
                                ),
                                'Block_Existence_Indicator' => array(
                                            'transactionDataBlock' => true,
                                            'billingDataBlock'     => true,
                                            'shippingDataBlock'    => false,
                                            'paymentDataBlock'     => false,
                                            'merchantDataBlock'    => true,
                                            'otherDataBlock'       => true,
                                            'DCCDataBlock'         => false
                                ),
                                'Field_Existence_Indicator_Transaction' => array(
                                            'merchantOrderNumber'  =>time(), //
                                            'amount'               => $this->amount,
                                            'successUrl'           => base_url()."Trader/SaveTransactionData",//"http://alshamil.bluecast.ae/Trader/SaveTransactionData"
                                            'failureUrl'           => base_url()."Trader/transactionfailure",//http://alshamil.bluecast.ae/alshamil.bluecast.ae/Trader/transactionfailure
                                            'payModeType'          => '',
                                            'transactionMode'       => 'INTERNET',
                                            'transactionType'      => '01',
                                            'currency'             => 'AED'
                                ),
                                'Field_Existence_Indicator_Billing' => array(
                                            'billToFirstName'       => 'Soloman', 
                                            'billToLastName'        => 'Vandy',
                                            'billToStreet1'         => '123,ParkStreet',
                                            'billToStreet2'         => 'Park Street',
                                            'billToCity'            => 'Mumbai',
                                            'billToState'           => 'Maharashtra',
                                            'billtoPostalCode'      => '400081',
                                            'billToCountry'         => 'IN',
                                            'billToEmail'           => 'solomanv@test.com',
                                            'billToMobileNumber'    => '9820998209',
                                            'billToPhoneNumber1'    => '',
                                            'billToPhoneNumber2'    => '',
                                            'billToPhoneNumber3'    => ''
                                ),
                                'Field_Existence_Indicator_Shipping' => array(
                                            'shipToFirstName'    => 'Soloman', 
                                            'shipToLastName'     => 'Vandy', 
                                            'shipToStreet1'      => '123ParkStreet', 
                                            'shipToStreet2'      => 'parkstreet', 
                                            'shipToCity'         => 'Mumbai',
                                            'shipToState'        => 'Maharashtra',
                                            'shipToPostalCode'   => '400081',
                                            'shipToCountry'      => 'IN',
                                            'shipToPhoneNumber1' => '',
                                            'shipToPhoneNumber2' => '',
                                            'shipToPhoneNumber3' => '',
                                            'shipToMobileNumber' => '9820998209'
                                ),
                                'Field_Existence_Indicator_Payment' => array(
                                            'cardNumber'      => '4111111111111111', // 1. Card Number  
                                            'expMonth'        => '08',               // 2. Expiry Month 
                                            'expYear'         => '2020',             // 3. Expiry Year
                                            'CVV'             => '123',              // 4. CVV  
                                            'cardHolderName'  => 'Soloman',          // 5. Card Holder Name 
                                            'cardType'        => 'Visa',             // 6. Card Type
                                            'custMobileNumber'=> '9820998209',       // 7. Customer Mobile Number
                                            'paymentID'       => '123456',           // 8. Payment ID 
                                            'OTP'             => '123456',           // 9. OTP field 
                                            'gatewayID'       => '1026',             // 10.Gateway ID 
                                            'cardToken'       => '1202'              // 11.Card Token 
                                ),
                                'Field_Existence_Indicator_Merchant'  => array(
                                                    'UDF1'   => '115.121.181.112', // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF2'   => $this->user1iD,             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF3'   => $this->order1iD,             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF4'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF5'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF6'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF7'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF8'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF9'   => 'abc',             // This is a ‘user-defined field’ that can be used to send additional information about the transaction.
                                                    'UDF10'  => 'abc'              // This is a ‘user-defined field’ that can be used to send additional information about the transaction.                             
                                ),
                                'Field_Existence_Indicator_OtherData'  => array(
                                        'custID'                 => $this->user1iD,  
                                        'transactionSource'      => 'IVR',                      
                                        'productInfo'            => $this->user1iD,                         
                                        'isUserLoggedIn'         => 'Y',                            
                                        'itemTotal'              => '500.00, 1000.00', 
                                        'itemCategory'           => 'CD, Book',                         
                                        'ignoreValidationResult' => 'FALSE'
                                ),
                                'Field_Existence_Indicator_DCC'   => array(
                                        'DCCReferenceNumber' => '09898787', // DCC Reference Number
                                        'foreignAmount'      => '240.00', // Foreign Amount
                                        'ForeignCurrency'    => 'USD'  // Foreign Currency
                                )
                            );


        $networkOnlineObject = new NetworkonlieBitmapPaymentIntegration($this->networkOnlineArray);
        $requestParameter = $networkOnlineObject->NeoPostData;

        if($networkOnlineObject->url)
            $requestUrl = 'https://NeO.network.ae/direcpay/secure/PaymentTxnServlet';
        else
            $requestUrl = 'https://uat.timesofmoney.com/direcpay/secure/PaymentTxnServlet';
            
            $data = array('url'=>$requestUrl,'req_param'=>$requestParameter);
            
            
            
        $this->load->view('client/onlinepay',$data); exit;
    } 
    
    function saveTransactionData(){
        //$user_id = $this->user_id;
        //$order_id = $this->order_id;
     
        $data = array('order_id' => '', 'ref_num'=>'');
        if(isset($_REQUEST['responseParameter']) && $_REQUEST['responseParameter'] != ''){
           $networkOnlineObject = new NetworkonlieBitmapPaymentIntegration($this->networkOnlineArray);
           $response = $networkOnlineObject->decryptData($_REQUEST['responseParameter'],$this->mKey,$this->iv);
           $transactionResponse = explode('|',$response['Transaction_Response']);
           $transactionRelatedInformation = explode('|',$response['Transaction_related_information']); 
           $traderRelated = explode('|',$response['Merchant_Information']); 
           $data =  array('order_id'=>$transactionRelatedInformation[1],'ref_num'=>$transactionResponse[1]);
           $order_id=(!empty($traderRelated[3])&&$traderRelated[3]!="abc")?$traderRelated[3]:NULL;
            $this->load->Model('Admin_mdl');
           $this->Admin_mdl->save_transaction_details($transactionResponse[1],$traderRelated[2],$order_id);
        }
     
      $this->load->view('trader/success',$data);
    }


    function transactionfailure(){
        $networkOnlineObject = new NetworkonlieBitmapPaymentIntegration($this->networkOnlineArray);
           $response = $networkOnlineObject->decryptData($_REQUEST['responseParameter'],$this->mKey,$this->iv);
           $transactionResponse = explode('|',$response['Transaction_Response']);
         
        $this->load->view('trader/failed');
    }
    
}
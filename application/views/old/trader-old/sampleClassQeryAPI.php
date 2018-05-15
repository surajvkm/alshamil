<?php 
/*
* 2017 Abzer Technology Solutions Query API Webserivce Sample Class
*
*  NOTICE OF LICENSE
*
*
*  DISCLAIMER
*
* 
*  @author Abzer Developers <info@abzer.com>
*  @copyright  Abzer Developers
*  @license   
*  
*/ 
class NetworkonlieQueryAPI {
	  
	  public $encryptMethod =  MCRYPT_RIJNDAEL_128;
	  public $encryptMode   =  MCRYPT_MODE_CBC;
	  
	  //Define the property values 
	  public $merchantId;
	  public $merchantKey;	
	  public $iv;
	  public $collaboratorId;
	  public $url;
	  public $blockExistenceIndicator; 
	
  	  //Define the Block Existence Indicator for Bitmap 
	  public $transactionDataBlock = true;  // Transaction Data Block  ==> This is mandatory block  , 1
	
	  // Define the Field Existence Indicator for the Transaction Data Block , All the fields are mandatory * 
	  public $ReferenceID    			 = ''; // Optional Value 
	  public $merchantOrderNumber 	     = ''; // merchantOrderNumber which is a Mandatory filed  
	  public $transactionType 	         = ''; // Optional Value , which is the same as the Transaction Type	while doing a Transaction 
	
	
	  public function __construct(){
		
		// Get the arguments of the class which is an array , assigned with key and property values 
		$arguments = func_get_args();
		
		if(!empty($arguments)){
			
			foreach($arguments as $argumentsArray){
				
				// Set the property for Transaction Array 
				if(!empty($argumentsArray['Field_Existence_Indicator_Transaction']))
					$this->transactionArray = array_filter($argumentsArray['Field_Existence_Indicator_Transaction']);
				
				// Case 0 
				// Assiging the property values , This is for Network Online 
				foreach($argumentsArray['Network_Online_setting'] as $key => $property){
					if(property_exists($this, $key))
						$this->{$key} = $property;
				}
				// Case 1 : <Block Existence Indicator> Bitmap values 
				// Assiging the property values for the Block Existence Indicator 
				foreach($argumentsArray['Block_Existence_Indicator'] as $key => $property){
					if(property_exists($this, $key))
						$this->{$key} = $property;
				}
				// Case 2 : <Field Existence Indicator for the Block Transaction> Bitmap values 
				// Assiging the property values for the Field Existence Indicator for the Block 
				foreach($argumentsArray['Field_Existence_Indicator_Transaction'] as $key => $property){
					if(property_exists($this, $key))
						$this->{$key} = $property;
				}
			}
		}
		
				// Block Existence Indicator Bitmap property
				$this->blockExistenceIndicator 	= $this->setblockExistenceIndicator();
				
				// Transaction Data Block Properties
				$this->TransactionFieldExistenceIndicator   = $this->setTransactionFieldExistenceIndicator();
				$this->TransactionData   					= join('|',$this->transactionArray);
				$this->TransactionDataBlock1   				= $this->TransactionFieldExistenceIndicator.'|'.$this->TransactionData;

				// Block_Existence_Indicator Bit map and DataBlock`s Array  
				$this->DataBlocksArray       				= array(
																	'DataBlockBitmap' => $this->blockExistenceIndicator,
																	'DataBlock1' 	  => $this->TransactionDataBlock1,
																	);
				$this->beforeEncryptionString 				= join('||',array_filter($this->DataBlocksArray));
				$this->EncryptedString 					    = $this->encryptData($this->beforeEncryptionString,$this->merchantKey,$this->iv);
				$this->NeoPostData                          = $this->merchantId.'||'.$this->collaboratorId.'||'.$this->EncryptedString;
				
				if(!$this->url)
					$this->WebserivceUrl = str_replace('sampleClassQeryAPI.php','',$this->baseurl().'InvokePMTBitMapWebService_test.xml');
				else
					$this->WebserivceUrl = str_replace('sampleClassQeryAPI.php','',$this->baseurl().'InvokePMTBitMapWebService_live.xml');
				
				$this->neoResonse 						    = $this->getQueryAPIRespose($this->NeoPostData);
				
				if($this->neoResonse['return']!='')
					$responseParameter   = $this->decryptResponse($this->neoResonse['return']);
				else
					echo 'No Response from Netowrk Online'; // Send mail to the administrator
						
				$this->neoapi['response'] = $responseParameter;
				// This neoapi response array value consist all the response data from network online
	  }	 
			
   /** 
	 * setblockExistenceIndicator Function which is used to return the Block Existence Indicator Bitmap  
	 * Function PARAMETERS : NULL 	
	 * returns : The Block Existence Indicator Bitmap : String 
   */
	public function setblockExistenceIndicator(){
			$blockExistenceIndicator  = '';
			// DataBlock 1 transactionDataBlock
			$blockExistenceIndicator .= $this->transactionDataBlock ? '1' : '0';
		return $blockExistenceIndicator;
	}		
	
	// Function setTransactionFieldExistenceIndicator Filed Existence Indicator (BEI) 
	// for Transaction Block Data 
	/*
	 * setTransactionFieldExistenceIndicator 
	 * Get all the required property values form the constructor to generate the Bitmap value and the POSTING data 
	   for the Transaction Block Data, Check if the transactionDataBlock is set to true then generate the Bitmap values 
	 * @returns Bitmap value for the Transaction Block Data 
	 * 
	 */
	public function setTransactionFieldExistenceIndicator(){
		
		// Check if the transactionDataBlock is set true 
		if($this->transactionDataBlock){
			
				$transactionFieldEI = '';
				// Filed 1 ReferenceID For Transaction Data Block 1
				$transactionFieldEI .= $this->ReferenceID ? '1':'0';
				// Filed 2 Merchant Order Number For Transaction Data Block 1
				$transactionFieldEI .= $this->merchantOrderNumber ? '1':'0';
				// Filed 3 Transaction Type For Transaction Data Block 1
				$transactionFieldEI .= $this->transactionType ? '1':'0';
			
			return $transactionFieldEI; 	
		}else{
			return '000';
		}
		
	}
	
	/** AddLog Function which is used to log the data 
	 * Function PARAMETERS  : 2 	
     * @global string     $message          Message content which has to be looged 
     * @global severity   $severity         Log Number 
	 * returns : logs the content to the logs.txt file  
     */
	public static function AddLog($message, $severity = 2){
			$fp 	 = fopen('neologs.txt', 'a+');
			$message = strip_tags($message);
			$message = htmlentities((string)$message, ENT_QUOTES, 'utf-8');
			fwrite($fp, "\n".'['.(int)$severity.'] '.$message);
			fclose($fp);
	}
	
	/**
	* Encrypts data with required encryption algorithm
	* @param string $data string which needs to be encrypted 			
	* @param string $key  key to encrypt data
	* @param string $iv   initializes CBC encryption
	* @return string 	  encrypted string
	*/
	public function encryptData( $data, $key, $iv ){
		
			$enc  				= $this->encryptMethod;        
			$mode 				= $this->encryptMode;
			$size 				= mcrypt_get_block_size( $enc, $mode );

			$pad  				= $size - ( strlen( $data ) % $size );
			$padtext 			= $data . str_repeat( chr( $pad ), $pad );
			$crypt				= mcrypt_encrypt( $enc, base64_decode( $key ), $padtext, $mode, $iv );      
			$data    			= base64_encode( $crypt ); 
		return $data;
	}  	
	/**
	* Decrypts data with required encryption algorithm
	* @param string $responseParameter string which needs to be de-crypted 			
	* @return Array with formated KEY & VALUES 	  
	*/
	public function decryptResponse( $responseParameter ){
		
		if($responseParameter){
			
			$encrypt_key  = $this->merchantKey;
			$merchantId   = $this->merchantId;
			$enc   	 	  = MCRYPT_RIJNDAEL_128;
			$mode  	      = MCRYPT_MODE_CBC;
			$iv    	      = "0123456789abcdef";
			
			//list($encryptString) = explode("||", $responseParameter);
				$EncText = base64_decode($responseParameter);
				$padtext = mcrypt_decrypt($enc, base64_decode($encrypt_key), $EncText, $mode, $iv);
				$pad 	 = ord($padtext{strlen($padtext) - 1});	
				if ($pad > strlen($padtext)) {
				}	
				$text 	= substr($padtext, 0, -1 * $pad);
				
				$reponseArray 	  	 = explode("||",$text);
				
				$blockEI 			 = $reponseArray[0]; // It has to contains Seven indicators
				$bitmapString        = str_split($blockEI);
				$blockEIArrayKey     = array(
												'Transaction_Details', 			   	   //Same as Request 
												'Amount_Block',    					  // Transaction related information 
												'Status',    						 //  Transaction Status information 
												'Card_related_information',    		//   Merchant Information 
												'Fraud_Block',    			       //    Fraud Block 
												'DCC_Block'	    			      //     DCC Block 
											);	
				$bit 		  = 0;
				$blockEIArray = array();

				foreach($blockEIArrayKey as $blockValues){
					$blockEIArray[$blockValues] = $bitmapString[$bit];
					$bit++;
				}
				$blockEIArray = array_filter($blockEIArray);
				// Remove the first element from Array to map with the bit map values 
				array_shift($reponseArray);
				$resposeAssignedArray = array();
				$res 				  = 0;
				foreach($blockEIArray as $key => $value){
						$resposeAssignedArray[$key] =  $reponseArray[$res];
					$res++;
				}
						$TransactionResposeValue['text']		    = $merchantId.'||'.$text;;
						$TransactionResposeValue['merchantId']		= $merchantId;
						$TransactionResposeValue['DataBlockBitmap']	= $blockEI;
				foreach($blockEIArrayKey as $key => $value){
						if(isset($resposeAssignedArray[$value]))
							$TransactionResposeValue[$value] = $resposeAssignedArray[$value];
						else
							$TransactionResposeValue[$value] = 'NULL';
				}
		   return $TransactionResposeValue;			
			
		}else{
			return false;
		}
		
	}
	public function getQueryAPIRespose($NeoPostData){
		
			if($NeoPostData){
				
				$webServiceUrl 		= $this->WebserivceUrl;
				$context 		    = stream_context_create(array(
											'ssl' => array('verify_peer' => false,
														'verify_peer_name' => false,
														'allow_self_signed' => true)
											));					
				$client 			= new SoapClient( $webServiceUrl, 
														array( 'stream_context' => $context, 'trace' => 1 ) 
													 );
				$response 			= $client->__soapCall('invokeQueryAPI', 
												array(
														'requestparameters' => 
														array('requestparameters'=>$NeoPostData)) 
													);
				$array 				= (array) $response;
				
				return $array;
		}
	}
	
	// Function baseurl 
	// For Getting the base url of the file 
	/*
	 * baseurl 
	 * 
	 * @returns Base Url of the script where it is been uploaded 
	 * 
	 */	
	public function baseurl(){
		if(isset($_SERVER['HTTPS'])){
			$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		}
		else{
			$protocol = 'http';
		}
		return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}
		
	
// Class Closing 	  
}

$networkOnlineArray  	= array('Network_Online_setting' => array(
											'merchantKey'    => "L0Iml+JieUcBy8B6SQrT0zJlGp1l1E4vqYSWM1BhO9w=", 					 // "<YOUR_KEY>" Your key provided by network international
											'merchantId'     => '201611201000001', 					// <YOUR_MERCHANT_ID> Your merchant ID ex: 201408191000001
											'collaboratorId' => 'NI',	           	   // Constant used by Network Online international
											'iv' 			 => '0123456789abcdef',   // Used for initializing CBC encryption mode
											'url'	         => false                // Set to false if you are using testing environment , set to true if you are using live environment
								),
								'Block_Existence_Indicator' => array(
											'transactionDataBlock' => true
								),
								'Field_Existence_Indicator_Transaction' => array(
											'ReferenceID'  		   => '',            // Optional Value 
											'merchantOrderNumber'  => '', 			//  Merchant Order Number Mandatory field 
											'transactionType'      => ''           //   Optional Value 
								));

$networkOnlineAPIObject = new NetworkonlieQueryAPI($networkOnlineArray);

echo '<pre>';
	print_r($networkOnlineAPIObject);
echo '</pre>';


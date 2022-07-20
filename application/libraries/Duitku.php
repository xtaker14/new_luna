<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

class Duitku {
	// protected $role = ''; 
    public $config;
    public $payment_method = array(
        'VC'=>array(
            'type'=>'Credit Card',
            'name'=>'(Visa / Master Card / JCB)',
        ),
        'BC'=>array(
            'type'=>'Virtual Account',
            'name'=>'BCA Virtual Account',
        ),
        'M2'=>array(
            'type'=>'Virtual Account',
            'name'=>'Mandiri Virtual Account',
        ),
        'VA'=>array(
            'type'=>'Virtual Account',
            'name'=>'Maybank Virtual Account',
        ),
        'I1'=>array(
            'type'=>'Virtual Account',
            'name'=>'BNI Virtual Account',
        ),
        'B1'=>array(
            'type'=>'Virtual Account',
            'name'=>'CIMB Niaga Virtual Account',
        ),
        'BT'=>array(
            'type'=>'Virtual Account',
            'name'=>'Permata Bank Virtual Account',
        ),
        'A1'=>array(
            'type'=>'Virtual Account',
            'name'=>'ATM Bersama',
        ),
        'AG'=>array(
            'type'=>'Virtual Account',
            'name'=>'Bank Artha Graha',
        ),
        'NC'=>array(
            'type'=>'Virtual Account',
            'name'=>'Bank Neo Commerce/BNC',
        ),
        'BR'=>array(
            'type'=>'Virtual Account',
            'name'=>'BRIVA',
        ),
        'S1'=>array(
            'type'=>'Virtual Account',
            'name'=>'Bank Sahabat Sampoerna',
        ),
        'FT'=>array(
            'type'=>'Ritel',
            'name'=>'Pegadaian/ALFA/Pos',
        ),
        'A2'=>array(
            'type'=>'Ritel',
            'name'=>'POS Indonesia',
        ),
        'IR'=>array(
            'type'=>'Ritel',
            'name'=>'Indomaret',
        ),
        'OV'=>array(
            'type'=>'E-Wallet',
            'name'=>'OVO (Support Void)',
        ),
        'SA'=>array(
            'type'=>'E-Wallet',
            'name'=>'Shopee Pay Apps (Support Void)',
        ),
        'LF'=>array(
            'type'=>'E-Wallet',
            'name'=>'LinkAja Apps (Fixed Fee)',
        ),
        'LA'=>array(
            'type'=>'E-Wallet',
            'name'=>'LinkAja Apps (Percentage Fee)',
        ),
        'DA'=>array(
            'type'=>'E-Wallet',
            'name'=>'DANA',
        ),
        'SL'=>array(
            'type'=>'E-Wallet',
            'name'=>'Shopee Pay Account Link',
        ),
        'SP'=>array(
            'type'=>'QRIS',
            'name'=>'Shopee Pay',
        ),
        'LQ'=>array(
            'type'=>'QRIS',
            'name'=>'LinkAja',
        ),
        'NQ'=>array(
            'type'=>'QRIS',
            'name'=>'Nobu',
        ),
        'DN'=>array(
            'type'=>'Kredit',
            'name'=>'Indodana Paylater',
        ),
    );

	function __construct() {
        
        /** 
         * Check PHP version.
         */
        if (version_compare(PHP_VERSION, '5.6', '<')) {
            throw new Exception('PHP version >= 5.6 required');
        }

        // Check PHP Curl & 
        if (!function_exists('curl_init') || !function_exists('curl_exec')) {
            throw new Exception('Duitku::cURL library is required');
        }

        // Json decode capabilities.
        if (!function_exists('json_decode')) {
            throw new Exception('Duitku::JSON PHP extension is required');
        }

        // Configuration Duitku Config
        require_once 'duitku/Config.php';
        // Duitku Sanitizer Parameter
        require_once 'duitku/Sanitizer.php';
        // Duitku Request Curl
        require_once 'duitku/Request.php';
        // General Duitku-Pop Request
        require_once 'duitku/Pop.php';
        // General Duitku-API Request
        require_once 'duitku/Api.php'; 

        // $this->config = new \Duitku\Config("732B39FC61796845775D2C4FB05332AF", "D0001"); 
        $this->config = new \Duitku\Config(getenv('DUITKU_MERCHANT_KEY'), getenv('DUITKU_MERCHANT_CODE')); // 'YOUR_MERCHANT_KEY' and 'YOUR_MERCHANT_CODE' 
        $this->config->setApiKey(getenv("DUITKU_MERCHANT_KEY")); //'YOUR_MERCHANT_KEY';
        $this->config->setMerchantCode(getenv("DUITKU_MERCHANT_CODE")); //'YOUR_MERCHANT_CODE';
        $this->config->setSandboxMode(true);
        // $this->config->setDuitkuLogs(false); 
	}

    public function getPaymentMethodByAmount($payment_amount=null){
        $resp_pop = \Duitku\Pop::getPaymentMethod($payment_amount, $this->config); 
        $resp_pop = json_decode($resp_pop);

        if(!empty($resp_pop->paymentFee) && $resp_pop->responseMessage == 'SUCCESS'){ 
            $payment_method = array();
            
            $cntr = -1;
            foreach ($resp_pop->paymentFee as $key => $val) {
                $cntr++;
                $payment_method[$cntr] = $val;
                $payment_method[$cntr]->type = '';
                if(!empty($this->payment_method[$val->paymentMethod])){
                    $payment_method[$cntr]->type = $this->payment_method[$val->paymentMethod]['type'];
                }
            }
            return $resp_pop->paymentFee;
        }else{
            return false;
        }
    }

    public function getPaymentMethod($payment_code=null, $payment_amount=null){ 
        $payment_method = $this->payment_method;

        if(empty($payment_code)){
            return $payment_method;
        }

        if(!empty($payment_method[$payment_code])){ 
            $get_pop_payment = $this->getPaymentMethodByAmount($payment_amount); 
            $key_payment = array_search($payment_code, array_column($get_pop_payment, 'paymentMethod'));

            if($key_payment !== FALSE){
                $get_payment = $payment_method[$payment_code];
                $get_payment['code'] = $payment_code;
                $get_payment['fee'] = $get_pop_payment[$key_payment]->totalFee;
                return $get_payment; 
            }else{ 
                return false;
            }
        }
        
        return false;
    }

    public function paymentCallback($onPaymentSuccess, $onPaymentFailed)
    {
        try {
            // $amount = $this->input->post('amount');
            // $merchantOrderId = $this->input->post('merchantOrderId');
            // $productDetail = $this->input->post('productDetail');
            // $additionalParam = $this->input->post('additionalParam');
            // $paymentMethod = $this->input->post('paymentCode');
            // $resultCode = $this->input->post('resultCode');
            // $merchantUserId = $this->input->post('merchantUserId');
            // $reference = $this->input->post('reference');
            // $signature = $this->input->post('signature');
            // $spUserHash = $this->input->post('spUserHash'); // Shopee only

            $get_callback = \Duitku\Pop::callback($this->config);

            header('Content-Type: application/json');
            $res_callback = json_decode($get_callback);

            // var_dump($get_callback);
        
            return array(
                'result'=>true,
                'msg'=>'test', 
                'data'=>$res_callback, 
            );

            if ($res_callback->resultCode == "00") {
                // SUCCESS
                // Payment success
                // $this->onPaymentSuccess(
                //     $merchantOrderId,
                //     $productDetail,
                //     $amount,
                //     $paymentMethod,
                //     $spUserHash,
                //     $reference,
                //     $additionalParam
                // );

                if (is_callable($onPaymentSuccess)) {
                    call_user_func($onPaymentSuccess, $res_callback);
                }
            } else if ($res_callback->resultCode == "01") {
                // FAILED
                // Payment failed or expired
                // $this->onPaymentFailed(
                //     $merchantOrderId,
                //     $productDetail,
                //     $amount,
                //     $paymentMethod,
                //     $spUserHash,
                //     $reference,
                //     $additionalParam
                // );

                if (is_callable($onPaymentFailed)) {
                    call_user_func($onPaymentFailed, $res_callback);
                }
            } else {
                // FAILED
                // Bad parameter
                return array(
                    'result'=>false,
                    'msg' => 'Bad parameter', 
                );
            }

        } catch (\Exception $ex) {
            return array(
                'result'=>false,
                'msg'=>$ex->getMessage(),
            );
        }
    }

    // /**
    //  * @param string $orderId Nomor transaksi dari merchant
    //  * @param string $productDetail Keterangan detil produk
    //  * @param int $amount Jumlah nominal transaksi
    //  * @param string $paymentCode Metode Pembayaran
    //  * @param string|null $shopeeUserHash Jika menggunakan ShopeePay
    //  * @param string $reference Nomor referensi transaksi dari DuitkuProcessor
    //  * @param string|null $additionalParam
    //  */
    // protected function onPaymentSuccess(
    //     string $orderId,
    //     string $productDetail,
    //     int $amount,
    //     string $paymentCode,
    //     ?string $shopeeUserHash,
    //     string $reference,
    //     ?string $additionalParam
    // ): void
    // {
    //     //
    // }

    // /**
    //  * @param string $orderId Nomor transaksi dari merchant
    //  * @param string $productDetail Keterangan detil produk
    //  * @param int $amount Jumlah nominal transaksi
    //  * @param string $paymentCode Metode Pembayaran
    //  * @param string|null $shopeeUserHash Jika menggunakan ShopeePay
    //  * @param string $reference Nomor referensi transaksi dari DuitkuProcessor
    //  * @param string|null $additionalParam
    //  */
    // protected function onPaymentFailed(
    //     string $orderId,
    //     string $productDetail,
    //     int $amount,
    //     string $paymentCode,
    //     ?string $shopeeUserHash,
    //     string $reference,
    //     ?string $additionalParam
    // ): void
    // {
    //     //
    // }
}

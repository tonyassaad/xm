<?php
  namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\client;
use Illuminate\Support\Facades\Storage;
use App\Mail\CompanySymbolEmail;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

 class ApiCallService{
 
 public static function fetchhistoricalQuotes($data=[]){ 
	 return	self::fetchCompanyData($data);
	}


private static function buildUrl($companySymbol,$startDate,$endDate) {
    return "https://www.quandl.com/api/v3/datasets/WIKI/{$companySymbol}.csv?order=asc&start_date={$startDate}&end_date={$endDate}/";
}

public static function fetchCompanyData($data) {
	$curl = curl_init();
	$request_headers = array();
	$request_headers[] = 'Content-Type: text/csv';
	$request_headers[] = 'api_key: cQqssnA_4RswMcQypwxi';
	$companySymbol=$data['company_symbol'];
	$startDate=$data['startDate'];
	$endDate=$data['endDate'];

	curl_setopt_array($curl, array(
		CURLOPT_URL =>self::buildUrl($companySymbol,$startDate,$endDate)  ,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_TIMEOUT => 30000,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => $request_headers
	));
 
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
		echo "cURL Error:" . $err;
	} 
	else {
		$csvFileName=$companySymbol.'.csv';
 		Storage::disk('local')->put($csvFileName, $response);
	}

  return self::parseCsvFile($csvFileName);
   /*4) ​ Send an email using the submitted company’s name*/
	   $emailTo=$data['email'];
       self::doSendEmail($emailTo,$companySymbol,$startDate,$endDate);
}


public static function parseCsvFile($csvFile){
 
	  $filename = storage_path('/app/'.$csvFile);
    if(!file_exists($filename) || !is_readable($filename))
   	  return FALSE;
		$header = NULL;
		$data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {    $delimiter=',';
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}


/*I tried to use guzzle but it failed during installation*/
 private function getCall($url){
    $client = new Client(); //GuzzleHttp\Client
    $request = $client->get("https://www.quandl.com/api/v3/datasets/WIKI/AAPL.csv?order=asc&start_date=2003-01-01&end_date=2003-03-06");
     $response = $request->getBody();
    dd($response); 		
   }


public static function doSendEmail($emailTo,$companyName,$startDate,$endDate){
   $message = new CompanySymbolEmail(['company'=>$companyName,'start_date'=>$startDate,'end_date'=>$endDate]);
   Mail::to($emailTo)->queue($message);
}

}
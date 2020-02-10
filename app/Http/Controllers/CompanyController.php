<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Validators\CompanyFormValidator;
use App\Services\ApiCallService;

class CompanyController extends Controller
{

 public function index(){
 	return view('company.company_symbol');
 }

/*1) ​ Validate the form both on ​ client ​ and ​ server ​ side*/
private function validateInput($input){
		$input->validate([
		'company_symbol' => ['required', 'string', 'max:255'],
		'email' => ['required', 'email', 'max:255'],
		'startDate' => ['required' ,'date'],
		'endDate' => ['required' ,'date'],  
		]); 
 
}


/*2) ​ Display on screen the historical quotes*/

private function fetchistoricalQuotes($data) {
	return ApiCallService::fetchCompanyData($data);
}

public function getHistoricalQuotes(Request $request) {
		$this->validateInput($request);
		$data = $this->fetchistoricalQuotes($request->post());
		if(empty($data)){
			return 'No Data Available';
		}
		 return view('company.company_historical_quotes')->with('startDate' ,$request->post('startDate'))
		->with('endDate',$request->post('endDate'))
	    ->with('companyName',$request->post('company_symbol'))
		->with('companyHistory', $data); 	
	

	}

public function displayChart($companySymbol,$startDate,$endDate) {
	$data = $this->fetchistoricalQuotes(['company_symbol'=>$companySymbol,'startDate'=>$startDate,'endDate'=>$endDate]);
	 foreach ($data as $key => $value) {
		$openCloseData['open'][]=$value['Open'];
		$openCloseData['close'][]=$value['Close'];
	 }   
 
  return view('company.company_chart')->with('open',$openCloseData['open'])->with('close',$openCloseData['close']);
 }

}
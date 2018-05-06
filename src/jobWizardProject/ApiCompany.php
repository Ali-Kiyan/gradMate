<?php

namespace jobWizardProject;
// session_start();
// require_once __DIR__ . '../../../Views/Template/includedFunctions.php';
require_once '../vendor/autoload.php';
require_once __DIR__ . '/Company.php';


class ApiCompany{

    private $Api_Token = "eFaPOGH7H2sFl1S2roAM8SE50WkcJQXrACJfSYOu";
    private $host = "api.companieshouse.gov.uk";
    private $Api_URL = 'https://api.companieshouse.gov.uk/search/companies?q=';
    private $endpoint = 'https://api.companieshouse.gov.uk/company/';
    private $ch,$Company_Number,$Current_Company;

    // FETCHING General Info About Company
    public function fetchGeneralInfo($Company_Name) {
      $this->ch = curl_init();
      // Disable SSL verification
      curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
      // Will return the response, if false it print the response
      curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
      // Cleaning and preparing the URL
      $Company_Name = trim($Company_Name);

      $Company_Name = urlencode($Company_Name);
      $this->Api_URL .= $Company_Name;
      curl_setopt($this->ch, CURLOPT_URL,$this->Api_URL);

      curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
          "Host: $this->host",
          "Authorization: $this->Api_Token"
          ));
      // Execute
      $result=curl_exec($this->ch);
      //parsing data from normal string to json
      $result = json_decode($result);
      return $result;
    }

    // FETCHING OUTDATED COMPANY BY COMPARING EXISTING COMPANY LIST AND NEWLY ADDED LIST

    public function fetchCompanyInfo($company)
    {
      //getting the closest match from the API
      $this->Company_Number= $company->items[0]->company_number;
      $this->endpoint .= $this->Company_Number;

      curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
      // Will return the response, if false it print the response
      curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
      // Set the url
      curl_setopt($this->ch, CURLOPT_URL, $this->endpoint);

      curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
          "Host: $this->host",
          "Authorization: $this->Api_Token"
          ));
      // Execute
      $result=curl_exec($this->ch);
      // Closing
      curl_close($this->ch);

      $companyDetail = json_decode($result, true);
      $this->Current_Company['Company_Name'] = $companyDetail['company_name'];
      $this->Current_Company['Date_Added'] = $companyDetail['date_of_creation'];
      $this->Current_Company['County'] = $companyDetail['registered_office_address']['locality'];
      $this->Current_Company['Town'] = $companyDetail['registered_office_address']['address_line_2'];
      foreach($companyDetail['sic_codes'] as $sicCode){
      $industryCodes .= " $sicCode";
    }
    if(isset($industryCodes)){
      $this->Current_Company['Industry'] = "Industry SIC codes = $industryCodes";
    }

      $result = new Company($this->Current_Company);
      return $result;
    }


}

<?php
    include "db_conn.php";
    /*require 'vendor/autoload.php';
    use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
    use Google\Cloud\RecaptchaEnterprise\V1\Event;
    use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
    use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

    function create_assessment(string $siteKey, string $token, string $project):void {
        $client = new RecaptchaEnterpriseServiceClient();
        $projectName = $client->projectName($project);
  
        $event = (new Event())
            ->setSiteKey($siteKey)
            ->setToken($token);
  
        $assessment = (new Assessment())
            ->setEvent($event);
  
        try {
            $response = $client->createAssessment(
                $projectName,
                $assessment
            );
  
            // You can use the score only if the assessment is valid,
            // In case of failures like re-submitting the same token, getValid() will return false
            if ($response->getTokenProperties()->getValid() == false) {
                printf('The CreateAssessment() call failed because the token was invalid for the following reason: ');
                printf(InvalidReason::name($response->getTokenProperties()->getInvalidReason()));
            } else {
                printf('The score for the protection action is:');
                printf($response->getRiskAnalysis()->getScore());
            }
        }catch(exception $e){
            printf('CreateAssessment() call failed with the following error: ');
            printf($e);
        }
    }*/
    function GetResponse(){
        $secret_key = '6LdSr4ofAAAAAKOzoI17Yj-FXgGqg_QIVqMb6xwd';
        //gets captcha response from google, response will be a json
        $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);
        //decodes the json into a php class
        $responseData = json_decode($response);
        if($responseData["success"]){
            return true;
        }else{
            return false;
        }
    }
    
    
?>
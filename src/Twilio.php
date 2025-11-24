<?php

namespace App\Service;

use DateTime;
use Twilio\Rest\Client;
class TwilioService
{
    public function sendVoiceOTP($recipientPhoneNumber, $otpCode,$choice)
    {
        $accountSid = $_ENV['TWILIO_ACCOUNT_SID'];
        $authToken = $_ENV['TWILIO_AUTH_TOKEN'];
        $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
        $client = new Client($accountSid, $authToken);
      if($choice=="1"){
        $call = $client->calls->create(
            $recipientPhoneNumber,
            
            $twilioPhoneNumber, 
            [
                'twiml' => '<Response>
                <Say>
                    welcome to banektek , your password is '.$otpCode.', one more time your password is '.$otpCode.'
                </Say>
              </Response>'
              ]
        ); }
        else {
            $call = $client->calls->create(
                $recipientPhoneNumber,
                
                $twilioPhoneNumber, 
                [
                    'twiml' => '<Response>
                    <Say>
                    Découvrez, votre carte vous attend à lagence. Merci!                    </Say>
                  </Response>'
                  ]
            );  
        }
        return $call->sid;
    }
    public function sendVoiceOTP2($recipientPhoneNumber)
    {
        $accountSid = $_ENV['TWILIO_ACCOUNT_SID'];
        $authToken = $_ENV['TWILIO_AUTH_TOKEN'];
        $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
        $client = new Client($accountSid, $authToken);
        $call = $client->calls->create(
            $recipientPhoneNumber,
            $twilioPhoneNumber, 
            [
                'twiml' => '<Response>
                <Say>
                Découvrez, votre carte vous attend à lagence. Merci!
                </Say>
              </Response>'
              ]
        );
        return $call->sid;
    }
  public function sendSMSOTP()
    {
        $accountSid = 'AC1002629dd6ad46d11b3f74684a9a4b44';
        $authToken = $_ENV['TWILIO_AUTH_TOKEN'];
        $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
        $client = new Client($accountSid, $authToken);
        $message = $client->messages->create("+21656789220", // to
        array(
          "from" => "+12135893838",
          "body" => "Découvrez, votre carte vous attend à l'agence. Merci!"
        )
      );
        return $message->sid;
    }
      

    //////////////////////////////////////

    public function sendSMSTransaction($montant, $type)
{
    $accountSid = 'AC4b0a0fcb2024b9529372033de6749d2a';
    $authToken = $_ENV['TWILIO_AUTH_TOKEN'];
    $twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'];
    $client = new Client($accountSid, $authToken);

    // Créer une nouvelle instance de DateTime
    $new_date = new \DateTime();

    // Formater la date et l'heure
    $formatted_date = $new_date->format('Y-m-d H:i');

    $messageBody = '';
    if ($type == "1") {
        $messageBody = 'Un Retrait de ' . $montant . ' DT a été effectué le ' . $formatted_date . '.';
    } else {
        $messageBody = 'Un Versement de ' . $montant . ' DT a été effectué le ' . $formatted_date . '.';
    }

    $message = $client->messages->create(
        "+21656789220", // to
        array(
            "from" => "+14406643117",
            "body" => $messageBody
        )
    );
    return $message->sid;
}

}
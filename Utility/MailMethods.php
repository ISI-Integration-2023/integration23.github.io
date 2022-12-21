<?php


require_once(dirname(__FILE__) . '/../plugin/sendgrid/vendor/autoload.php');

class MailMethods
{

    public static function SendEmail($to,$from,$subject,$content,$cc='',$bcc=''){
        include(dirname(__FILE__) . '/../config.php');
        $done=false;
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("".$from);
        $email->setSubject("".$subject);
        $email->addTo("".$to);
        if($cc!=''){
            $email->addTo("".$cc);
        }
        if($bcc!=''){
            $mail->addBcc(''.$bcc);
        }
        //$email->addContent( "text/plain", "and easy2222 to do anywhere, even with PHP" );
        $email->addContent( "text/html", "".$content);


        $sendgrid = new \SendGrid(''.$SENDGRID_APIKEY);
        try {
            $response = $sendgrid->send($email);
            $statuscode = ''. $response->statusCode();
            if($statuscode=='200' || $statuscode=='202'){ $done=true; }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $done;
    }
    

    /**
     * 2xx	2xx responses indicate a successful request	The request that you made is valid and successful.
*      200	OK	Your message is valid, but it is not queued to be delivered. †
*      202	ACCEPTED	Your message is both valid, and queued to be delivered.
*      4xx	4xx responses indicate an error with the request	There was a problem with your request.
*      400	BAD REQUEST	
*      401	UNAUTHORIZED	You do not have authorization to make the request.
*      403	FORBIDDEN	
*      404	NOT FOUND	The resource you tried to locate could not be found or does not exist.
*      405	METHOD NOT ALLOWED	
*      413	PAYLOAD TOO LARGE	The JSON payload you have included in your request is too large.
*      415	UNSUPPORTED MEDIA TYPE	
*      429	TOO MANY REQUESTS	The number of requests you have made exceeds SendGrid’s rate limitations
*      5xx	5xx responses indicate an error made by SendGrid	An error occurred when SendGrid attempted to processes it.
*      500	SERVER UNAVAILABLE	An error occurred on a SendGrid server.
*      503	SERVICE NOT AVAILABLE	The SendGrid v3 Web API is not available
     */
    


     public static function GetBasicTemplateContent($msg){
        include(dirname(__FILE__) . '/../config.php');

        $content = file_get_contents($ROOT_PATH .'/AppData/EmailTemplate/templatebasic.html');
        $replacecontent = str_replace("[Your_Msg]",$msg,$content);
        return $replacecontent;
     }
}
?>

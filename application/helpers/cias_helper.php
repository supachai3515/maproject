<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function json_output($statusHeader,$response)
{
  $ci =& get_instance();
  $ci->output->set_content_type('application/json');
  $ci->output->set_status_header($statusHeader);
  $ci->output->set_output(json_encode($response));
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();

        $CI->load->library('email');

        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $CI->email->initialize($config);

        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;

        $CI = setProtocol();

        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();

        return $status;
    }
}

if(!function_exists('send_emali_template'))
{
    function send_emali_template($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;

        $CI = setProtocol();

        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject($detail["subject"]);
        $CI->email->bcc($detail["bcc_mail"]);
        $CI->email->message($CI->load->view($detail["template"], $detail, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();

        return $status;
    }
}

if(!function_exists('send_emali_template_gmail'))
{
    function send_emali_template_gmail($detail)
    {
        $data["data"] = $detail;
        $CI = &get_instance();

        //sendmail
        $email_config = array(
          'protocol'  => 'smtp',
          'smtp_host' => 'ssl://smtp.googlemail.com',
          'smtp_port' => '465',
          'smtp_user' => GMAIL_SMTP_USER,
          'smtp_pass' => GMAIL_SMTP_PASS,
          'mailtype'  => 'html',
          'starttls'  => true,
          'newline'   => "\r\n"
        );

        $CI->load->library('email', $email_config);
        $CI->email->from(GMAIL_EMAIL_FROM, GMAIL_FROM_NAME);
        $CI->email->bcc($detail["bcc_mail"]);
        $CI->email->to($detail["email"]);
        $CI->email->subject($detail["subject"]);
        $CI->email->message($CI->load->view($detail["template"], $detail, TRUE));
        $status = $CI->email->send();
        return $status;
    }
}


if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
        {
            $CI = get_instance();
            $CI->session->set_flashdata($status, $flashMsg);
        }
}

if(!function_exists('num2wordsThai'))
{
    function num2wordsThai($num)
    {   
        $num=str_replace(",","",$num);
        $num_decimal=explode(".",$num);
        $num=$num_decimal[0];
        $returnNumWord ="";
        $lenNumber=strlen($num);   
        $lenNumber2=$lenNumber-1;   
        $kaGroup=array("","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน","สิบ","ร้อย","พัน","หมื่น","แสน","ล้าน");   
        $kaDigit=array("","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ต","แปด","เก้า");   
        $kaDigitDecimal=array("ศูนย์","หนึ่ง","สอง","สาม","สี่","ห้า","หก","เจ็ต","แปด","เก้า");   
        $ii=0;   
        for($i=$lenNumber2;$i>=0;$i--)
        {   
            $kaNumWord[$i]=substr($num,$ii,1);   
            $ii++;   
        }

        $ii=0;   
        for($i=$lenNumber2;$i>=0;$i--)
        {   
            if(($kaNumWord[$i]==2 && $i==1) || ($kaNumWord[$i]==2 && $i==7)){   
                $kaDigit[$kaNumWord[$i]]="ยี่";   
            }else{   
                if($kaNumWord[$i]==2){   
                    $kaDigit[$kaNumWord[$i]]="สอง";        
                }   
                if(($kaNumWord[$i]==1 && $i<=2 && $i==0) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==6)){   
                    if($kaNumWord[$i+1]==0){   
                        $kaDigit[$kaNumWord[$i]]="หนึ่ง";      
                    }else{   
                        $kaDigit[$kaNumWord[$i]]="เอ็ด";       
                    }   
                }elseif(($kaNumWord[$i]==1 && $i<=2 && $i==1) || ($kaNumWord[$i]==1 && $lenNumber>6 && $i==7)){   
                    $kaDigit[$kaNumWord[$i]]="";   
                }else{   
                    if($kaNumWord[$i]==1){   
                        $kaDigit[$kaNumWord[$i]]="หนึ่ง";   
                    }   
                }   
            }   
            if($kaNumWord[$i]==0){   
                if($i!=6){
                    $kaGroup[$i]="";   
                }
            }   
            $kaNumWord[$i]=substr($num,$ii,1);   
            $ii++; 

            $returnNumWord.=$kaDigit[$kaNumWord[$i]].$kaGroup[$i];   
        }      
        if(isset($num_decimal[1])){
            $returnNumWord.="จุด";
            for($i=0;$i<strlen($num_decimal[1]);$i++){
                $returnNumWord.=$kaDigitDecimal[substr($num_decimal[1],$i,1)];  
            }
        }       
        return $returnNumWord;   
    }   
}

?>

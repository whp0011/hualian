<?php
/**
 * hualian工程
 *
 * DemoMailController.php文件
 *
 * User: Administrator
 * DateTime: 2015/1/4 13:10
 */

class DemoMailController extends BaseController{
    public function mail163(){
        $mail= new PHPMailer();
        $body= "N=594873950&ADSESSION=1321316731&ADTAG=CLIENT.QQ.3493_";
//采用SMTP发送邮件
        $mail->IsSMTP();
//邮件服务器
        $mail->Host       = "smtp.163.com";
        $mail->SMTPDebug  = 0;
//使用SMPT验证
        $mail->SMTPAuth   = true;
//SMTP验证的用户名称
        $mail->Username   = "***@163.com";
//SMTP验证的秘密
        $mail->Password   = "***";
//设置编码格式
        $mail->CharSet  = "utf-8";
//设置主题
        $mail->Subject    = "测试";
//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
//设置发送者
        $mail->SetFrom('***@163.com', 'e代宗师');
//采用html格式发送邮件
        $mail->MsgHTML($body);
//接受者邮件名称
        $mail->AddAddress("**@163.com", "test");//发送邮件
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }
} 
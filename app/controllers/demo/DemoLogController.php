<?php
/**
 * hualian工程
 *
 * DemoLogController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/16 14:11
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SwiftMailerHandler;
use Monolog\Handler\NativeMailerHandler;
class DemoLogController extends BaseController{

	public function writeLog(){
		Log::info('info message');
		$log = new Logger('name');
		$log->pushHandler(new StreamHandler(storage_path() . '/error.log', Logger::WARNING));

		$log->addWarning('Foo',array('error' => '错误信息1'));
		$log->addError('Bar');

		return 'write log success!';
//		$mailer = new NativeMailerHandler('whp0011@126.com', 'dear victim', 'whp0011@163.com');
	}

	public function sendMail(){
//		$sMail = new SwiftMailerHandler('whp0011@163.com','message', Logger::DEBUG);
		$to      = 'whp0011@163.com';
		$subject = 'the subject';
		$message = 'hello';
		$headers = 'From: webmaster@example.com' . "\r\n" .
			'Reply-To: webmaster@example.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}
} 
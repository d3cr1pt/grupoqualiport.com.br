<?php

//Class Auto-Loading && SubClasses Loading
require_once('./vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//GET Vars
$name = filter_input(INPUT_POST,'name');
$mail = filter_input(INPUT_POST,'email');
$phon = filter_input(INPUT_POST,'phone');
$mensagem = filter_input(INPUT_POST,'message');

//Temporary Vars
$MAIL_BODY = 
'<div style="border-radius: 5px; background-color: #f2f2f2;	padding: 20px;">'.
'<form>'.
'<img src="https://www.detutto.com.br/custom/domain_1/image_files/1142_photo_6747.png" style="width: 40%; margin-left: 30%; margin-right: 30%; margin-bottom: 15px;">'.
'<h2 style="width: 50%; margin-left: 25%; margin-right: 25%">Formulário de Contato</h2>'.
'<br><label for="var1" style="margin-left: 25%; "><b>Nome:</b></label>'.
'<br><input type="text" id="var1" name="var1" value="'.$name.'" disabled style="padding: 12px 20px;  margin: 8px 0;  display: inline-block;  border: 1px solid #ccc;  border-radius: 4px;  box-sizing: border-box; width: 50%; margin-left: 25%; margin-right: 25%;">'.
'<br><label for="var2" style="margin-left: 25%; "><b>Email:</b></label>'.
'<br><input type="text" id="var2" name="var2" value="'.$mail.'" disabled style="padding: 12px 20px;  margin: 8px 0;  display: inline-block;  border: 1px solid #ccc;  border-radius: 4px;  box-sizing: border-box; width: 50%; margin-left: 25%; margin-right: 25%; ">'.
'<br><label for="var3" style="margin-left: 25%; "><b>Telefone:</b></label>'.
'<br><input type="text" id="var3" name="var3" value="'.$phon.'" disabled style="padding: 12px 20px;  margin: 8px 0;  display: inline-block;  border: 1px solid #ccc;  border-radius: 4px;  box-sizing: border-box; width: 50%; margin-left: 25%; margin-right: 25%; ">'.
'<br><label for="var4" style="margin-left: 25%; "><b>Mensagem:<b></label>'.
'<br><textarea name="" id="" cols="20" rows="5" style=" width: 50%; margin-left: 25%; margin-right: 25%; background: #f2f2f2; border-radius: 5px; border: 1px solid #ccc; resize: none; padding: 4px 2px 4px 8px; " disabled>'.$mensagem.'</textarea>'.
'</form>'.
'</div>';

//Permanent Config Vars
define('MAIL_HOST','smtp.ingaia.com.br');
define('MAIL_PORT',587);
define('MAIL_USER','vendas@loideimoveis.com.br');
define('MAIL_PASS','135@mudar');
define('MAIL_NAME','Servidor de E-mail');
define('MAIL_SUBJ','Formulário de Contato');
define('MAIL_DEST','albertotrevisansp@gmail.com');
define('MAIL_TOME','Grupo Qualiport');
define('MAIL_TOYU',$name);
define('MAIL_REPL',$mail);
define('MAIL_TRUE',true);
define('MAIL_CHAR','UTF-8');
define('MAIL_LANG','br');
define('MAIL_BODY',$MAIL_BODY);
define('MAIL_WRAP',10);

//Mail Sending via SMTP Process
$mailer = 				new PHPMailer();
$mailer->				IsSMTP();
$mailer->CharSet = 		MAIL_CHAR; 	//Tipo de Codificação
$mailer->Port = 		MAIL_PORT; 	//Porta de Conexão
$mailer->SMTPAuth = 	MAIL_TRUE; 	//Informa se é protegido
$mailer->Host = 		MAIL_HOST; 	//Servidor de saida
$mailer->Username = 	MAIL_USER; 	//Usuário de Conexão
$mailer->Password = 	MAIL_PASS; 	//Senha de Conexão
$mailer->FromName = 	MAIL_NAME; 	//Nome do Usuário de Email
$mailer->From = 		MAIL_USER; 	//Usuário de Envio
$mailer->Subject = 		MAIL_SUBJ; 	//Assunto do Email
$mailer->Body = 		MAIL_BODY; 	//Contéudo do Email
$mailer->				SetLanguage(MAIL_LANG);
$mailer->				AddAddress(MAIL_DEST,MAIL_TOME);
$mailer->				AddReplyTo(MAIL_REPL,MAIL_TOYU);
$mailer->				IsHTML(MAIL_TRUE);
if(!$mailer->Send())
{
	header("Location: index.html?error=true");
	exit;
}
header("Location: index.html?error=false");

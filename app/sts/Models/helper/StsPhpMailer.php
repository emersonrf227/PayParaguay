<?php

namespace App\sts\Models\helper;

require_once('phpmailer/PHPMailer.php');
require_once('phpmailer/SMTP.php');
require_once('phpmailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class StsPhpMailer
{

    private $Resultado;
    private $DadosCredEmail;
    private $Dados;

    function getResultado()
    {
        return $this->Resultado;
    }


    public function emailPhpMailer(array $Dados, $host_id = null)
    {

        // echo " okokok";
        $this->Dados = $Dados;
        $credEmail = new \App\sts\Models\helper\StsRead();
        $credEmail->fullRead("SELECT host AS host,
                                     user AS usuario,
                                     password AS senha,
                                     smtpSecure AS smtpsecure,
                                     user AS email,
                                     nmSend AS nome,
                                     smtpPort AS porta
                                    FROM smtp LIMIT 1");

        $this->DadosCredEmail = $credEmail->getResultado();



        // var_dump($credEmail->getResultado());

        if ((isset($this->DadosCredEmail[0]['host'])) and (!empty($this->DadosCredEmail[0]['host']))) {
            $this->confEmail();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Necessário inserir as credencias do e-mail no administrativo para enviar e-mail!</div>";
            $this->Resultado = false;
        }
    }

    private function confEmail()
    {

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $this->DadosCredEmail[0]['host'];  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                             // Enable SMTP authentication
            $mail->CharSet = 'UTF-8';
            $mail->Username = $this->DadosCredEmail[0]['usuario'];                 // SMTP username
            $mail->Password = $this->DadosCredEmail[0]['senha'];                           // SMTP password
            if (isset($this->DadosCredEmail[0]['smtpsecure'])) {
                $mail->SMTPSecure = $this->DadosCredEmail[0]['smtpsecure'];                            // Enable TLS encryption, `ssl` also accepted
            }
            $mail->Port = $this->DadosCredEmail[0]['porta'];                                   // TCP port to connect to
            //Recipients
            $mail->setFrom($this->DadosCredEmail[0]['email'], $this->DadosCredEmail[0]['nome']);
            $mail->addAddress($this->Dados['dest_email'], $this->Dados['dest_nome']);     // Add a recipient
            //
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->Dados['titulo_email'];
            $mail->Body = $this->Dados['cont_email'];

            // var_dump($this->Dados['cont_email']);

            // $mail->AltBody = $this->Dados['cont_text_email'];

            if ($mail->send()) {
                //$_SESSION['msg'] = "<div class='alert alert-success'>E-mail enviado com sucesso!</div>";
                $this->Resultado = true;
                //    $this->saveMail($mail);

            } else {
                //$_SESSION['msg'] = "<div class='alert alert-danger'>Erro: E-mail não foi enviado com sucesso!</div>";
                $this->Resultado = false;
            }
        } catch (Exception $e) {
            $this->Resultado = false;
        }
    }




    private function saveMail($mail)
    {
        //You can change 'Sent Mail' to any other folder or tag
        $path = "{iliketechnology.com.br/imap/ssl/novalidate-cert}INBOX.Sent";
        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP

        $imapStream = imap_open($path, $this->DadosCredEmail[0]['usuario'], $this->DadosCredEmail[0]['senha']);
        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);
        // var_dump($this->DadosCredEmail[0]['usuario']);
        // return $result;
    }
}

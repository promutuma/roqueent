<?php

namespace App\Libraries;

class EmailLibrary
{
    public function sendEmail($to, $subject, $message)
    {

        $prepared_message =
            '
        <!DOCTYPE html>
            <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="x-apple-disable-message-reformatting">
                <title></title>
                
                <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
                <!-- Web Font / @font-face : BEGIN -->
                <!--[if mso]>
                    <style>
                        * {
                            font-family: \'Roboto\', sans-serif !important;
                        }
                    </style>
                <![endif]-->

                <!--[if !mso]>
                    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
                <![endif]-->

                <!-- Web Font / @font-face : END -->

                <!-- CSS Reset : BEGIN -->
                
                
                <style>
                    /* What it does: Remove spaces around the email design added by some email clients. */
                    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
                    html,
                    body {
                        margin: 0 auto !important;
                        padding: 0 !important;
                        height: 100% !important;
                        width: 100% !important;
                        font-family: \'Roboto\', sans-serif !important;
                        font-size: 14px;
                        margin-bottom: 10px;
                        line-height: 24px;
                        color:#8094ae;
                        font-weight: 400;
                    }
                    * {
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                        margin: 0;
                        padding: 0;
                    }
                    table,
                    td {
                        mso-table-lspace: 0pt !important;
                        mso-table-rspace: 0pt !important;
                    }
                    table {
                        border-spacing: 0 !important;
                        border-collapse: collapse !important;
                        table-layout: fixed !important;
                        margin: 0 auto !important;
                    }
                    table table table {
                        table-layout: auto;
                    }
                    a {
                        text-decoration: none;
                    }
                    img {
                        -ms-interpolation-mode:bicubic;
                    }
                </style>

            </head>

            <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
                <center style="width: 100%; background-color: #f5f6fa;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
                        <tr>
                        <td style="padding: 40px 0;">
                                <table style="width:100%;max-width:620px;margin:0 auto;">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center; padding-bottom:25px">
                                                <a href="#"><img style="height: 150px" src="' . base_url() . 'files/images/logo.png" alt="logo"></a>
                                                <p style="font-size: 14px; color: #036911; padding-top: 12px;">CAMERA20 POS</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width:100%;max-width:720px;margin:0 auto;background-color:#ffffff;">
                                    <tbody>
                                        <tr>
                                            <td style="padding: 30px 30px 20px">
                                                <p style="margin-bottom: 12px;">' . $message . '</p>
                                                <p style="margin-bottom: 10px;"><br><hr><br> Regards<br>CAMERA20 POS ICT Team -- <i>Automated Email</i></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table style="width:100%;max-width:620px;margin:0 auto;">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center; padding:25px 20px 0;">
                                                <p style="font-size: 10px; class="email-note">This is an automatically generated email please do not reply to this email.<br> If you face any issues, please contact us at camera20production@gmail.com</p>
                                                <br>
                                                <br>
                                                <p style="font-size: 10px;">Copyright © ' . date("Y") . ' CAMERA20 POS ICT. All rights reserved. <br> System Created By <a style="color: #036911; text-decoration:none;" href="https://www.linkedin.com/in/framutuma/">Franklin Mutuma</a> Information Director at CAMERA20 POS.</p>
                                                <P style="font-size: 10px;>P.S. Follow us on social media for exclusive updates and behind-the-scenes glimpses</P>
                                                <ul style="margin: 10px -4px 0;padding: 0;">
                                                    <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://web.facebook.com/CETRADKe"><img style="width: 30px" src="' . base_url() . '/files/images/brand-b.png" alt="brand"></a></li>
                                                    <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://twitter.com/camera20pro"><img style="width: 30px" src="' . base_url() . '/files/images/brand-e.png" alt="brand"></a></li>
                                                    <li style="display: inline-block; list-style: none; padding: 4px;"><a style="display: inline-block; height: 30px; width:30px;border-radius: 50%; background-color: #ffffff" href="https://www.youtube.com/c/camera20production"><img style="width: 30px" src="' . base_url() . '/files/images/brand-d.png" alt="brand"></a></li>
                                                </ul>
                                                <p style="padding-top: 15px; font-size: 10px;">This email was sent to you as an online user of <a style="color: #036911; text-decoration:none;" href="' . base_url() . ' ">CAMERA20 POS</a>. To update your emails preferences <a style="color: #036911; text-decoration:none;" href="' . base_url() . '"> contact us</a>.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </td>
                        </tr>
                    </table>
                </center>
            </body>
            </html>
        ';

        $email = \Config\Services::email();

        $email->setFrom('no_reply@eelam.co.ke', 'CAMERA20POS');
        $email->setTo($to);
        #$email->setCC('another@another-example.com');
        #$email->setBCC('them@their-example.com');
        $email->setSubject($subject);
        $email->setMessage($prepared_message);

        try {
            // Send the email
            $email->send();

            // Log success
            log_message('info', 'Email with subject ' . $subject . ' successfully sent to ' . $to);

            // Return success response
            return true;
        } catch (\Throwable $e) {
            // Log error
            log_message('error', 'Failed to send email. Error: ' . $e->getMessage());

            // Re-throw the exception
            throw $e;
        }
    }
}

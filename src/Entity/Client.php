<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Exception;

require 'C:/xampp/htdocs/vendor/autoload.php';
require 'C:/xampp/htdocs/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{


      //////////////////:
      function sendMail($nom,$email,$username,$password){

  
    
        // Include the Composer autoloader
        require 'C:/xampp/php/ext/src/Exception.php';
        require 'C:/xampp/php/ext/src/PHPMailer.php';
        require 'C:/xampp/php/ext/src/SMTP.php';
    
      
      // Creer une nouvelle instance de PHPMailer
      $mail = new PHPMailer(true);                            // true active les exceptions en cas d'erreur
      
      try {
          // Configuration du serveur SMTP
          $mail->SMTPDebug = 0; // Activer le debogage SMTP
          $mail->isSMTP(); // Utiliser SMTP
          $mail->Host = 'smtp.gmail.com'; // Nom d'hôte du serveur SMTP
          $mail->SMTPAuth = true; // Activer l'authentification SMTP
          $mail->Username = '***'; // Votre adresse email Gmail
          $mail->Password = '**'; // Votre mot de passe Gmail ou le mot de passe d'application si l'authentification à deux facteurs est activée
          $mail->SMTPSecure = 'tls'; // Utiliser TLS
          $mail->Port = 587; // Port pour TLS/STARTTLS
          
          $mail->setFrom('***', 'Banektek - Team');
          $mail->addAddress($email, $nom); // Ajouter un destinataire
          $mail->isHTML(true); // Activer le format HTML// Activer le format HTML
          $mail->SMTPDebug;
          $mail->Subject = ' Bienvenue chez Banektek ! Decouvrez votre nouvel espace client.';
    $mail->Body = "
    <!DOCTYPE html>
    <html xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office' lang='en'>
    
    <head>
        <title></title>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!-->
        <link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900' rel='stylesheet' type='text/css'><!--<![endif]-->
        <style>
            * {
                box-sizing: border-box;
            }
    
            body {
                margin: 0;
                padding: 0;
            }
    
            a[x-apple-data-detectors] {
                color: inherit !important;
                text-decoration: inherit !important;
            }
    
            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
            }
    
            p {
                line-height: inherit
            }
    
            .desktop_hide,
            .desktop_hide table {
                mso-hide: all;
                display: none;
                max-height: 0px;
                overflow: hidden;
            }
    
            .image_block img+div {
                display: none;
            }
    
            @media (max-width:595px) {
    
                .desktop_hide table.icons-inner,
                .social_block.desktop_hide .social-table {
                    display: inline-block !important;
                }
    
                .icons-inner {
                    text-align: center;
                }
    
                .icons-inner td {
                    margin: 0 auto;
                }
    
                .image_block div.fullWidth {
                    max-width: 100% !important;
                }
    
                .mobile_hide {
                    display: none;
                }
    
                .row-content {
                    width: 100% !important;
                }
    
                .stack .column {
                    width: 100%;
                    display: block;
                }
    
                .mobile_hide {
                    min-height: 0;
                    max-height: 0;
                    max-width: 0;
                    overflow: hidden;
                    font-size: 0px;
                }
    
                .desktop_hide,
                .desktop_hide table {
                    display: table !important;
                    max-height: none !important;
                }
            }
        </style>
    </head>
    
    <body style='background-color: #f9f9f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
        <table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9;'>
            <tbody>
                <tr>
                    <td>
                        <table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad' style='padding-left:25px;width:100%;padding-right:0px;'>
                                                                    <div class='alignment' align='left' style='line-height:10px'>
                                                                        <div style='max-width: 158.125px;'><img src='https://992e367cfd.imgdist.com/pub/bfra/z8fvtcu3/kj7/508/190/logo.png' style='display: block; height: auto; border: 0; width: 100%;' width='158.125' alt='Alternate text' title='Alternate text'></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td class='column column-2' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:12px;line-height:120%;text-align:right;mso-line-height-alt:14.399999999999999px;'>&nbsp;</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-2' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad' style='width:100%;'>
                                                                    <div class='alignment' align='center' style='line-height:10px'>
                                                                        <div style='max-width: 575px;'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/1661/top_round_corner.png' style='display: block; height: auto; border: 0; width: 100%;' width='575' alt='Alternate text' title='Alternate text'></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-3' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #a9e0ff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:10px;'>
                                                                    <div style='color:#1678ac;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'><strong>Rapport des dépenses mensuels</strong></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-4' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;padding-top:10px;'>
                                                                    <div style='color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:17px;line-height:120%;text-align:left;mso-line-height-alt:20.4px;'>
                                                                        <p style='margin: 0;'>ID client:</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                    <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                    <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='image_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad' style='width:100%;'>
                                                                    <div class='alignment' align='center' style='line-height:10px'>
                                                                        <div style='max-width: 575px;'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/1661/barcode.png' style='display: block; height: auto; border: 0; width: 100%;' width='575' alt='Alternate text' title='Alternate text'></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-5' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                    <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-6' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                    <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='divider_block block-7' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div class='alignment' align='center'>
                                                                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                            <tr>
                                                                                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;'><span>&#8202;</span></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-5' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                    <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:13px;line-height:120%;text-align:center;mso-line-height-alt:15.6px;'>
                                                                        <p style='margin: 0;'>Date</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'>Solde initial au début du mois:</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'>54</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <div class='spacer_block block-4' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                    </td>
                                                    <td class='column column-2' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                    <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;'>
                                                                        <p style='margin: 0;'>Type</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'>Solde final à la fin du mois:</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'>54</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-6' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f15a5f; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                    <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:13px;line-height:120%;text-align:center;mso-line-height-alt:15.6px;'>
                                                                        <p style='margin: 0;'>Date</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                
                                                            </div></td>
                                                            </tr>
                                                        </table>
                                                        <div class='spacer_block block-3' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                    </td>
                                                    <td class='column column-2' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                    <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;'>
                                                                        <p style='margin: 0;'>Type</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'>I'm a new paragraph block.</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td class='column column-3' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#ffffff;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'>Montant</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                        <p style='margin: 0;'>I'm a new paragraph block.</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <div class='spacer_block block-3' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-7' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <div class='spacer_block block-1' style='height:60px;line-height:60px;font-size:1px;'>&#8202;</div>
                                                        <div class='spacer_block block-2' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-8' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ea5256; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                    <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:17px;line-height:120%;text-align:center;mso-line-height-alt:20.4px;'>
                                                                        <p style='margin: 0;'>Cher(e) Client ,</p>
                                                                        <p style='margin: 0;'>Merci pour votre fidélité à Banektek ! Votre confiance est notre plus grande récompense. Nous sommes là pour vous à chaque étape de votre parcours financier. Merci de choisir Banektek.</p>
                                                                        <p style='margin: 0;'>Bien à vous,</p>
                                                                        <p style='margin: 0;'>L'équipe Banektek</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <div class='spacer_block block-2' style='height:40px;line-height:40px;font-size:1px;'>&#8202;</div>
                                                        <div class='spacer_block block-3' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-9' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad' style='width:100%;'>
                                                                    <div class='alignment' align='center' style='line-height:10px'>
                                                                        <div style='max-width: 575px;'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/1661/down_round.png' style='display: block; height: auto; border: 0; width: 100%;' width='575' alt='Alternate text' title='Alternate text'></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-10' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad' style='padding-bottom:15px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                    <div class='alignment' align='center' style='line-height:10px'>
                                                                        <div class='fullWidth' style='max-width: 373.75px;'><img src='https://992e367cfd.imgdist.com/pub/bfra/z8fvtcu3/kj7/508/190/logo.png' style='display: block; height: auto; border: 0; width: 100%;' width='373.75' alt='Alternate text' title='Alternate text'></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-11' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='divider_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div class='alignment' align='center'>
                                                                        <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='95%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                            <tr>
                                                                                <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px dashed #BBBBBB;'><span>&#8202;</span></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-12' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='social_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div class='alignment' align='center'>
                                                                        <table class='social-table' width='168px' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;'>
                                                                            <tr>
                                                                                <td style='padding:0 5px 0 5px;'><a href='https://www.facebook.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/facebook@2x.png' width='32' height='32' alt='Facebook' title='Facebook' style='display: block; height: auto; border: 0;'></a></td>
                                                                                <td style='padding:0 5px 0 5px;'><a href='https://www.twitter.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/twitter@2x.png' width='32' height='32' alt='Twitter' title='Twitter' style='display: block; height: auto; border: 0;'></a></td>
                                                                                <td style='padding:0 5px 0 5px;'><a href='https://www.instagram.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/instagram@2x.png' width='32' height='32' alt='Instagram' title='Instagram' style='display: block; height: auto; border: 0;'></a></td>
                                                                                <td style='padding:0 5px 0 5px;'><a href='https://www.linkedin.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/linkedin@2x.png' width='32' height='32' alt='LinkedIn' title='LinkedIn' style='display: block; height: auto; border: 0;'></a></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                            <tr>
                                                                <td class='pad'>
                                                                    <div style='color:#626262;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:12px;line-height:120%;text-align:center;mso-line-height-alt:14.399999999999999px;'>
                                                                        <p style='margin: 0;'><strong>Service Client :</strong> En cas de questions ou de préoccupations, notre équipe du service client est là pour vous aider.</p>
                                                                        <p style='margin: 0;'>Téléphone : +21671926635</p>
                                                                        <p style='margin: 0;'>Email :&nbsp;</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class='row row-13' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;'>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                            <tbody>
                                                <tr>
                                                    <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                        <table class='icons_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                            <tr>
                                                                <td class='pad' style='vertical-align: middle; color: #1e0e4b; font-family: 'Inter', sans-serif; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;'>
                                                                    <table width='100%' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                        <tr>
                                                                            <td class='alignment' style='vertical-align: middle; text-align: center;'><!--[if vml]><table align='center' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
                                                                                <!--[if !vml]><!-->
                                                                                <table class='icons-inner' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;' cellpadding='0' cellspacing='0' role='presentation'><!--<![endif]-->
                                                                                    <tr>
                                                                                        <td style='vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;'><a href='http://designedwithbeefree.com/' target='_blank' style='text-decoration: none;'><img class='icon' alt='Beefree Logo' src='https://d1oco4z2z1fhwp.cloudfront.net/assets/Beefree-logo.png' height='32' width='34' align='center' style='display: block; height: auto; margin: 0 auto; border: 0;'></a></td>
                                                                                        <td style='font-family: 'Inter', sans-serif; font-size: 15px; font-weight: undefined; color: #1e0e4b; vertical-align: middle; letter-spacing: undefined; text-align: center;'><a href='http://designedwithbeefree.com/' target='_blank' style='color: #1e0e4b; text-decoration: none;'>Designed with Beefree</a></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table><!-- End -->
    </body>
    
    </html>
    ";
    
          $mail->AltBody = 'Contenu de votre e-mail en texte brut';
      
          $mail->send();
        
          //header ('Location:verifmail.php');
          //echo 'E-mail envoye avec succès';
      } 
      catch (Exception $e) {
          echo 'Echec de l\'envoi de l\'e-mail : ', $mail->ErrorInfo;
      }
    }
    /////////////////////
    ////////////////////////////////////
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dob = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $cin = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $num_tel = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $document = null;

    #[ORM\Column(length: 255)]
    private ?string $signature = null;

    #[ORM\Column(length: 255)]
    private ?string $profession = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $last_login = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Compte::class)]
    private Collection $comptes;

    #[ORM\OneToMany(mappedBy: 'id_client', targetEntity: Reclamation::class)]
    private Collection $reclamations;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Demande::class)]
    private Collection $demandes;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->reclamations = new ArrayCollection();
        $this->date_creation = new \DateTime();
        $this->etat = "activer";
        //$this->generateUsername();
        $this->generateStrongPassword(8);
        $this->last_login = new \DateTime();
        $this->demandes = new ArrayCollection();
    }
  
    function generateStrongPassword($length)
{
    $chars = '1234567890';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, strlen($chars) - 1)];
    }
  //  $passwordhash=password_hash("hamza",PASSWORD_DEFAULT);
    $this->password=$password;
    //$this->password = $password;
}


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDob(): ?\DateTimeInterface
    {
        return $this->dob;
    }

    public function setDob(\DateTimeInterface $dob): static
    {
        $this->dob = $dob;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->num_tel;
    }

    public function setNumTel(string $num_tel): static
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): static
    {
        $this->signature = $signature;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): static
    {
        $this->profession = $profession;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->last_login;
    }

    public function setLastLogin(\DateTimeInterface $last_login): static
    {
        $this->last_login = $last_login;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection<int, Compte>
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): static
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes->add($compte);
            $compte->setIdUser($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): static
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getIdUser() === $this) {
                $compte->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reclamation>
     */
    public function getReclamations(): Collection
    {
        return $this->reclamations;
    }

    public function addReclamation(Reclamation $reclamation): static
    {
        if (!$this->reclamations->contains($reclamation)) {
            $this->reclamations->add($reclamation);
            $reclamation->setIdClient($this);
        }

        return $this;
    }

    public function removeReclamation(Reclamation $reclamation): static
    {
        if ($this->reclamations->removeElement($reclamation)) {
            // set the owning side to null (unless already changed)
            if ($reclamation->getIdClient() === $this) {
                $reclamation->setIdClient(null);
            }
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): static
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->setClient($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): static
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getClient() === $this) {
                $demande->setClient(null);
            }
        }

        return $this;
    }

      //////////////////:
       //////////////////:

    function sendMailImen($nom,$email,$transactions,$soldeFin,$soldeInt,$username,$code) 
    { include 'barcode.php';
        // Include the Composer autoloader
        require 'C:/xampp/php/ext/src/Exception.php';
        require 'C:/xampp/php/ext/src/PHPMailer.php';
        require 'C:/xampp/php/ext/src/SMTP.php';
    
      
      // Creer une nouvelle instance de PHPMailer
      $mail = new PHPMailer(true);                            // true active les exceptions en cas d'erreur
      $string = '"' . $code . '"';
            try {
          // Configuration du serveur SMTP
          $mail->SMTPDebug = 0;                                  // Activer le debogage SMTP (0 = desactive, 1 = messages de base, 2 = messages detailles)
          $mail->isSMTP();                                       // Utiliser SMTP
          $mail->Host = 'smtp.gmail.com';                        // Specifier le serveur SMTP
          $mail->SMTPAuth = true;                                // Activer l'authentification SMTP
          $mail->Username = 'imen.belhoula@esprit.tn';      // Nom d'utilisateur SMTP
          $mail->Password = 'nounoucycy';           // Mot de passe SMTP
          $mail->SMTPSecure = 'ssl'; // Utiliser SSL
$mail->Port = 465; // Port SSL Gmail

// Destinataire et expéditeur

$mail->setFrom('imen.belhoula@esprit.tn','Banektek - Team');
$mail->addAddress("***", $nom); // Ajouter un destinataire
$mail->Subject = 'Votre Sujet';

// Contenu de l'e-mail
$mail->isHTML(true); // Activer le format HTML
$mail->Subject = ' Bienvenue chez Banektek ! Découvrez votre nouvel espace client.';



// Données du code-barres
$string = $code;

$size = 50; // Taille du code-barres
$orientation = "horizontal";
$code_type = "code39";
$print = true;
$size_factor = 1; // Facteur de taille du code-barres

// Générer le code-barres
ob_start(); // Capture la sortie pour encoder en base64
barcode("", $code, $size, $orientation, $code_type, $print, $size_factor);
$image_data = ob_get_clean(); // Récupère les données de l'image générée

// Encodage de l'image en base64
$image_base64 = base64_encode($image_data);


// Ajouter l'image dans le corps de l'e-mail
$mail->Body .= "
   
<html >

<head>

    <meta>
    <meta>
    <link>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: inherit !important;
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
        }

        p {
            line-height: inherit
        }

        .desktop_hide,
        .desktop_hide table {
            mso-hide: all;
            display: none;
            max-height: 0px;
            overflow: hidden;
        }

        .image_block img+div {
            display: none;
        }

        @media (max-width:595px) {

            .desktop_hide table.icons-inner,
            .social_block.desktop_hide .social-table {
                display: inline-block !important;
            }

            .icons-inner {
                text-align: center;
            }

            .icons-inner td {
                margin: 0 auto;
            }

            .image_block div.fullWidth {
                max-width: 100% !important;
            }

            .mobile_hide {
                display: none;
            }

            .row-content {
                width: 100% !important;
            }

            .stack .column {
                width: 100%;
                display: block;
            }

            .mobile_hide {
                min-height: 0;
                max-height: 0;
                max-width: 0;
                overflow: hidden;
                font-size: 0px;
            }

            .desktop_hide,
            .desktop_hide table {
                display: table !important;
                max-height: none !important;
            }
        }
    </style>
</head>

<body style='background-color: #f9f9f9; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
    <table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f9f9f9;'>
        <tbody>
            <tr>
                <td>
                    <table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad' style='padding-left:25px;width:100%;padding-right:0px;'>
                                                                <div class='alignment' align='left' style='line-height:10px'>
                                                                    <div style='max-width: 158.125px;'><img src='https://992e367cfd.imgdist.com/pub/bfra/z8fvtcu3/kj7/508/190/logo.png' style='display: block; height: auto; border: 0; width: 100%;' width='158.125' alt='Alternate text' title='Alternate text'></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class='column column-2' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:12px;line-height:120%;text-align:right;mso-line-height-alt:14.399999999999999px;'>&nbsp;</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-2' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad' style='width:100%;'>
                                                                <div class='alignment' align='center' style='line-height:10px'>
                                                                    <div style='max-width: 575px;'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/1661/top_round_corner.png' style='display: block; height: auto; border: 0; width: 100%;' width='575' alt='Alternate text' title='Alternate text'></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-3' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #a9e0ff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:25px;padding-left:10px;padding-right:10px;padding-top:10px;'>
                                                                <div style='color:#1678ac;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;'>
                                                                    <p style='margin: 0;'><strong>Rapport des depenses mensuels</strong></p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-4' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;padding-top:10px;'>
                                                                <div style='color:#232323;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:17px;line-height:120%;text-align:left;mso-line-height-alt:20.4px;'>";
                                                                $mail->Body  .="<p style='margin: 0;'>CLIENT : ".$username."</p>";
                                                                $mail->Body.=" </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                            </td>
                                                        </tr>
                                                        </tr>
                                                    </table>
                                                    <table class='image_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad' style='width:100%;'>";

                                                            $mail->Body .= "<center><img alt='testing' src='data:image/png;base64," . $image_base64 . "' /></center>";
                                                            $mail->Body .=" </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-5' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-6' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-left:35px;padding-right:10px;'>
                                                                <div style='color:#ea5256;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:20px;line-height:120%;text-align:left;mso-line-height-alt:24px;'>&nbsp;</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='divider_block block-7' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div class='alignment' align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #dddddd;'><span>&#8202;</span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-5' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:13px;line-height:120%;text-align:center;mso-line-height-alt:15.6px;'>
                                                                   
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                    <p style='margin: 0;'>Solde a la fin du mois:</p>
                                                                    
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>
                                                                    <p style='margin: 0;'>Solde initial au debut du mois:</p>
                                                                    
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;'>
                                                                    <p style='margin: 0;'></p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class='spacer_block block-4' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                </td>
                                                <td class='column column-2' width='50%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;'>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>";
                                                                $mail->Body  .="<p style='margin: 0;'>".$soldeFin."</p>";
                                                                $mail->Body.="    </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-3' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                    <tr>
                                                        <td class='pad'>
                                                            <div style='color:#101112;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>";
                                                            $mail->Body  .="<p style='margin: 0;'>".$soldeInt."</p>";
                                                            $mail->Body.="    </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-6' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f15a5f; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:13px;line-height:120%;text-align:center;mso-line-height-alt:15.6px;'>
                                                                    <p style='margin: 0;'>Date</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#ffffff;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>";
                                                                    
                                                            
                                                                foreach ($transactions as $transaction) {
                                                                    $mail->Body .= "<p style='margin: 0;'>".$transaction->getDateTransaction()->format('m-d H:i')."</p>";
                                                                }
                                                            $mail->Body.="    </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class='spacer_block block-3' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                </td>
                                                <td class='column column-2' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;line-height:120%;text-align:center;mso-line-height-alt:16.8px;'>
                                                                    <p style='margin: 0;'>Type</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#ffffff;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>";
                                                                foreach ($transactions as $transaction) {
                                                                    $mail->Body .= "<p style='margin: 0;'>".$transaction->getType()."</p>";
                                                                }
                                                            $mail->Body.="    </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class='column column-3' width='33.333333333333336%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#ffffff;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:center;mso-line-height-alt:19.2px;'>
                                                                    <p style='margin: 0;'>Montant</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                            <div style='color:#ffffff;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;'>";
                                                            foreach ($transactions as $transaction) {
                                                                $mail->Body .= "<p style='margin: 0;'>".$transaction->getMontant()."</p>";
                                                            }
                                                        $mail->Body.="    </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class='spacer_block block-3' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-7' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <div class='spacer_block block-1' style='height:60px;line-height:60px;font-size:1px;'>&#8202;</div>
                                                    <div class='spacer_block block-2' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-8' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ea5256; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='paragraph_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:10px;padding-top:10px;'>
                                                                <div style='color:#ffffff;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:17px;line-height:120%;text-align:center;mso-line-height-alt:20.4px;'>
                                                                    <p style='margin: 0;'>Cher(e) Client ,</p>
                                                                    <p style='margin: 0;'>Merci pour votre fidelite a Banektek ! Votre confiance est notre plus grande recompense. Nous sommes la pour vous a chaque etape de votre parcours financier. Merci de choisir Banektek.</p>
                                                                    <p style='margin: 0;'>Bien a vous,</p>
                                                                    <p style='margin: 0;'>L'equipe Banektek</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class='spacer_block block-2' style='height:40px;line-height:40px;font-size:1px;'>&#8202;</div>
                                                    <div class='spacer_block block-3' style='height:30px;line-height:30px;font-size:1px;'>&#8202;</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-9' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad' style='width:100%;'>
                                                                <div class='alignment' align='center' style='line-height:10px'>
                                                                    <div style='max-width: 575px;'><img src='https://d1oco4z2z1fhwp.cloudfront.net/templates/default/1661/down_round.png' style='display: block; height: auto; border: 0; width: 100%;' width='575' alt='Alternate text' title='Alternate text'></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-10' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='image_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad' style='padding-bottom:15px;width:100%;padding-right:0px;padding-left:0px;'>
                                                                <div class='alignment' align='center' style='line-height:10px'>
                                                                    <div class='fullWidth' style='max-width: 373.75px;'><img src='https://992e367cfd.imgdist.com/pub/bfra/z8fvtcu3/kj7/508/190/logo.png' style='display: block; height: auto; border: 0; width: 100%;' width='373.75' alt='Alternate text' title='Alternate text'></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-11' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='divider_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div class='alignment' align='center'>
                                                                    <table border='0' cellpadding='0' cellspacing='0' role='presentation' width='95%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                        <tr>
                                                                            <td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px dashed #BBBBBB;'><span>&#8202;</span></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-12' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='social_block block-1' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div class='alignment' align='center'>
                                                                    <table class='social-table' width='168px' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block;'>
                                                                        <tr>
                                                                            <td style='padding:0 5px 0 5px;'><a href='https://www.facebook.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/facebook@2x.png' width='32' height='32' alt='Facebook' title='Facebook' style='display: block; height: auto; border: 0;'></a></td>
                                                                            <td style='padding:0 5px 0 5px;'><a href='https://www.twitter.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/twitter@2x.png' width='32' height='32' alt='Twitter' title='Twitter' style='display: block; height: auto; border: 0;'></a></td>
                                                                            <td style='padding:0 5px 0 5px;'><a href='https://www.instagram.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/instagram@2x.png' width='32' height='32' alt='Instagram' title='Instagram' style='display: block; height: auto; border: 0;'></a></td>
                                                                            <td style='padding:0 5px 0 5px;'><a href='https://www.linkedin.com' target='_blank'><img src='https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-only-logo-dark-gray/linkedin@2x.png' width='32' height='32' alt='LinkedIn' title='LinkedIn' style='display: block; height: auto; border: 0;'></a></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table class='paragraph_block block-2' width='100%' border='0' cellpadding='10' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
                                                        <tr>
                                                            <td class='pad'>
                                                                <div style='color:#626262;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:12px;line-height:120%;text-align:center;mso-line-height-alt:14.399999999999999px;'>
                                                                    <p style='margin: 0;'><strong>Service Client :</strong> En cas de questions ou de preoccupations, notre equipe du service client est la pour vous aider.</p>
                                                                    <p style='margin: 0;'>Telephone : +21671926635</p>
                                                                    <p style='margin: 0;'>Email : banek.tek@gmail.com &nbsp;</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class='row row-13' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;'>
                        <tbody>
                            <tr>
                                <td>
                                    <table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 575px; margin: 0 auto;' width='575'>
                                        <tbody>
                                            <tr>
                                                <td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
                                                    <table class='icons_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                        <tr>
                                                            <td class='pad' style='vertical-align: middle; color: #1e0e4b; font-family: 'Inter', sans-serif; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;'>
                                                                <table width='100%' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
                                                                    <tr>
                                                                        <td class='alignment' style='vertical-align: middle; text-align: center;'><!--[if vml]><table align='center' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
                                                                            <!--[if !vml]><!-->
                                                                            <table class='icons-inner' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;' cellpadding='0' cellspacing='0' role='presentation'><!--<![endif]-->
                                                                                <tr>
                                                                                    <td style='vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 6px;'><a href='http://designedwithbeefree.com/' target='_blank' style='text-decoration: none;'><img class='icon' alt='Beefree Logo' src='https://d1oco4z2z1fhwp.cloudfront.net/assets/Beefree-logo.png' height='32' width='34' align='center' style='display: block; height: auto; margin: 0 auto; border: 0;'></a></td>
                                                                                    <td style='font-family: 'Inter', sans-serif; font-size: 15px; font-weight: undefined; color: #1e0e4b; vertical-align: middle; letter-spacing: undefined; text-align: center;'><a href='http://designedwithbeefree.com/' target='_blank' style='color: #1e0e4b; text-decoration: none;'>Designed with Beefree</a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
";
$mail->AltBody = 'Contenu de votre e-mail en texte brut';

$mail->send();

          //header ('Location:verifmail.php');
          //echo 'E-mail envoye avec succès';
      } 
      catch (Exception $e) {
          echo 'Echec de l\'envoi de l\'e-mail : ', $mail->ErrorInfo;
      }
    }
    /////////////////////
      /////////////////////
      //////////////////:
    function sendMailClient($nom,$email,$username,$password){

  
    
        // Include the Composer autoloader
        require 'C:/xampp/php/ext/src/Exception.php';
        require 'C:/xampp/php/ext/src/PHPMailer.php';
        require 'C:/xampp/php/ext/src/SMTP.php';
    
      
      // Creer une nouvelle instance de PHPMailer
      $mail = new PHPMailer(true);                            // true active les exceptions en cas d'erreur
      
 
          // Configuration du serveur SMTP
          try {
            // Configuration du serveur SMTP
            $mail->SMTPDebug = 0; // Activer le debogage SMTP
            $mail->isSMTP(); // Utiliser SMTP
            $mail->Host = 'smtp.gmail.com'; // Nom d'hôte du serveur SMTP
            $mail->SMTPAuth = true; // Activer l'authentification SMTP
            $mail->Username = '***'; // Votre adresse email Gmail
            $mail->Password = '**'; // Votre mot de passe Gmail ou le mot de passe d'application si l'authentification à deux facteurs est activée
            $mail->SMTPSecure = 'tls'; // Utiliser TLS
            $mail->Port = 587; // Port pour TLS/STARTTLS
            
            $mail->setFrom('***', 'Banektek - Team');
            $mail->addAddress($email, $nom); // Ajouter un destinataire
            $mail->isHTML(true); // Activer le format HTML// Activer le format HTML
            $mail->SMTPDebug;
            $mail->Subject = ' Bienvenue chez Banektek ! Decouvrez votre nouvel espace client.';
    $mail->Body = "
    <!DOCTYPE html>
<html xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office' lang='en'>

<head>
	<title></title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!-->
	<link href='https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900' rel='stylesheet' type='text/css'><!--<![endif]-->
	<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			padding: 0;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: inherit !important;
		}

		#MessageViewBody a {
			color: inherit;
			text-decoration: none;
		}

		p {
			line-height: inherit
		}

		.desktop_hide,
		.desktop_hide table {
			mso-hide: all;
			display: none;
			max-height: 0px;
			overflow: hidden;
		}

		.image_block img+div {
			display: none;
		}

		.menu_block.desktop_hide .menu-links span {
			mso-hide: all;
		}

		@media (max-width:670px) {
			.desktop_hide table.icons-inner {
				display: inline-block !important;
			}

			.icons-inner {
				text-align: center;
			}

			.icons-inner td {
				margin: 0 auto;
			}

			.mobile_hide {
				display: none;
			}

			.row-content {
				width: 100% !important;
			}

			.stack .column {
				width: 100%;
				display: block;
			}

			.mobile_hide {
				min-height: 0;
				max-height: 0;
				max-width: 0;
				overflow: hidden;
				font-size: 0px;
			}

			.desktop_hide,
			.desktop_hide table {
				display: table !important;
				max-height: none !important;
			}

			.row-1 .column-1 .block-2.spacer_block,
			.row-1 .column-1 .block-9.spacer_block {
				height: 30px !important;
			}

			.row-1 .column-1 .block-6.spacer_block {
				height: 10px !important;
			}

			.row-1 .column-1 .block-4.spacer_block {
				height: 50px !important;
			}

			.row-1 .column-1 .block-5.heading_block td.pad {
				padding: 10px 15px 0 !important;
			}

			.row-1 .column-1 .block-5.heading_block h1 {
				font-size: 26px !important;
			}

			.row-1 .column-1 .block-7.heading_block td.pad,
			.row-1 .column-1 .block-8.heading_block td.pad {
				padding: 0 15px 10px !important;
			}

			.row-1 .column-1 .block-7.heading_block h3,
			.row-1 .column-1 .block-8.heading_block h3 {
				font-size: 24px !important;
			}

			.row-1 .column-1 .block-11.spacer_block,
			.row-1 .column-1 .block-13.spacer_block {
				height: 40px !important;
			}

			.row-1 .column-1 .block-16.paragraph_block td.pad {
				padding: 0 0 10px !important;
			}

			.row-1 .column-1 .block-15.paragraph_block td.pad {
				padding: 10px 0 !important;
			}

			.row-1 .column-1 {
				padding: 0 0 5px !important;
			}
		}
	</style>
</head>

<body style='background-color: #ffffff; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
	<table class='nl-container' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; background-size: auto; background-image: none; background-position: top left; background-repeat: no-repeat;'>
		<tbody>
			<tr>
				<td>
					<table class='row row-1' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-size: auto;'>
						<tbody>
							<tr>
								<td>
									<table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #dde5fd; background-image: url('https://d1oco4z2z1fhwp.cloudfront.net/templates/default/8671/Wave.png'); background-repeat: no-repeat; background-size: cover; color: #000000; width: 650px; margin: 0 auto;' width='650'>
										<tbody>
											<tr>
												<td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
													<table class='divider_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad'>
																<div class='alignment' align='center'>
																	<table border='0' cellpadding='0' cellspacing='0' role='presentation' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
																		<tr>
																			<td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 2px solid #227AFF;'><span>&#8202;</span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-2' style='height:40px;line-height:40px;font-size:1px;'>&#8202;</div>
													<table class='image_block block-3' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='width:100%;padding-right:0px;padding-left:0px;'>
																<div class='alignment' align='center' style='line-height:10px'>
																	<div style='max-width: 260px;'><a href='' target='_blank' style='outline:none' tabindex='-1'><img src='https://1eb12b237e.imgdist.com/pub/bfra/lfxyyu8k/zbn/x9b/k0o/logo.png' style='display: block; height: auto; border: 0; width: 100%;' width='260' alt='Main Logo' title='Main Logo'></a></div>
																</div>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-4' style='height:70px;line-height:70px;font-size:1px;'>&#8202;</div>
													<table class='heading_block block-5' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='padding-left:20px;padding-right:20px;text-align:center;width:100%;'>
																<h1 style='margin: 0; color: #191919; direction: ltr; font-family: Georgia, Times, 'Times New Roman', serif; font-size: 38px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0; mso-line-height-alt: 45.6px;'><span class='tinyMce-placeholder'>BIENVENU<br></span></h1>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-6' style='height:10px;line-height:10px;font-size:1px;'>&#8202;</div>
													<table class='heading_block block-7' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='padding-left:20px;padding-right:20px;text-align:center;width:100%;'>
																<h3 style='margin: 0; color: #191919; direction: ltr; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; font-size: 24px; font-weight: 400; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0; mso-line-height-alt: 28.799999999999997px;'>Nous sommes ravis de vous accueillir parmi les clients de Banektek ! C'est avec grand plaisir que nous vous souhaitons la bienvenue dans notre banque.</h3>
															</td>
														</tr>
													</table>
													<table class='heading_block block-8' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='padding-left:20px;padding-right:20px;padding-top:35px;text-align:center;width:100%;'>
																<h3 style='margin: 0; color: #000000; direction: ltr; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; font-size: 17px; font-weight: 400; letter-spacing: 2px; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0; mso-line-height-alt: 20.4px;'><span class='tinyMce-placeholder'>VOTRE INFORMATIONS ! <br>USERNAME :&nbsp; <u><em>".$username."</em></u><br>PASSWORD : <u><span style='color: #e10101;'>".$password."</span></u></span></h3>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-9' style='height:40px;line-height:40px;font-size:1px;'>&#8202;</div>
													<table class='button_block block-10' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='text-align:center;'>
																<div class='alignment' align='center'><!--[if mso]>
<v:roundrect xmlns:v='urn:schemas-microsoft-com:vml' xmlns:w='urn:schemas-microsoft-com:office:word' href='' style='height:50px;width:176px;v-text-anchor:middle;' arcsize='90%' stroke='false' fillcolor='#003883'>
<w:anchorlock/>
<v:textbox inset='0px,0px,0px,0px'>
<center style='color:#ffffff; font-family:Tahoma, sans-serif; font-size:15px'>
<![endif]--><a href='' target='_blank' style='text-decoration:none;display:inline-block;color:#ffffff;background-color:#003883;border-radius:45px;width:auto;border-top:0px solid transparent;font-weight:400;border-right:0px solid transparent;border-bottom:0px solid transparent;border-left:0px solid transparent;padding-top:10px;padding-bottom:10px;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:15px;text-align:center;mso-border-alt:none;word-break:keep-all;'><span style='padding-left:30px;padding-right:30px;font-size:15px;display:inline-block;letter-spacing:normal;'><span style='word-break: break-word; line-height: 30px;'>Notre Site WEB</span></span></a><!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-11' style='height:50px;line-height:50px;font-size:1px;'>&#8202;</div>
													<table class='image_block block-12' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='padding-left:20px;padding-right:20px;width:100%;'>
																<div class='alignment' align='center' style='line-height:10px'>
																	<div style='max-width: 449px;'><a href='' target='_blank' style='outline:none' tabindex='-1'><img src='https://1eb12b237e.imgdist.com/pub/bfra/lfxyyu8k/1zx/suf/8y1/Main_mage.png' style='display: block; height: auto; border: 0; width: 100%;' width='449' alt='Main Image' title='Main Image'></a></div>
																</div>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-13' style='height:50px;line-height:50px;font-size:1px;'>&#8202;</div>
													<table class='heading_block block-14' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;text-align:center;width:100%;'>
																<h1 style='margin: 0; color: #191919; direction: ltr; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; font-size: 24px; font-weight: 700; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0; mso-line-height-alt: 28.799999999999997px;'>Une fois connecte(e) a votre compte en ligne,</h1>
															</td>
														</tr>
													</table>
													<table class='paragraph_block block-15' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
														<tr>
															<td class='pad' style='padding-bottom:10px;padding-left:30px;padding-right:30px;padding-top:10px;'>
																<div style='color:#454545;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:center;mso-line-height-alt:21px;'>
																	<p style='margin: 0;'>&nbsp;vous pourrez acceder a une gamme de services bancaires pratiques, tels que la consultation de vos soldes, le suivi de vos transactions, le paiement de factures et bien plus encore.</p>
																</div>
															</td>
														</tr>
													</table>
													<table class='paragraph_block block-16' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;'>
														<tr>
															<td class='pad' style='padding-bottom:10px;padding-left:30px;padding-right:30px;'>
																<div style='color:#454545;direction:ltr;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:14px;font-weight:400;letter-spacing:0px;line-height:150%;text-align:center;mso-line-height-alt:21px;'>&nbsp;</div>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table class='row row-2' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
						<tbody>
							<tr>
								<td>
									<table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #003883; border-radius: 0; color: #000000; width: 650px; margin: 0 auto;' width='650'>
										<tbody>
											<tr>
												<td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
													<div class='spacer_block block-1' style='height:10px;line-height:10px;font-size:1px;'>&#8202;</div>
													<table class='divider_block block-2' width='100%' border='0' cellpadding='5' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad'>
																<div class='alignment' align='center'>
																	<table border='0' cellpadding='0' cellspacing='0' role='presentation' width='90%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
																		<tr>
																			<td class='divider_inner' style='font-size: 1px; line-height: 1px; border-top: 1px solid #9299A7;'><span>&#8202;</span></td>
																		</tr>
																	</table>
																</div>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-3' style='height:10px;line-height:10px;font-size:1px;'>&#8202;</div>
													<table class='menu_block block-4' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='color:#e0e0e0;font-family:inherit;font-size:10px;font-weight:400;letter-spacing:0px;padding-left:10px;padding-right:10px;text-align:center;'>
																<table width='100%' cellpadding='0' cellspacing='0' border='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
																	<tr>
																		<td class='alignment' style='text-align:center;font-size:0px;'>
																			<div class='menu-links'><!--[if mso]><table role='presentation' border='0' cellpadding='0' cellspacing='0' align='center' style=''><tr style='text-align:center;'><![endif]--><!--[if mso]><td style='padding-top:5px;padding-right:5px;padding-bottom:5px;padding-left:5px'><![endif]--><a href='' target='_self' style='mso-hide:false;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;display:inline-block;color:#e0e0e0;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:10px;text-decoration:none;letter-spacing:normal;'>TERMS OF USE</a><!--[if mso]></td><td><![endif]--><span class='sep' style='font-size:10px;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;color:#e0e0e0;'>|</span><!--[if mso]></td><![endif]--><!--[if mso]><td style='padding-top:5px;padding-right:5px;padding-bottom:5px;padding-left:5px'><![endif]--><a href='' target='_self' style='mso-hide:false;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;display:inline-block;color:#e0e0e0;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:10px;text-decoration:none;letter-spacing:normal;'>PRIVACY AND POLICY</a><!--[if mso]></td><td><![endif]--><span class='sep' style='font-size:10px;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;color:#e0e0e0;'>|</span><!--[if mso]></td><![endif]--><!--[if mso]><td style='padding-top:5px;padding-right:5px;padding-bottom:5px;padding-left:5px'><![endif]--><a href='' target='_self' style='mso-hide:false;padding-top:5px;padding-bottom:5px;padding-left:5px;padding-right:5px;display:inline-block;color:#e0e0e0;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;font-size:10px;text-decoration:none;letter-spacing:normal;'>CONTACT</a><!--[if mso]></td><![endif]--><!--[if mso]></tr></table><![endif]--></div>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<div class='spacer_block block-5' style='height:20px;line-height:20px;font-size:1px;'>&#8202;</div>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table class='row row-3' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
						<tbody>
							<tr>
								<td>
									<table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #dde5fd; border-radius: 0; color: #000000; width: 650px; margin: 0 auto;' width='650'>
										<tbody>
											<tr>
												<td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
													<div class='spacer_block block-1' style='height:15px;line-height:15px;font-size:1px;'>&#8202;</div>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<table class='row row-4' align='center' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;'>
						<tbody>
							<tr>
								<td>
									<table class='row-content stack' align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 650px; margin: 0 auto;' width='650'>
										<tbody>
											<tr>
												<td class='column column-1' width='100%' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;'>
													<table class='icons_block block-1' width='100%' border='0' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
														<tr>
															<td class='pad' style='vertical-align: middle; color: #1e0e4b; font-family: 'Inter', sans-serif; font-size: 15px; padding-bottom: 5px; padding-top: 5px; text-align: center;'>
																<table width='100%' cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>
																	<tr>
																		<td class='alignment' style='vertical-align: middle; text-align: center;'><!--[if vml]><table align='center' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
																			<!--[if !vml]><!-->
                                                                            <!--[endif]-->
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table><!-- End -->
</body>

</html>
    ";
    
          $mail->AltBody = 'Contenu de votre e-mail en texte brut';
      
          $mail->send();
        
          //header ('Location:verifmail.php');
          //echo 'E-mail envoye avec succès';
      } 
      catch (Exception $e) {
          echo 'Echec de l\'envoi de l\'e-mail : ', $mail->ErrorInfo;
      }
    }
   
}

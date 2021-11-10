<html lang="pt-br">
   <head>
      <title></title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <style type="text/css">
         @media screen {
         @font-face {
         font-family: 'Lato';
         font-style: normal;
         font-weight: 400;
         src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
         }
         @font-face {
         font-family: 'Lato';
         font-style: normal;
         font-weight: 700;
         src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
         }
         @font-face {
         font-family: 'Lato';
         font-style: italic;
         font-weight: 400;
         src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
         }
         @font-face {
         font-family: 'Lato';
         font-style: italic;
         font-weight: 700;
         src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
         }
         }
         body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
         /* table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; } */
         img { -ms-interpolation-mode: bicubic; }
         img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
         table { border-collapse: collapse !important; }
         body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
         a[x-apple-data-detectors] {
         color: inherit !important;
         text-decoration: none !important;
         font-size: inherit !important;
         font-family: inherit !important;
         font-weight: inherit !important;
         line-height: inherit !important;
         }
         div[style*="margin: 16px 0;"] { margin: 0 !important; }
      </style>
   </head>
   <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
         <td bgcolor="#000000" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="480" >
               <tr>
                  <td align="center" valign="top" style="padding: 40px 10px 40px 10px;">
                     @if($user->partner_image)
                     <img alt="Logo" src="{{$user->partner_image}}" width="100" height="100" style="display: block;  font-family: 'Lato', Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px;" border="0">
                     @endif
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td bgcolor="#000000" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="480" >
               <tr>
                  <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                     <h1 style="font-size: 32px; font-weight: 400; margin: 0;">{{__('emails.recover_email.title')}}</h1>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="480" >
               <tr>
                  <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;" >
                    <p style="margin: 0;">
                      {{__('emails.recover_email.text')}}
                    </p>
                  </td>
               </tr>
               <tr>
                  <td bgcolor="#ffffff" align="left">
                     <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                           <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                              <table border="0" cellspacing="0" cellpadding="0">
                                 <tr>
                                    <td align="center" bgcolor="#000000">
                                      <span style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; display: inline-block;">
                                        {{$user->code}}
                                      </span>
                                    </td>
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
   </body>
</html>
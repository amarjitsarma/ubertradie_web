<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Digital Pacemaker | Password Recovery</title>
</head>
<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
  <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
      <tbody>
        <tr>
          <td style="vertical-align: top; padding-bottom:30px;" align="center"><a href="javascript:void(0)" target="_blank"><img src="{{URL::asset('plugins/images/logo_bulb.png')}}" alt="Digital Pacemaker" style="border:none"><br/>
            <img src="{{URL::asset('plugins/images/logo_text.png')}}" alt="Digital Pacemaker" style="border:none"></a> </td>
        </tr>
      </tbody>
    </table>
    <div style="padding: 40px; background: #fff;">
      <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
        <tbody>
          <tr>
            <td><b>Dear Sir/Madam/Customer,</b>
              <p>We have recieved a password reset request form you. Please click the following link to reset your password,</p>
              <a href="{{ env('APP_URL') }}/reset/{{$user->email}}/{{$code}}" style="display: inline-block; padding: 11px 30px; margin: 20px 0px 30px; font-size: 15px; color: #fff; background: #1e88e5; border-radius: 60px; text-decoration:none;">Click here to reset </a>
              <p>if the above link is not clickable please copy this link ({{ env('APP_URL') }}/reset/{{$user->email}}/{{$code}}) and paste it in the address bar of your web browser.</p>
              <p>If you have not the requested for password change please report it to the system administrator, Thank You!</p>
              <b>- Thanks (Admin team)</b> </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
      <p> Powered by 24techsoft.com <br>
    </div>
  </div>
</div>
</body>
</html>
@extends('mail.layout.email')
@section('content')

<p style="font-family:sans-serif;font-size:14px;font-weight:normal;margin:0;Margin-bottom:15px;"><b>Hello {{$user}}!</b></p>
<p style="font-family:sans-serif;font-size:14px;font-weight:normal;margin:0;Margin-bottom:15px;">New user user account is successfully approved by administrator.</p>
<p style="font-family:sans-serif;font-size:14px;font-weight:normal;margin:0;Margin-bottom:15px;">Following are the details of yur account</p>
<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;box-sizing:border-box;width:100%;">
  <tbody>
	<tr>
	  <td align="left" style="font-family:sans-serif;font-size:14px;vertical-align:top;padding-bottom:15px;">
		<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:separate;mso-table-lspace:0pt;mso-table-rspace:0pt;width:100%;width:auto;">
		  <tbody>
			<tr>
				<td style="font-family:sans-serif;font-size:14px;vertical-align:top;background-color:#f2f2f2;border-radius:5px;text-align:center;background-color:#3498db;">
					<ul>
						<li>URL: http://projects.fhts.ac.in/sdgindia/</li>
						<li>Name: {{$userName}}</li>
						<li>Password: <b>YOUR-PASSWORD</b></li>
					</ul>
				</td>
				</td>
			</tr>
		  </tbody>
		</table>
	  </td>
	</tr>
  </tbody>
</table>

<p style="font-family:sans-serif;font-size:14px;font-weight:normal;margin:0;Margin-bottom:15px;">you can now log in to you account.</p>


@endsection
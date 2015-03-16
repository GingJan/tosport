<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>重设密码</title>
</head>
<body>
	<form action="/svn/tosport/1/index.php/Home/User/resetPassword" method="post">
		<table align="center">
			<tr>
				<td><label>新密码</label></td>
				<td><input type="password" id="password" name="password"/></td>
			</tr>
			<tr>
				<td><label>确认密码</label></td>
				<td><input type="password" id="repassword" name="repassword"/></td>
			</tr>
			<tr>
				<td><input type="submit" value="提交"></td>
				<td><input type="reset" value="重置"></td>
			</tr>
		</table>
	</form>
</body>
</html>
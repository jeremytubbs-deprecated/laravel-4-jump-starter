<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Confirm Registration</h2>

		<div>
			To activate your account click the following link: {{ URL::to('register/activate', array($token)) }}.
		</div>
	</body>
</html>
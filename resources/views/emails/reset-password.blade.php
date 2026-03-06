<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>

<body style="font-family: Arial; background:#f3f4f6; padding:40px;">

    <div style="max-width:500px;margin:auto;background:white;padding:30px;border-radius:10px">

        <h2 style="text-align:center">Reset Your Password</h2>

        <p>Hello,</p>

        <p>Click the button below to reset your password.</p>

        <a href="{{ $url }}"
            style="display:block;background:#00A6CC;color:white;padding:12px;text-align:center;border-radius:6px;text-decoration:none;margin-top:20px">
            Reset Password
        </a>

        <p style="margin-top:20px;font-size:12px;color:gray">
            If you did not request a password reset, please ignore this email.
        </p>

    </div>

</body>

</html>

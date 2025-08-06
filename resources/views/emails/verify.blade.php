{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment aggregator admin panel</title>
</head>
<body>

    <p>Welcome! To complete your login process, you'll need to provide the OTP. Here it is.</p>

    <h1 style="color: cornflowerblue; text-align: center"> {{ $otp }} </h1>

    <p>Please enter this OTP within 10 minutes of receiving this email to complete your login process.</p>

    <p>Thank you for your cooperation,</p>

    <i>Payment aggregator Admin</i>

</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification OTP</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .logo {
            width: 60px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .otp-box {
            background: #2e0261;
            padding: 20px;
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 3px;
            border-radius: 8px;
            display: inline-block;
            color: #fff;
            box-shadow: 0 4px 10px rgba(255, 123, 0, 0.3);
        }

        .message {
            font-size: 16px;
            color: #555;
            margin: 15px 0;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <img id="logo-img" src="https://monreci.bj/images/logo_reci_noir.png" alt="Logo" class="mb-3"
            style="width: 120px;" />

        <h1>Bonjour,</h1>
        <h2></h2>
        <p class="message">Merci pour votre inscription. Cliquez sur le lien ci-dessous pour vérifier votre adresse e-mail :</p>
        <p>
        <div class="otp-box"><a href="{{ url('/verify-email/'.$token) }}">Vérifier mon e-mail</a></div>
        <p class="message">Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet e-mail.</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} RéCi. Tous droits réservés.</p>
        </div>
    </div>
</body>

</html>

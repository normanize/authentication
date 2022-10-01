<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Starter</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #f1f1f1;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        input {
            padding: 10pt;
            width: 60%;
            font-size: 15pt;
            border-radius: 5pt;
            border: 1px solid lightgray;
            margin: 10pt;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 40%;
            margin: 20pt;
            border: 1px solid lightgray;
            padding: 20pt;
            border-radius: 5pt;
            background: white;
        }
        button {
            padding: 10pt;
            width: 60%;
            border-radius: 5pt;
            background: white;
            border: 1px solid gray;
            font-size: 14pt;
            margin: 20pt;
            cursor: pointer;
        }
        button:hover {
            background: #EEEEEE;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <form class="form-container" action="api/password/reset" method="POST">
        <h2>Change your password</h2>

        <input hidden name="token" placeholder="token" value="{{request()->get('token')}}">
        <input hidden name="email" placeholder="" value="{{request()->get('email')}}">
        <input type="password" name="password" placeholder="Enter new password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm new password" required>

        <button type="submit">Change Password</button>
    </form>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contato</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'JetBrains Mono';
      background-color: #181818;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background-color: #181818;
      border-radius: 8%;
      width: 400px;
      height: 600px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .title {
      color: #aaaaaa;
      font-size: 24px;
      margin-bottom: 40px;
    }

    .input {
      border-radius: 5px;
      background-color: #212121;
      width: 400px;
      height: 40px;
      color: #ffffff;
      font-size: 15px;
      text-align: left;
      padding-left: 10px;
      border: none;
      outline: none;
      box-shadow: none;
      font-family: 'JetBrains Mono';
    }

    .label {
      color: #aaaaaa;
      font-size: 15px;
      margin-bottom: 0;
      margin-top: 10px;
    }

    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .button {
      font-family: 'JetBrains Mono';
      font-size: 20px;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #181818;
      color: #92ac68;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: transform 0.1s ease, background-color 0.1s ease;
    }

    .button:active {
      transform: scale(0.95);
      background-color: #2a2a2a;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
    }

    .link {
      font-family: 'JetBrains Mono';
      color: #92ac68;
      text-decoration: none;
    }

    .link:hover {
      color: #4d6329;
      text-decoration: none;
    }

    .error-message {
      display: none;
      color: #c3352e;
      margin-top: 10px;
      text-align: center;
    }

    .error-message.visible {
      display: block;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1 class="title">Login</h1>
    @if (session('error'))
      <div id="error-message" class="error-message visible">{{ session('error') }}</div>
    @else
      <div id="error-message" class="error-message"></div>
    @endif
    <form class="form-group" action="{{ url('login') }}" method="post">
      @csrf
      <p class="label">Email</p>
      <input class="input" type="text" name="email" id="email">
      <p class="label">Password</p>
      <input class="input" type="password" name="password" id="password">
      <button class="button" type="submit">Login</button>
    </form>
    <a class="link" href="/register">Create Account</a>
  </div>

</body>

</html>
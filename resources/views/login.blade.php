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
      background-color: #212121;
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
    }

    .input {
      border-radius: 10px;
      background-color: #181818;
      width: 300px;
      height: 60px;
      color: #ffffff;
      font-size: 15px;
      text-align: center;
      border: none;
      outline: none;
      box-shadow: none;
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
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1 class="title">Login</h1>
    <form class="form-container" action="" method="post">
      @csrf
      <p class="label">Email</p>
      <input class="input" type="text" name="email" id="email">
      <p class="label">Password</p>
      <input class="input" type="password" name="password" id="password">
      <button class="button" type="submit">Login</button>
    </form>
    <a href="/register">Create Account</a>
  </div>

</body>

</html>
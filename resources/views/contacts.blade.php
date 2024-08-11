<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
</head>
<body>
    <h1>Add Contact</h1>
    <form action="{{ url('/contacts') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>
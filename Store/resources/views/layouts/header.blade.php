<!-- resources/views/layouts/header.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Your header styles here */
        .header {
            background-color: #A4D063;
            padding: 20px;
            text-align: center;
        }

        .logo {
            max-width: 100%; /* Adjust the width as needed */
            height: auto; /* Ensure the aspect ratio is maintained */
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('images/Netcom.png') }}" alt="Logo" class="logo">
    </div>
</body>

</html>

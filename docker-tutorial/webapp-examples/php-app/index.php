<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Docker App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f0f8ff; color: #333; }
        h1 { color: #2a2a8c; }
        p { font-size: 1.1em; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .footer { margin-top: 20px; font-size: 0.9em; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello from PHP!</h1>
        <p>This PHP application is running inside a Docker container using Apache.</p>
        <p>Current date and time: <?php echo date('Y-m-d H:i:s'); ?></p>
        <?php
        // Example of using an environment variable
        $appName = getenv('APP_NAME') ?: "My PHP App";
        echo "<p>Application Name: " . htmlspecialchars($appName) . "</p>";
        ?>
    </div>
    <div class="footer">
        <p>PHP Version: <?php echo phpversion(); ?></p>
    </div>
</body>
</html>

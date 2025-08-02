<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$reason = $_POST['reason'];
$message = $_POST['message'];

// Detect sentiment emoji
function detectSentiment($msg) {
    $msg = strtolower($msg);
    if (str_contains($msg, 'thank') || str_contains($msg, 'great') || str_contains($msg, 'awesome')) {
        return "😊";
    } elseif (str_contains($msg, 'not') || str_contains($msg, 'bad') || str_contains($msg, 'error')) {
        return "😞";
    } else {
        return "🙂";
    }
}
$emoji = detectSentiment($message);

// Store to DB
$sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    // Output HTML page directly
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Message Sent</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                padding: 20px;
                background-color: #f0fff0;
                color: #333;
                text-align: center;
            }
            .card {
                background: white;
                padding: 30px;
                max-width: 600px;
                margin: 40px auto;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            .speak-btn {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 16px;
            }
            .speak-btn:hover {
                background-color: #1e7e34;
            }
            a {
                display: inline-block;
                margin-top: 25px;
                color: #007bff;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="card">
            <h2>✅ Thank you, <?= htmlspecialchars($name) ?> <?= $emoji ?>!</h2>
            <p>Your message has been successfully received.</p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Reason:</strong> <?= htmlspecialchars($reason) ?></p>
            <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($message)) ?></p>

            <button class="speak-btn" onclick="speak()">🔊 Speak Message</button>
            <br><a href="index.php">⬅️ Go back to form</a>
        </div>

        <script>
        const text = `Thank you <?= htmlspecialchars($name) ?>. Your message has been received.`;
        const msg = new SpeechSynthesisUtterance(text);
        window.speechSynthesis.speak(msg);

        function speak() {
            window.speechSynthesis.speak(new SpeechSynthesisUtterance(text));
        }
        </script>
    </body>
    </html>

    <?php
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

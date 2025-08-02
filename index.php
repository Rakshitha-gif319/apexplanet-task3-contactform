<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us – Unique Edition</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form-container">
    <h2>📬 Contact Us</h2>
    
    <button class="dark-toggle" onclick="toggleDarkMode()">🌙 Toggle Dark Mode</button>

    <form action="submit.php" method="post">
      <label>👤 Name</label>
      <input type="text" name="name" placeholder="Your Full Name" required>

      <label>📧 Email</label>
      <input type="email" name="email" placeholder="Your Email Address" required>

      <label>🎯 Reason for Contact</label>
      <select name="reason">
        <option value="General Query">General Query</option>
        <option value="Internship Details">Internship Details</option>
        <option value="Feedback">Feedback</option>
      </select>

      <label>📝 Message</label>
      <textarea id="message" name="message" maxlength="500" oninput="updateCount()" placeholder="Type your message..." rows="5" required></textarea>
      <p id="charCount">0/500 characters</p>

      <button type="submit">🚀 Send Message</button>
    </form>
  </div>

  <script>
    function updateCount() {
      const message = document.getElementById('message');
      const count = document.getElementById('charCount');
      count.innerText = message.value.length + "/500 characters";
    }

    function toggleDarkMode() {
      document.body.classList.toggle("dark");
    }
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adoption Web App - Contact</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <h1 class="header-title">Adoption Web App</h1>
  </header>

  <nav class="navigation">
    <ul class="navigation-menu">
      <li><a href="index.php" class="navigation-link">Home</a></li>
      <li><a href="add_for_adoption.html" class="navigation-link">Add an Animal for Adoption</a></li>
      <li><a href="about.html" class="navigation-link">About</a></li>
      <li><a href="contact.html" class="navigation-link active">Contact</a></li>
    </ul>
  </nav>

  <main class="main-content">
    <section class="contact-section">
      <h2 class="section-title">Contact Us</h2>
      <p>Please fill out the form below to get in touch with us.</p>

      <form class="contact-form" action="send_email.php" method="POST">

        <div class="form-group">
          <label for="name">Your Name</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Your Email</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" required></textarea>
        </div>
        <button type="submit" class="submit-button">Submit</button>
      </form>
    </section>
  </main>

  <footer class="footer">
    <p class="footer-info">&copy; 2023 Adoption Web App. All rights reserved. | <a href="privacy.html" class="footer-link">Privacy Policy</a></p>
  </footer>

</body>
</html>

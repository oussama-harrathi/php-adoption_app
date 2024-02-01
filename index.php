<?php
$database = new SQLite3('animals.db');

// Check if a new pet card is added
if (isset($_GET['newPetCard'])) {
  $newPetCardHTML = urldecode($_GET['newPetCard']);
  $petCards[] = $newPetCardHTML;
}

// Retrieve the animals from the database
$query = "SELECT * FROM animals";
$result = $database->query($query);

// Create an array to store the pet cards
$petCards = array();

// Loop through the results and generate pet cards
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
  $petCardHTML = '<div class="pet-card">';
  $petCardHTML .= '<img src="' . $row['image'] . '" alt="' . $row['type'] . '" class="pet-image">';
  $petCardHTML .= '<h3 class="pet-name">' . $row['type'] . '</h3>';
  $petCardHTML .= '<p class="pet-info">Age: ' . $row['age'] . '</p>';
  $petCardHTML .= '<button class="delete-button" data-animal-id="' . $row['id'] . '">Delete</button>';
  $petCardHTML .= '</div>';

  $petCards[] = $petCardHTML;
}

// Close the database connection
$database->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adoption Web App - Welcome</title>
  <link rel="stylesheet" href="style.css">
  <script>
    // JavaScript code to handle the delete button click event
    document.addEventListener('DOMContentLoaded', function() {
      const deleteButtons = document.getElementsByClassName('delete-button');
      Array.from(deleteButtons).forEach(function(button) {
        button.addEventListener('click', function() {
          const animalId = button.getAttribute('data-animal-id');
          deleteAnimal(animalId);
        });
      });

      function deleteAnimal(animalId) {
        // Perform an AJAX request to delete the animal from the database
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'delete_animal.php?id=' + animalId, true);
        xhr.onload = function() {
          if (xhr.status === 200) {
            // If the deletion is successful, remove the pet card from the page
            const petCard = button.closest('.pet-card');
            petCard.remove();
          } else {
            // Handle the error case
            console.error('Error deleting animal');
          }
        };
        xhr.send();
      }
    });
  </script>
  <script>
    // JavaScript code to auto-refresh the page every 5 seconds
    setInterval(function() {
      location.reload();
    }, 5000);
  </script>
</head>
<body class="site-container">
  <header class="header">
    <h1 class="header-title">Welcome to the Adoption Web App</h1>
  </header>

  <nav class="navigation">
    <ul class="navigation-menu">
      <li><a href="index.php" class="navigation-link active">Home</a></li>
      <li><a href="add_for_adoption.html" class="navigation-link">Add an Animal for Adoption</a></li>
      <li><a href="about.html" class="navigation-link">About</a></li>
      <li><a href="contact.php" class="navigation-link">Contact</a></li>
    </ul>
  </nav>

  <main class="main-content">
    <section class="about-section">
      <h2 class="section-title">About Us</h2>
      <p>Welcome to our Adoption Web App! We are dedicated to helping animals find loving homes.</p>
      <p>Our app provides a platform for individuals and families to connect with available pets for adoption. Browse through the profiles, learn about the animals, and find your perfect companion.</p>
    </section>

    <section class="featured-pets-section">
      <h2 class="section-title">Featured Pets</h2>
      <div class="pet-list">
       
        <?php
        // Display the existing pet cards
        foreach ($petCards as $petCard) {
          echo $petCard;
        }
        ?>

        <div id="new-pet-card"></div>
        
      </div>
    </section>
  </main>

  <footer class="footer">
    <p class="footer-info">&copy; 2023 Adoption Web App. All rights reserved. | <a href="privacy.html" class="footer-link">Privacy Policy</a></p>
  </footer>

</body>
</html>



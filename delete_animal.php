<?php
if (isset($_GET['id'])) {
  $database = new SQLite3('animals.db');
  $animalId = $_GET['id'];

  // Delete the animal from the database
  $query = "DELETE FROM animals WHERE id = $animalId";
  $database->exec($query);

  // Close the database connection
  $database->close();

  // Send a success response
  http_response_code(200);
} else {
  // Send an error response
  http_response_code(400);
}
?>

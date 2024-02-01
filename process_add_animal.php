<?php
// Establish a connection to the SQLite database
$database = new SQLite3('animals.db');

// Retrieve the submitted form data
$animalType = $_POST['animal-type'];
$animalAge = $_POST['animal-age'];

// Process the uploaded image
$targetDirectory = 'photos/';
$targetFile = $targetDirectory . basename($_FILES['animal-image']['name']);
move_uploaded_file($_FILES['animal-image']['tmp_name'], $targetFile);

// Insert the animal details into the database
$query = "INSERT INTO animals (type, age, image) VALUES ('$animalType', '$animalAge', '$targetFile')";
$database->exec($query);

// Get the newly inserted animal's ID
$newAnimalId = $database->lastInsertRowID();

// Retrieve the details of the newly added animal
$getNewAnimalQuery = "SELECT * FROM animals WHERE id = $newAnimalId";
$result = $database->query($getNewAnimalQuery);
$newAnimal = $result->fetchArray(SQLITE3_ASSOC);

// Close the database connection
$database->close();

// Generate the HTML for the new pet card
$newPetCardHTML = '<div class="pet-card">';
$newPetCardHTML .= '<img src="' . $newAnimal['image'] . '" alt="Pet Image" class="pet-image">';
$newPetCardHTML .= '<h3 class="pet-name">' . $newAnimal['type'] . '</h3>';
$newPetCardHTML .= '<p class="pet-info">Breed: ' . $newAnimal['breed'] . '</p>';
$newPetCardHTML .= '<p class="pet-info">Age: ' . $newAnimal['age'] . ' years</p>';
$newPetCardHTML .= '</div>';

// Redirect back to the home page with the new pet card HTML as a parameter
header('Location: index.php?newPetCard=' . urlencode($newPetCardHTML));
exit();
?>


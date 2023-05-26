<?php
	// Récupérer les données envoyées depuis le formulaire
	$subject_id = $_POST["subject"];
	$date = $_POST["date"];
	$absences = $_POST["absences"];

	// Insérer les absences dans la base de données
	$conn = new mysqli("localhost", "username", "password", "faculty");
	foreach ($absences as $student_id) {
		$query = "INSERT INTO absences (student_id, subject_id, date) VALUES ($student_id, $subject_id, '$date')";
		$conn->query($query);
	}
	$conn->close();

	// Rediriger vers la page de rapport d'absences
	header("Location: rapport_absences.php");
	exit();
?>
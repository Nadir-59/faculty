<!DOCTYPE html>
<html>
<head>
	<title>Page de rapport d'absences</title>
</head>
<body>
	<h1>Rapport d'absences</h1>
	<form method="post" action="save_absences.php">
		<label for="subject">Matière :</label>
		<select name="subject" id="subject">
			<?php
				// Récupérer les matières de l'enseignant connecté depuis la base de données
				// Cette partie dépend de votre implémentation de l'authentification enseignant
				$teacher_id = 4; // exemple d'id enseignant
				$conn = new mysqli("localhost", "root", "", "faculty");
				$query = "SELECT subject.id, subject.name FROM subject INNER JOIN teacher_subject ON subject.id = teacher_subject.subject_id WHERE teacher_subject.teacher_id = $teacher_id";
				$result = $conn->query($query);
				if ($result->num_rows > 0) {
				    while($row = $result->fetch_assoc()) {?>
Continuation du code HTML et PHP pour la page de rapport d'absences :

```html
<option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
			<?php
					}
				}
				$conn->close();
			?>
		</select>
		<br><br>
		<label for="date">Date :</label>
		<input type="date" name="date" id="date">
		<br><br>
		<label>Étudiants :</label>
		<table>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Absent</th>
			</tr>
			<?php
				// Récupérer la liste des étudiants pour la matière sélectionnée depuis la base de données
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$subject_id = $_POST["subject"];
					$date = $_POST["date"];
					$conn = new mysqli("localhost", "root", "", "faculty");
					$query = "SELECT students.id, students.name, students.dob, students.gender, students.email, students.mobile FROM students INNER JOIN specialty ON students.specialty_id = specialty.id INNER JOIN level ON students.level_id = level.id INNER JOIN section ON students.section_id = section.id INNER JOIN grp ON students.grp_idContinuation du code HTML et PHP pour la page de rapport d'absences :

```html
= grp.id WHERE specialty.id = (SELECT specialty_id FROM subject WHERE id = $subject_id) AND level.id = (SELECT level_id FROM teacher_subject WHERE teacher_id = $teacher_id AND subject_id = $subject_id) AND section.id = (SELECT section_id FROM teacher_subject WHERE teacher_id = $teacher_id AND subject_id = $subject_id)";
					$result = $conn->query($query);
					if ($result->num_rows > 0) {
					    while($row = $result->fetch_assoc()) {
					        echo "<tr>";
					        echo "<td>" . $row["name"] . "</td>";
					        echo "<td>" . $row["dob"] . "</td>";
					        echo "<td>" . $row["gender"] . "</td>";
					        echo "<td>" . $row["email"] . "</td>";
					        echo "<td>" . $row["mobile"] . "</td>";
					        echo "<td><input type='checkbox' name='absences[]' value='" . $row["id"] . "'></td>";
					        echo "</tr>";
					    }
					}
					$conn->close();
				}
			?>
		</table>
		<br><br>
		<input type="submit" value="Enregistrer les absences">
	</form>
</body>
</html>
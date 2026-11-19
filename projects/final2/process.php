<?php
// Basic form processing for a class project.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$team = trim($_POST['team'] ?? '');
$experience = trim($_POST['experience'] ?? '');
$message = trim($_POST['message'] ?? '');
$teams = ['Ferrari', 'McLaren', 'Mercedes', 'Red Bull Racing', 'Other'];
$experiences = ['New fan', '1-2 years', '3 years or more'];
$valid = $name !== '' && strlen($name) <= 80 && filter_var($email, FILTER_VALIDATE_EMAIL)
    && strlen($email) <= 120 && in_array($team, $teams, true)
    && in_array($experience, $experiences, true)
    && $message !== '' && strlen($message) <= 500;
function clean($value) { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="description" content="F1 fan form response"><title>Form Result | My F1 Website</title><link rel="stylesheet" href="style.css"></head>
<body><header><h1>My F1 Website</h1><p>Fan Form Result</p></header>
<nav><a href="index.html">Home</a><a href="teams.html">Teams</a><a href="circuits.html">Circuits</a><a href="technology.html">Technology</a><a href="racing.html">Race Weekend</a><a class="active" href="contact.html">Fan Form</a></nav>
<main><h2>Form Result</h2>
<?php if ($valid): ?>
<p>Thanks, <?php echo clean($name); ?>! Your form was checked successfully.</p>
<p>Your favorite team: <?php echo clean($team); ?></p>
<p>This is a class demonstration. Your information was not saved or emailed.</p>
<?php else: ?>
<p>There was a problem with the form. Please complete all fields correctly.</p>
<?php endif; ?>
<p><a href="contact.html">Go back to the form</a></p></main>
<footer><p>&copy; 2026 My F1 Website | Student project</p></footer></body></html>

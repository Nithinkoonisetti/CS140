<?php
// Server-side validation and processing; requires PHP 7.4+ on hosting.
header('Content-Type: text/html; charset=UTF-8');
function e($s) { return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit('Method not allowed.'); }
$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$island = trim((string)($_POST['island'] ?? ''));
$month = trim((string)($_POST['month'] ?? ''));
$activity = trim((string)($_POST['activity'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));
$islands = ['Oahu','Maui','Hawaii Island','Kauai','Molokai','Lanai'];
$months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
$activities = ['Hiking','Beach relaxation','Cultural learning','Wildlife viewing'];
$errors = [];
if ($name === '' || strlen($name) > 100) $errors[] = 'Enter a name of up to 100 characters.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 200) $errors[] = 'Enter a valid email address.';
if (!in_array($island, $islands, true)) $errors[] = 'Select a valid island.';
if (!in_array($month, $months, true)) $errors[] = 'Select a valid month.';
if (!in_array($activity, $activities, true)) $errors[] = 'Select a valid activity.';
if (strlen($message) > 1000) $errors[] = 'Message is too long.';
if ($errors) http_response_code(422);
// Process submission without storing private details: create a personalized confirmation.
?><!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="description" content="Travel form submission result"><title>Form Result | Explore Hawaii</title><link rel="stylesheet" href="style.css"></head><body><header><div class="topbar"><a class="brand" href="index.html">Explore <span>Hawaii</span></a><nav aria-label="Main navigation"><a href="index.html">Home</a><a href="islands.html">Islands</a><a href="beaches.html">Beaches</a><a href="culture.html">Culture</a><a href="adventures.html">Adventures</a><a href="contact.html" aria-current="page">Plan a Trip</a></nav></div></header><main id="main" class="container"><h1><?= $errors ? 'Please correct your submission' : 'Thank you, '.e($name).'!' ?></h1><?php if ($errors): ?><div class="callout"><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><p><a class="btn" href="contact.html">Return to form</a></p><?php else: ?><p>Your interest form was processed successfully on the server.</p><p><strong>Preferred island:</strong> <?= e($island) ?></p><p><strong>Travel month:</strong> <?= e($month) ?></p><p><strong>Favorite activity:</strong> <?= e($activity) ?></p><p>This demonstration does not store or email your information.</p><p><a class="btn" href="index.html">Back to home</a></p><?php endif; ?></main><footer class="footer"><div class="footer-inner"><p>&copy; 2026 Explore Hawaii. Student website project.</p></div></footer></body></html>

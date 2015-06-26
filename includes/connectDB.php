<?php
$db = new PDO('mysql:host=localhost;dbname=geowceu;charset=utf8', 'geowceu', 'geowceu');

function getSpots($db) {
	$stmt = $db->query("SELECT * FROM geospots");
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
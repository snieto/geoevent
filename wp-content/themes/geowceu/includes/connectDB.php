<?php
$db = new PDO('mysql:host=localhost;dbname=geowceu;charset=utf8', 'geowceu', 'geowceu');

function getSpots($db) {
	$stmt = $db->query("SELECT * FROM geospots");
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpotByToken($db, $token) {
	$stmt = $db->query("SELECT * FROM geospots where token like '$token'");
	return $stmt->fetch(PDO::FETCH_ASSOC);
}
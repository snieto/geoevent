<?php
include __DIR__.'/../../../../wp-config.php';
$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);

function getSpots($db) {
	$stmt = $db->query("SELECT * FROM geospots");
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getSpotByToken($db, $token) {
	$stmt = $db->query("SELECT * FROM geospots where token like '$token'");
	return $stmt->fetch(PDO::FETCH_ASSOC);
}
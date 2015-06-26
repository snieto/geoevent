<?php
include __DIR__.DIRECTORY_SEPARATOR.'includes/connectDB.php';

$spots = getSpots($db);
echo json_encode($spots);
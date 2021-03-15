<?php
// require_once dirname(__FILE__).'/../../config.php';
//inicjacja mechanizmu sesji
session_start();

//pobranie roli
//weryfikacja bramkarz sprawdza istnienie roli
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

//jeśli brak parametru to idź na stronę logowania
if ( empty($role) ){
	include _ROOT_PATH.'/app/security/login.php';
	//zatrzymaj dalsze przetwarzanie skryptów
	exit();
}
//jeśli ok to idź dalej
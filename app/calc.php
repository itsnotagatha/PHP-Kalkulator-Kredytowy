<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

// 1. pobranie parametrów
// warunek ? jeśli prawda: jeśli fałsz
function getParams(&$x,&$y,&$z){
	$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null; //kwota
	$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null; //na ile lat
	$z = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	//oprocentowanie
}

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$x,&$y,&$operation,&$messages){
	if (! (isset($x) && isset($y) && isset($z))) {
		return false; //blad - brak wykonanych obliczen
	}

	if ( $x == "") {
		$messages [] = 'Nie podano liczby 1';
	}
	if ( $y == "") {
		$messages [] = 'Nie podano liczby 2';
	}
	if ($z == ""){
		$messages [] = "Nie podano liczby 3";
	}

	//blad - brak parametrów
	if (count ( $messages ) != 0) return false;

	if (empty( $messages )) {
		// sprawdzenie, czy $x i $y są liczbami całkowitymi
		if (! is_numeric( $x )) {
			$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
		}
		if (! is_numeric( $y )) {
			$messages [] = 'Druga wartość nie jest liczbą całkowitą';
		}
		if (! is_numeric( $z )) {
			$messages [] = 'Trzecia wartość nie jest liczbą całkowitą';
		}
	}
	//nie ma bledow - true
	if (count ( $messages ) != 0){
		return false;
	}else{
		return true;
	}
}

// 3. wykonaj zadanie jeśli wszystko w porządku

function process(&$x,&$y,&$z,&$messages,&$result){
	global $role;

	//konwersja parametrów na int
	$x = intval($x);
	$y = intval($y);
	$z = intval($z);

	//wynik: (kwota +kwota *oproc)/(12*lata)
	$result = ($x + $x * $z)/(12*$y);
	
}

// 4. Definicja zmiennych kontrolera
$x = null;
$y = null;
$z = null;
$result = null;
$messages = array();

//pobierz p, wykonaj zadanie jeśli ok
getParams($x,$y,$z);
if ( validate($x,$y,$z,$messages) ) { // gdy brak błędów
	process($x,$y,$z,$messages,$result);
}

// 5. Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';
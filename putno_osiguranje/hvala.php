<?php

require 'connection.php';
$conn    = Connect();

$ime_prezime    = $conn->real_escape_string($_POST['ime_prezime']);
$vrsta_polise   = $conn->real_escape_string($_POST['vrsta_polise']);
$br_tel         = $conn->real_escape_string($_POST['br_tel']);
$datum_od       = $conn->real_escape_string($_POST['datum_od']);
$datum_do       = $conn->real_escape_string($_POST['datum_do']);
$broj_osiguranika = ( empty($_POST['broj_osiguranika']) ) ? '' : $conn->real_escape_string($_POST['broj_osiguranika']);

$broj_osiguranika_array = explode(",",$broj_osiguranika);
$kolicina_osiguranika = count($broj_osiguranika_array);

$query = "INSERT into nosilac_osiguranja(ime_prezime,vrsta_polise,br_telefona,datum_putovanja_od,datum_putovanja_do)
            VALUES ('" . $ime_prezime . "','" . $vrsta_polise . "','" . $br_tel . "','" . $datum_od . "','" . $datum_do . "')";
$success = $conn->query($query);
$id_korisnika = $conn->insert_id;
if (!$success) {
    die("Podaci nisu uneti: ".$conn->error);
}


if ( $vrsta_polise == 'grupno' ){
    $new_query = "INSERT into grupno_osiguranje(id_nosioca_osiguranja,ime_prezime_os,datum_rodjenja) VALUES ";
    for ($i=0; $i<$kolicina_osiguranika; $i++){
        $ime_prezime_os[$i] = $conn->real_escape_string($_POST['ime_prezime_os'.$broj_osiguranika_array[$i]]);
        $datum_rodjenja_os[$i] = $conn->real_escape_string($_POST['datum_rodjenja_os'.$broj_osiguranika_array[$i]]);
        $new_query .= "('" . $id_korisnika . "','" . $ime_prezime_os[$i] . "','" . $datum_rodjenja_os[$i] . "')";
        $i < $kolicina_osiguranika-1 ?  $new_query .= ', ' : '';
    }
    $new_success = $conn->query($new_query);
    if (!$new_success) {
        die("Podaci nisu uneti: ".$conn->error);
    }
}

echo "<h2>Hvala što kupujete kod nas!</h2>";

$conn->close();
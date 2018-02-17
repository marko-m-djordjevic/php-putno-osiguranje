<!DOCTYPE html>
<html>
    <head>
        <title>Podaci osiguranika</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="podaci">
<?php

require 'connection.php';
$conn    = Connect();


if (isset($_GET["page"])){
    $page  = $_GET["page"];
} else { 
    $page=1; 
};
$results_per_page = 10;
$start_from = ($page-1) * $results_per_page;


$query = "SELECT * FROM nosilac_osiguranja LIMIT " . $start_from . ", " . $results_per_page . "";
$success = $conn->query($query);
if (!$success) {
    die("Problem sa bazom: ".$conn->error);
}

$output = "
        <table>
            <tr>
                <th>Ime i prezime</th>
                <th>Vrsta polise</th>
                <th>datum putovanja od</th>
                <th>Datum putovanja do</th>
                <th>Broj telefona</th>
            </tr>";

while( $row = $success->fetch_assoc() ) {
    $output .= "
            <tr>
                <td>" . $row['ime_prezime'] . "</td>
                <td>" . $row['vrsta_polise'] . "</td>
                <td>" . $row['datum_putovanja_od'] . "</td>
                <td>" . $row['datum_putovanja_do'] . "</td>
                <td>" . $row['br_telefona'] . "</td>
            </tr>";
    if ( $row['vrsta_polise'] == 'grupno' ){
        $newquery = "SELECT * FROM grupno_osiguranje WHERE id_nosioca_osiguranja = '" . $row['ID'] . "'";
        $newsuccess = $conn->query($newquery);
        if (!$newsuccess) {
            die("Problem sa bazom: ".$conn->error);
        }
        $output .= '
            <td colspan="5">
                <table style="background-color: aliceblue; float: right;">
                    <tr>
                        <th style="border-color:blue;" colspan="2">Korisnici osiguranja</th>
                    </tr>
                    <tr>
                        <th style="border-color:blue;">Ime i prezime</th>
                        <th style="border-color:blue;">Datum rodjenja</th>
                    </tr>';
        while( $newrow = $newsuccess->fetch_assoc() ){
            $output .= '
                    <tr>
                        <td style="border-color:blue;">' . $newrow['ime_prezime_os'] . '</td>
                        <td style="border-color:blue;">' . $newrow['datum_rodjenja'] . '</td>
                    </tr>';
        }
        $output .='
                </table>
            </td>';
    }
}

$output .= "</table>";

echo $output;

$sql2 = "SELECT COUNT(ID) AS total FROM nosilac_osiguranja"; 
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
$total_pages = ceil($row2["total"] / $results_per_page);

for ($i=1; $i<=$total_pages; $i++) { 
    echo "<a href='http://" .$_SERVER['SERVER_NAME']. "/putno_osiguranje/podaci.php?page=".$i."'>".$i."</a> "; 
}
$conn->close();
?>
    </body>
</html>
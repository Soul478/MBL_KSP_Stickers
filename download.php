<?php
$mysqli= new mysqli("localhost", "root", "", "id_card");

$res = $mysqli -> query("SELECT * FROM crd");

if (mysqli_num_rows($res) > 0) {
    echo
    '
    <table>
        <tr>
            <th scope="col">Serial N°</th>
            <th scope="col">Sticker N°</th>
            <th scope="col">Driver Full Name</th>
            <th scope="col">ID/ IQAMA N°</th>
            <th scope="col">Company Name</th>
            <th scope="col">Car Type</th>
            <th scope="col">Plate N°</th>
            <th scope="col">Vehicule Color</th>
            <th scope="col">Vehicule Model</th>
            <th scope="col">Driver Phone N°</th>
            <th scope="col">Driving Licence Exp</th>
            <th scope="col">Insurrance Exp</th>
        </tr>
    ';
    $num_row = 1;
    while ($row = $res->fetch_assoc()) {
        echo
        '
        <tr>
            <td>'. $row["sno"] . '</td>
            <td>'. $row["nsticker"] . '</td>
            <td>'. $row["name"] . '</td>
            <td>'. $row["id"] . '</td>
            <td>'. $row["company"] . '</td>
            <td>'. $row["ct"] . '</td>
            <td>'. $row["nplate"] . '</td>
            <td>'. $row["vc"] . '</td>
            <td>'. $row["vm"] . '</td>
            <td>'. $row["drp"] . '</td>
            <td>'. $row["drlexp_date"] . '</td>
            <td>'. $row["exp_date"] . '</td>
        </tr>
        ';
        $num_row++;
    }
    echo '</table>';
}

header('Content-Type: application/xls');
header('Content-Disposition: attachme nt; filename=Data.xls');	

$mysqli -> close();
?>
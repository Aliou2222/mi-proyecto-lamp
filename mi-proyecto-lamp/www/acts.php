<?php
//-----------------EDAD------------------------
// $edad = 20;
//     if ($edad < 0) {
//         echo "No es posible esa edad";
//     } elseif ($edad < 18) {
//         echo "Eres una persona menor de edad";
//     } elseif ($edad < 65) {
//         echo "Eres una persona adulta";
//     }else {
//         echo "Eres una persona jubilada";
// }
//-----------------EDAD------------------------
//-----------------P-N-0-P-I------------------------
// $num = 5;
//     if ($num < 0) {
//          $res = " es negativo";
//         } elseif ($num > 0) {
//             $res = " es positivo";
//         }else {
//             $res = " es 0";
// }

// if ($num % 2 === 0) {
//     $pi = " y par.";
// } else {
//     $pi = " e impar.";
// }
// echo "El número $num $res $pi";

//-----------------P-N-0-P-I------------------------


// echo "<table border='1'>";

// for ($filas = 1; $filas <= 4; $filas++) {
//     echo "<tr>";
    
//     for ($cols = 1; $cols <= 5; $cols++) {
//         if ($cols == 1) {
//             echo "<td bgcolor='blue'>$filas, $cols</td>";
//         } elseif ($cols % 2 == 0) {
//             echo "<td bgcolor='red'>$filas, $cols</td>";
//         } else {
//             echo "<td bgcolor='yellow'>$filas, $cols</td>";
//         }
//     }
    
//     echo "</tr>"; 
// }

// echo "</table>"; 



// $frutas = ["manzana", "pera"];

// $frutas[] = "uva";      // añade al final -> [2]
// $frutas[0] = "kiwi";    // modifica la posición 0
// unset($frutas[1]);  // elimina "pera"

// echo "<pre>";
// print_r($frutas);

// echo "</pre>";
// echo count($frutas);


$dias = [1 => "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];


// echo "<pre>";
// print_r($dias);
// echo "</pre>";

// for ($i=1; $i<=7; $i++){
//     echo "<pre>";
//     echo $dias[$i];"<BR>";
//     echo "</pre>";
// }


// $i = 1;
// while ($i <= 7){
//     echo "<pre>";
//     echo $dias[$i];"<BR>";
//     echo "</pre>";
//     $i++;
// }


// $i = 1;
// do {
//     echo "<pre>";
//     echo $dias[$i];"<BR>";
//     echo "<pre>";
//      $i++;
// } while ($i <= 7)



$paisesIdiomas = array(
    "España" => "Español",
    "México" => "Español",
    "Argentina" => "Español",
    "Perú" => "Español",
    "USA" => "Inglés",
    "Inglaterra" => "Inglés",
    "Malta" => "Inglés",
    "Francia" => "Francés",
    "Italia" => "Italiano"
);


// $cont = 0;

// foreach($paisesIdiomas as $pais => $idioma){
//     //echo "$pais tiene como idioma $idioma","<BR>";

//     // if ($idioma == "Español"){
//     //     echo $pais; "<BR>";
//     // }

//     if ($idioma == "Inglés"){
//         $cont++;
//     }
   
// }
//  echo "El numero de países donde se habla inglés son : $cont";




// $alumnos = array(
// 10982312 => array("Nombre" => "Ana", "Apellidos" => "López García", "Curso" => "2ASIR"),
// 11234533 => array("Nombre" => "Daniel", "Apellidos" => "Ruíz Gil", "Curso" => "1DAW"),
// 10992345 => array("Nombre" => "Andrea", "Apellidos" => "Gómez Ros", "Curso" => "2ASIR")
// );

// foreach($alumnos as $nia => $datos){
//     echo "<H1>".$nia."</h1>";
//     foreach ($datos as $indice =>$valor){
//         echo "$indice : $valor <BR>";
//     }
//     echo "****************************";

//     //print_r($datos);
// }


$ventas = array(
2020 => array("Calzado" => 10000, "Ropa" => "35000", "Raquetas" => 5000),
2021 => array("Calzado" => 15000, "Ropa" => "40000", "Raquetas" => 6000),
2022 => array("Calzado" => 20000, "Ropa" => "15000", "Raquetas" => 4000)
);

// echo "<pre>";
// print_r($ventas);
// echo "</pre>";


$suma=0;

echo "<table border='1'>";
echo "<tr><th>Año</th><th>Calzado</th><th>Ropa</th><th>Raquetas</th></tr>";
    foreach ($ventas as $anio => $productos) { // bucle exterior: años
//if ($anio == 2021){
echo "<tr><td>$anio</td>";
    foreach ($productos as $cantidad) { // bucle interior: categorías
echo "<td>$cantidad</td>";
$suma = $suma + $cantidad;

}

//}
echo "</tr>";
}
echo "</table>";
echo "La suma total es $suma";





?>
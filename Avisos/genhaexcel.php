<?php
require 'database.php';
require '../vendor/autoload.php'; // Asegúrate de incluir el autoloader de Composer

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$id_usuario = $_POST['id_usuario']; // Recibe el parámetro del formulario

$query = "SELECT AtencionContrato, AtencionNCliente, AtencionProblema, AtencionCSolucion, AtencionRazon, AtencionHora, AtencionFecha, AtencionSolucion, AtencionTransferencia, AtencionTipo FROM atenciones a INNER JOIN usuario u ON a.AtencionUsuario = u.id_usuario WHERE u.id_usuario = ?";

// Prepara la sentencia
$stmt = mysqli_prepare($conn, $query);

// Verifica si la preparación fue exitosa
if ($stmt === false) {
    die('Error en la preparación: ' . mysqli_error($conn));
}

// Enlaza el parámetro
mysqli_stmt_bind_param($stmt, "i", $id_usuario);

// Ejecuta la consulta
mysqli_stmt_execute($stmt);

// Obtiene los resultados
$result = mysqli_stmt_get_result($stmt);

// Cargar el archivo de Excel existente
$spreadsheet = IOFactory::load('documentos/ATENCIONES.xlsx');
$sheet = $spreadsheet->getActiveSheet();

// Escribir datos de la consulta
$fila = 4; // Comenzar en la fila 4 para dejar las filas de encabezados

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $columna = 'C';
        foreach ($row as $key => $dato) {
            // Verifica y ajusta los valores para AtencionSolucion y AtencionTipo
            if ($key === 'AtencionSolucion') {
                $dato = ($dato == 1) ? 'SI' : (($dato == 2) ? 'NO' : $dato);
            } elseif ($key === 'AtencionTipo') {
                $dato = ($dato == 1) ? 'Chat' : (($dato == 2) ? 'Telefonica' : $dato);
            }
            $sheet->setCellValue($columna . $fila, $dato);
            $columna++; // Incrementar la columna
        }
        $fila++;
    }
} else {
    // No se encontraron datos
    $sheet->setCellValue('B4', 'No se encontraron registros para el usuario.');
}

// Cerrar conexión
mysqli_close($conn);

// Exportar a archivo Excel
$writer = new Xlsx($spreadsheet);
$nombreArchivo = 'datos_exportados.xlsx';

// Configurar cabeceras para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$nombreArchivo\"");
header('Cache-Control: max-age=0');

// Guardar el archivo en la salida
$writer->save('php://output');
exit;
?>

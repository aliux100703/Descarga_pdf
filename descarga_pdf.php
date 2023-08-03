<?php
require 'tcpdf/tcpdf.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "u995420991_misteryp";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Verificar si se proporcionó el parámetro 'id'
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idSeleccionado = $_GET['id'];

    // Consulta SQL para obtener los campos de la tabla visita para el ID seleccionado
    $sql = "SELECT * FROM visita WHERE id = ?";
    
    // Preparar la consulta usando una sentencia preparada
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idSeleccionado);
    $stmt->execute();
    
    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontró el registro
    if ($result->num_rows === 1) {
        // Crear un objeto TCPDF
        $pdf = new TCPDF('P', 'mm', 'Letter', true, 'UTF-8', false);

        // Establecer el título del documento
        $pdf->SetTitle('Reporte de Visita');

        // Agregar una página
        $pdf->AddPage();

        // Establecer el contenido del PDF
        $pdf->SetFont('Helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'Reporte de Visita', 0, 1, 'C');

    $preguntas = [
       "Fecha",
       "Lugar",
       "Direccion",
       "Responsable",
        "RESERVA",
    "¿Le atendieron en la primera llamada?",
    "¿Le tomaron la llamada antes del 3er tono?",
    "¿La persona que atendio menciono el nombre del restaurante?",
    "¿La persona que atendio menciono su nombre?",
    "PODIUM",
    "¿Para que día le gustaria su reservación?",
    "¿A que hora le gustaria su reservacion?",
    "¿En caso de no contar con disponibilidad, le dieron alternativas?",
    "",
    "¿Para cuantas personas es la reservación?",
    "¿Festejan algo?",
    "¿Nos acompañan menores a la mesa?",
    "¿Alguno de los invitados tiene alguna alergia?",
    "¿Alguna zona de su preferencia?",
    "¿Le informaron el codigo de vestimenta del restaurane?",
    "",
    "¿Resovieron sus dudas?",
    "",
    "¿Le comentaron el tiempo de tolerancia para acudir a su reserva?",
    "¿Le confirmaron todos los datos y especificaciones de su reserva?",
    "¿Le agradecieron por su reserva y se portaron amablemente?",
    "¿Le comentaron que sera un gusto recibirlos como invitados?",
    "¿Se despidieron amablemente?",
    "LLEGADA AL RESTAURANTE",
    "¿Al llegar al restaurante le preguntaron si tenia reserva?",
    "¿Le corroboraron toas las especificaciones de su reserva?",
    "¿Lo pasaron inmediatamente a su mesa?",
    "¿La mesa asignada fue en la zona que solicito?",
    "¿La hostess los acompaño a su mesa?",
    "¿La hostess Le abrio la silla?",
    "¿La hostess tuvo la cortesia de acercarle un perchero?",
    "¿La hostess presento al capitan de zona?",
    "",
    "¿La hostess les dio la bienvenida llamandolo por su nombre?",
    "PASOS DE SERVICIO",
    "¿Lo recibio el capitan en su mesa dandole la bienvenida por su nombre?",
    "¿El capitan se presento por su nombre y presento al mesero en que brindara el servicio?",
    "¿En caso de tener alguna alergia o restriccion, el capitan corroboro el dato e identifico al invitado?",
    "¿El capitan le hico recomendaciones de bebidas de aperitivos?",
    "¿El mesero se presento nuevamente y ofrecio el menú?",
    "¿El ayudante retiro los servicios extras?",
    "",
    "¿Una vez las bebidas en la mesa, el mesero le indico las especialidades?",
    "¿El mesero sirvio la amenidadde la casa y la explico correctamente?",
    "¿Le aclararon dudas o preguntas sobre el menu?",
    "¿En caso de pedir carne o pescado, el mesero pregunto el termino de su gusto?",
    "¿Le ofrecieron maridaje de vino para sus alimentos?",
    "¿Mantuvieron la mesa siempre limpia durante los diferentes tiempos de alimentos?",
    "¿Le marcaron con cubiertos la mesa entre tiempos de platillos antes de que llegara el proximo alimento?",
    "¿Al llegar la carne a la mesa el mesero corroboro que el termino fuera el correcto?",
    "¿En todo momento hubo cuchareo disponible para los platillos al centro?",
    "¿Hubo re oferta de bebidas poco antes de terminar la que tenia en mesa?",
    "¿Tuvo que solicitar algun servicio extra, como servilletas, cubiertos, o menage, por descuido del mesero?",
   
    "¿Al preguntar sobre los sanitarios, algun miembro del staff lo escolto hasta el lugar?",
     "",
    "¿Al volver a la mesa de brindaron la cortesia de abrir su asiento?",
    "¿En algun momento algun colaborador no le cedio el paso?",
    "¿En caso de alguna celebracion le llevaron el pastel de cortesia sin pedirlo?",
    "¿Le ofrecieron postre?",
    "¿Le ofrecieron café y digestivos?",
    "¿Una vez terminado su servicio le limpiaron completamente su mesa?",
    "¿El mesero tuvo absoluto conocimiento de los alimentos y las bebidas?",
    "CAPITAN",
    "¿El capitan tomo toda su orden?",
    "¿El capitan estuvo pendiente de su mesa en todo momento?",
    "¿Supo resolver cualquier incidencia que se haya sucitado durante su servicio?",
    "¿El capitan se denotaba como lider haciendo que su equipo fluyera de manera tranquila y sin caos?",
    "¿El capitan tiene absoluto conocimiento de todos los servicios?",
    "¿El capitan mantenia el orden en su estacion con sus equipos?",
    "¿El capitan hizo recomendaciones acertadas?",
    "¿El capitan le vendio algo extra que usted no pensaba consumir?",
    "¿El capitan se mostro amable y accesible en todo momento?",
    "¿El capitan recibio a otras mesas dandoles la bienvenida?",
    "",
    "¿El capitan estuvo pendiente de otras mesas?",
    "",
    "¿El capitan tomo la orden de otras mesas?",
    "",
    "¿El capitan hizo recomendaciones acertadas?",
    "¿El capitan mantuvo el control de su estacion?",
    "¿El capitan trajo la cuenta y la terminal al mismo tiempo?",
    "¿El capitan le realizo el cobro de su cuenta?",
    "¿El capitan se mostro agradecido por la propina otorgada?",
    "¿El capitan solicito algun porcentaje de la propina o hizo referencia a la misma?",
    "¿El capitan solicito dejar un comentario en redes?",
    "¿El capitan corroboro su nombre y agradecio su visita?",
    "¿El capitan realizo relaciones publicas y ofrecio su telefono para proximas reservaciones?",
    "¿El capitan lo llamo por su nombre durante todo su servicio?",
    "GERENTE",
    "¿Les dio la bienvenida mencionando su el nombre del invitado?",
    "¿Se presnento por su nombre y agradecio su visita?",
    "¿Se puso a sus ordenes para cualquier solicitud?",
    "¿Menciono que estara a cargo de que vivan una magnifica experiencia?",
    "¿Se acerco al segundo bocado de su plato fuerte para preguntar: termino, que le hace falta, como va todo al momento, necesita algo mas/puedo hacer algo mas por ustedes?",
    "",
    "Termino, que le hace falta, como va todo al momento, necesita algo mas/puedo hacer algo mas por ustedes?",
    "¿En caso de tener alguna solicitud extraordinaria, el gerente la resolvio satisfactoriamente?",
    "¿El gerente se mostro como lider y realizo los pasos anteriores en otras mesas?",
    "¿El gerente mantenia el control y el orden con su equipo de capitanes?",
    "¿El gerente estuvo presente en el comedor en todo momento?",
    "¿Al pagar la cuenta, el gerente se acerco a realizarle preguntas de poder?",
    "",
    "¿Me ayuda con algo… si hubiera algo en lo que pudieramos mejorar que seria, 1 sola cosa?",
    "¿El gerente agradecio su visita y lo invito a volver?",
    "¿El gerente realizo PR y le entrego su tarjeta para proximas reservas?",
    "ATENCIÓN AL CLIENTE Y TIEMPOS",
    "Amabilidad y atencion de la hostes",
    "Amabilidad y atencion del mesero",
    "Amabilidad y atencion del capitan",
    "Amibilidad y atencion del gerente",
    "Resolucion de problemas de gerente/capitan",
    "Tiempo de entrega de bebidas",
    "Tiempo de entrega de set de mesa",
    "Tiempo de entrega de entradas",
    "Tiempo de entrega de plato fuerte",
    "Tiempo y entrega de poster",
    "Tiempo de entrega de digestivo o café",
    "Tiempo de entrega y cobro de cuenta",
    "Sabor de los alimentos",
    "Temperatura de los alimentos",
    "Presentacion de los alimentos",
    "Sabor de las bebidas",
    "Presentacion de las bebidas",
    "Calidad y frescura de los alimentos",
    "Nivel de auidio o musica",
    "Ambientacion del lugar",
    "Limpieza general del restaurante",
    "Limpieza de los baños y amenidades completas",
    "Limpieza de la loza, plaque y cristaleria",
    "total",
    "",
  ];
  

$respuesta=[];
  
while ($row = $result->fetch_assoc()) {

    $respuesta[]=$row["fecha"];
    $respuesta[]=$row["lugar"];
    $respuesta[]=$row["direccion"];
   $respuesta[]=$row["responsable"];
   $respuesta[] = $row["r1"];
     $respuesta[]=$row["v1"];
    $respuesta[]=$row["v2"];
     $respuesta[]=$row["v3"];
    $respuesta[]=$row["v4"];
    // Imprimir V5 al V19 en las celdas B18 a B32
    $respuesta[]=$row["r2"];
    $respuesta[]=$row["v5"];
    $respuesta[]=$row["v6"];
    $respuesta[]=$row["v7"];
    $respuesta[]=$row["com7"];
   $respuesta[]=$row["v8"];
     $respuesta[]=$row["v9"];
    $respuesta[]=$row["v10"];
    $respuesta[]=$row["v11"];
    $respuesta[]=$row["v12"];
    $respuesta[]=$row["v13"];
    $respuesta[]=$row["com13"];
    $respuesta[]=$row["v14"];
    $respuesta[]=$row["com14"];
    $respuesta[]=$row["v15"];
    $respuesta[]=$row["v16"];
    $respuesta[]=$row["v17"];
    $respuesta[]=$row["v18"];
    $respuesta[]=$row["v19"];
    // Imprimir V20 al V28 en las celdas B34 a B42
    $respuesta[]=$row["r3"];
     $respuesta[]=$row["v20"];
    $respuesta[]=$row["v21"];
     $respuesta[]=$row["v22"];
     $respuesta[]=$row["v23"];
     $respuesta[]=$row["v24"];
     $respuesta[]=$row["v25"];
     $respuesta[]=$row["v26"];
     $respuesta[]=$row["v27"];
     $respuesta[]=$row["com27"];
     $respuesta[]=$row["v28"];
    // Imprimir V29 al V53 en las celdas B44 a B68
    $respuesta[]=$row["r4"];
     $respuesta[]=$row["v29"];
    $respuesta[]=$row["v30"];
    $respuesta[]=$row["v31"];
     $respuesta[]=$row["v32"];
    $respuesta[]=$row["v33"];
     $respuesta[]=$row["v34"];
     $respuesta[]=$row["com34"];
    $respuesta[]=$row["v35"];
    $respuesta[]=$row["v36"];
    $respuesta[]=$row["v37"];
    $respuesta[]=$row["v38"];
    $respuesta[]=$row["v39"];
    $respuesta[]=$row["v40"];
    $respuesta[]=$row["v41"];
    $respuesta[]=$row["v42"];
    $respuesta[]=$row["v43"];
    $respuesta[]=$row["v44"];
    $respuesta[]=$row["v45"];
    $respuesta[]=$row["v46"];
    $respuesta[]=$row["com46"];
    $respuesta[]=$row["v47"];
    $respuesta[]=$row["v48"];
    $respuesta[]=$row["v49"];
    $respuesta[]=$row["v50"];
    $respuesta[]=$row["v51"];
    $respuesta[]=$row["v52"];
    $respuesta[]=$row["v53"];
    // Imprimir V54 al V75 en las celdas B70 a B91
    $respuesta[]=$row["r5"];
    $respuesta[]=$row["v54"];
    $respuesta[]=$row["v55"];
    $respuesta[]=$row["v56"];
  
    $respuesta[]=$row["v57"];
    $respuesta[]=$row["v58"];
    $respuesta[]=$row["v59"];
    $respuesta[]=$row["v60"];
    $respuesta[]=$row["v61"];
    $respuesta[]=$row["v62"];
    $respuesta[]=$row["v63"];
    $respuesta[]=$row["com63"];
    $respuesta[]=$row["v64"];
    $respuesta[]=$row["com64"];
    $respuesta[]=$row["v65"];
    $respuesta[]=$row["com65"];
    $respuesta[]=$row["v66"];
    $respuesta[]=$row["v67"];
    $respuesta[]=$row["v68"];
    $respuesta[]=$row["v69"];
    $respuesta[]=$row["v70"];
    $respuesta[]=$row["v71"];
    $respuesta[]=$row["v72"];
    $respuesta[]=$row["v73"];
    $respuesta[]=$row["v74"];
    $respuesta[]=$row["v75"];
    // Imprimir V76 al V89 en las celdas B93 a B105
    $respuesta[]=$row["r6"];
    $respuesta[]=$row["v76"];
    $respuesta[]=$row["v77"];
    $respuesta[]=$row["v78"];
    $respuesta[]=$row["v79"];
    $respuesta[]=$row["v80"];
    $respuesta[]=$row["com80"];
    $respuesta[]=$row["v81"];
    $respuesta[]=$row["v82"];
    $respuesta[]=$row["v83"];
    $respuesta[]=$row["v84"];
    $respuesta[]=$row["v85"];
    $respuesta[]=$row["v86"];
    $respuesta[]=$row["com86"];
    $respuesta[]=$row["v87"];
    $respuesta[]=$row["v88"];
    $respuesta[]=$row["v89"];
    // Imprimir V90 al V112 en las celdas B108 a B130
    $respuesta[]=$row["r7"];
    $respuesta[]=$row["v90"];
    $respuesta[]=$row["v91"];
    $respuesta[]=$row["v92"];
    $respuesta[]=$row["v93"];
    $respuesta[]=$row["v94"];
    $respuesta[]=$row["v95"];
    $respuesta[]=$row["v96"];
    $respuesta[]=$row["v97"];
    $respuesta[]=$row["v98"];
    $respuesta[]=$row["v99"];
    $respuesta[]=$row["v100"];
    $respuesta[]=$row["v101"];
    $respuesta[]=$row["v102"];
    $respuesta[]=$row["v103"];
    $respuesta[]=$row["v104"];
    $respuesta[]=$row["v105"];
    $respuesta[]=$row["v106"];
    $respuesta[]=$row["v107"];
    $respuesta[]=$row["v108"];
    $respuesta[]=$row["v109"];
    $respuesta[]=$row["v110"];
    $respuesta[]=$row["v111"]; 
    $respuesta[]=$row["v112"];
     $respuesta[]=$row["total"];
     $respuesta[]=$row["com56"];  
  //comentarios adicionale;
    
  $pdf->SetFont('Helvetica', 'B', 12);
  $pdf->Cell(0, 10, 'Preguntas adicionales:', 0, 1);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Si una pregunta no tienen nada es comentario', 0, 1);


$numPreguntas = count($preguntas);
for ($i = 0; $i < $numPreguntas; $i++) {
    $pregunta = $preguntas[$i];
    $resp = $respuesta[$i];

    $pdf->SetFont('Helvetica', '', 12);
    $pdf->MultiCell(0, 6, ' ' . $pregunta, 0, 'L');
    $pdf->MultiCell(0, 6, ' ' . $resp, 0, 'L');
    $pdf->Cell(0, 6, '', 0, 1); // Espacio entre preguntas y respuestas
}
    }
// Cerrar el objeto PDF
$pdf->Output('reporte_visita.pdf', 'D');
} else {
    echo "No se encontró un registro con el ID proporcionado.";
}

// Cerrar el resultado de la consulta, el objeto preparado y la conexión a la base de datos
$result->free_result();
$stmt->close();
$conn->close();
} else {
    echo "No se proporcionó un ID válido.";
}
// Cerrar la conexión a la base de datos
$conn->close();

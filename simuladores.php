<?php
session_start();

// Captura del test seleccionado (por defecto 'snellen')
$testActivo = isset($_GET['test']) ? $_GET['test'] : 'snellen';

// -------------------------------------------------------------
// 1. LÓGICA SNELLEN (Puntuación e ingreso de texto)
// -------------------------------------------------------------
$lineasSnellen = [
    ["letras" => "E", "av" => "20/200 (0.1)", "tamaño" => "85px", "explicacion" => "Si solo ves esta 'E', tenés una visión muy reducida."],
    ["letras" => "F P", "av" => "20/100 (0.2)", "tamaño" => "65px", "explicacion" => "Segunda fila. Evaluación básica."],
    ["letras" => "T O Z", "av" => "20/70 (0.3)", "tamaño" => "48px", "explicacion" => "Tercera fila. Distancia promedio."],
    ["letras" => "L P E D", "av" => "20/50 (0.4)", "tamaño" => "34px", "explicacion" => "Exige mayor enfoque."],
    ["letras" => "P E C F D", "av" => "20/40 (0.5)", "tamaño" => "25px", "explicacion" => "Mínimo exigido para licencias de conducir."],
    ["letras" => "E D F C Z P", "av" => "20/30 (0.7)", "tamaño" => "18px", "explicacion" => "Buena agudeza visual de lejos."],
    ["letras" => "F E L O P Z D", "av" => "20/20 (1.0)", "tamaño" => "12px", "explicacion" => "¡Visión 10/10! Estándar normal."]
];

// Reiniciar puntaje explícito de Snellen
if (isset($_GET['reiniciar_snellen'])) {
    unset($_SESSION['snellen_puntos']);
    unset($_SESSION['snellen_total']);
    header("Location: simuladores.php?test=snellen&snellen=0");
    exit();
}

$posSnellen = isset($_GET['snellen']) ? (int)$_GET['snellen'] : 0;

if ($posSnellen === 0 && $_SERVER['REQUEST_METHOD'] !== 'POST' && $testActivo == 'snellen') {
    $_SESSION['snellen_puntos'] = 0;
    $_SESSION['snellen_total'] = 0;
}

if (!isset($_SESSION['snellen_puntos'])) { $_SESSION['snellen_puntos'] = 0; }
if (!isset($_SESSION['snellen_total'])) { $_SESSION['snellen_total'] = 0; }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['letras_ingresadas'])) {
    $ingresoLimpio = strtoupper(str_replace(' ', '', trim($_POST['letras_ingresadas'])));
    $realLimpio = strtoupper(str_replace(' ', '', trim($lineasSnellen[$posSnellen]['letras'])));
    
    $totalLetrasFila = strlen($realLimpio);
    $aciertosFila = 0;

    for ($i = 0; $i < min(strlen($ingresoLimpio), $totalLetrasFila); $i++) {
        if ($ingresoLimpio[$i] === $realLimpio[$i]) {
            $aciertosFila++;
        }
    }

    $_SESSION['snellen_puntos'] += $aciertosFila;
    $_SESSION['snellen_total'] += $totalLetrasFila;

    $posSnellen++;
    if ($posSnellen < count($lineasSnellen)) {
        header("Location: simuladores.php?test=snellen&snellen=" . $posSnellen);
        exit();
    } else {
        $posSnellen = count($lineasSnellen);
    }
}

$snellenActual = ($posSnellen < count($lineasSnellen)) ? $lineasSnellen[$posSnellen] : null;

// -------------------------------------------------------------
// 2. LÓGICA ISHIHARA (Orden mezclado sin descripciones)
// -------------------------------------------------------------
$placasIshihara = [
    ['file' => '8.jpg',       'correct' => ['8']],
    ['file' => 'mancha.jpg',  'correct' => ['ninguno', 'nada', 'sin numero', 'camino', 'linea']],
    ['file' => '42.jpg',      'correct' => ['42']],
    ['file' => '3rp.jpg',     'correct' => ['3', '5']],
    ['file' => '12.jpg',      'correct' => ['12']],
    ['file' => '74.jpg',      'correct' => ['74']],
    ['file' => 'mancha4.jpg', 'correct' => ['ninguno', 'nada', 'sin numero', 'camino', 'linea']],
    ['file' => '2.jpg',       'correct' => ['2']],
    ['file' => '95.jpg',      'correct' => ['97']],
    ['file' => '5.jpg',       'correct' => ['5']],
    ['file' => 'mancha3.jpg', 'correct' => ['ninguno', 'nada', 'sin numero', 'camino', 'linea']],
    ['file' => '16.jpg',      'correct' => ['16']],
    ['file' => '2rp.jpg',     'correct' => ['2']],
    ['file' => '29.jpg',      'correct' => ['29']],
    ['file' => '1.jpg',       'correct' => ['1']],
    ['file' => 'mancha2.jpg', 'correct' => ['ninguno', 'nada', 'sin numero', 'camino', 'linea']],
    ['file' => '6.jpg',       'correct' => ['6']],
    ['file' => '45.jpg',      'correct' => ['45']],
    ['file' => '3.jpg',       'correct' => ['3']],
    ['file' => '9.jpg',       'correct' => ['5', '9']],
    ['file' => '4.jpg',       'correct' => ['4']],
    ['file' => '7.jpg',       'correct' => ['7']]
];

// Reiniciar Ishihara
if (isset($_GET['reiniciar_ishihara'])) {
    unset($_SESSION['ishihara_respuestas']);
    header("Location: simuladores.php?test=ishihara&ishihara=0");
    exit();
}

$posIshihara = isset($_GET['ishihara']) ? (int)$_GET['ishihara'] : 0;

if ($posIshihara === 0 && $_SERVER['REQUEST_METHOD'] !== 'POST' && $testActivo == 'ishihara') {
    $_SESSION['ishihara_respuestas'] = [];
}

if (!isset($_SESSION['ishihara_respuestas'])) {
    $_SESSION['ishihara_respuestas'] = [];
}

// Procesar respuesta de la placa actual
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resp_ishihara_individual'])) {
    $respuestaDada = trim(mb_strtolower($_POST['resp_ishihara_individual']));
    $_SESSION['ishihara_respuestas'][$posIshihara] = $respuestaDada;

    $posIshihara++;
    if ($posIshihara < count($placasIshihara)) {
        header("Location: simuladores.php?test=ishihara&ishihara=" . $posIshihara);
        exit();
    } else {
        $posIshihara = count($placasIshihara);
    }
}

$ishiharaActual = ($posIshihara < count($placasIshihara)) ? $placasIshihara[$posIshihara] : null;

// -------------------------------------------------------------
// 3. OTROS TESTS (Reloj y Duocromo)
// -------------------------------------------------------------
$opcionDuocromo = isset($_GET['duocromo']) ? $_GET['duocromo'] : '';
$opcionReloj = isset($_GET['reloj']) ? $_GET['reloj'] : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simuladores Visuales - Hackathon Sabattini</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --azul: #0056b3; --azul-claro: #00a8cc; --fondo: #f4f7f6; --oscuro: #181b24; }
        * { margin:0; padding:0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: var(--fondo); color: #222; }
        
        header { background: var(--oscuro); color: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; }
        .btn-volver { background: var(--azul-claro); color: white; text-decoration: none; padding: 8px 16px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }

        .contenedor { padding: 30px 5%; max-width: 900px; margin: 0 auto; }
        h2 { color: var(--azul); text-align: center; margin-bottom: 20px; }

        /* PESTAÑAS Y NAVEGACIÓN */
        .selector-tests { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin-bottom: 25px; }
        .tab-btn {
            background: white; color: var(--azul); border: 2px solid var(--azul);
            padding: 10px 18px; border-radius: 25px; text-decoration: none;
            font-weight: 600; font-size: 0.9rem; transition: all 0.3s ease;
        }
        .tab-btn:hover, .tab-btn.activo { background: var(--azul); color: white; box-shadow: 0 4px 10px rgba(0,86,179,0.2); }

        /* DISTANCIA Y AVISOS */
        .cartel-distancia {
            background: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb;
            padding: 12px 20px; border-radius: 10px; margin-bottom: 20px;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            font-size: 0.92rem; font-weight: 500; text-align: center;
        }

        /* CARD DE CADA TEST */
        .card-test { background: white; padding: 30px; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.08); text-align: center; }
        
        .caja-visual { 
            background: #ffffff; border: 2px solid #e0e0e0; height: 220px; 
            display: flex; justify-content: center; align-items: center; 
            margin: 20px 0; border-radius: 12px; position: relative; overflow: hidden;
        }
        .letras { font-weight: 700; letter-spacing: 8px; font-family: monospace; }

        /* INPUTS Y FORMULARIOS */
        .form-snellen { margin-top: 15px; display: flex; flex-direction: column; align-items: center; gap: 10px; }
        .input-letras {
            padding: 10px; border: 2px solid var(--azul-claro); border-radius: 8px;
            font-size: 1.1rem; text-align: center; text-transform: uppercase;
            width: 240px; font-weight: 600; letter-spacing: 2px;
        }
        .btn-accion { background: var(--azul); color: white; border: none; padding: 10px 22px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.95rem; text-decoration: none; display: inline-block; }
        .btn-accion:hover { background: #004085; }

        .duocromo { display: flex; width: 100%; height: 100%; font-weight: 700; font-size: 2rem; }
        .mitad { flex: 1; display: flex; justify-content: center; align-items: center; }
        .rojo { background: #ff4d4d; color: white; } .verde { background: #2ecc71; color: white; }

        .reloj { width: 160px; height: 160px; border: 4px solid #333; border-radius: 50%; position: relative; margin: 0 auto; }
        .num { position: absolute; font-weight: 700; font-size: 0.9rem; }
        .n12 { top: 5px; left: 45%; } .n6 { bottom: 5px; left: 47%; } .n3 { right: 8px; top: 43%; } .n9 { left: 8px; top: 43%; }
        .linea { position: absolute; background: #333; }
        .linea-v { width: 2px; height: 100%; left: 50%; top: 0; }
        .linea-h { width: 100%; height: 2px; left: 0; top: 50%; }

        .img-ishihara { max-height: 180px; border-radius: 50%; border: 3px solid #ccc; }
        .btn-items { display: flex; gap: 10px; justify-content: center; margin: 15px 0; flex-wrap: wrap; }
        .btn-sub { padding: 8px 16px; background: #f0f0f0; color: #333; text-decoration: none; border-radius: 6px; font-size: 0.85rem; font-weight: 600; }
        .btn-no-ver { background: #e74c3c; color: white; border: none; padding: 8px 14px; border-radius: 6px; font-size: 0.85rem; cursor: pointer; font-weight: 600; }
        .btn-no-ver:hover { background: #c0392b; }
        .info { background: #eef4f8; padding: 15px; border-radius: 8px; font-size: 0.9rem; text-align: left; margin-top: 15px; border-left: 4px solid var(--azul-claro); }

        /* TABLA Y RESUMEN ISHIHARA */
        .tabla-resumen { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.88rem; }
        .tabla-resumen th, .tabla-resumen td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        .tabla-resumen th { background: var(--azul); color: white; }
        .res-ok { background: #d4edda; color: #155724; font-weight: bold; }
        .res-err { background: #f8d7da; color: #721c24; font-weight: bold; }

        /* VENTANA MODAL DE ADVERTENCIA */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.65); display: flex; justify-content: center; align-items: center;
            z-index: 1000; padding: 20px;
        }
        .modal-contenido {
            background: white; border-radius: 14px; padding: 25px; max-width: 500px;
            width: 100%; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .modal-contenido h3 { color: #d9534f; margin-bottom: 12px; font-size: 1.3rem; }
        .modal-contenido p { font-size: 0.9rem; color: #444; line-height: 1.5; margin-bottom: 20px; }
        .btn-entendido { background: var(--azul); color: white; border: none; padding: 10px 25px; border-radius: 20px; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>

    <!-- MODAL DE ADVERTENCIA INICIAL -->
    <div id="modalAdvertencia" class="modal-overlay">
        <div class="modal-contenido">
            <h3>⚠️ Aviso Médico de Uso Educativo</h3>
            <p>
                Esta plataforma es un <strong>simulador únicamente educativo</strong> desarrollado por estudiantes.
                <br><br>
                <strong>No emite diagnósticos médicos ni recetas de graduación visual</strong>. La información obtenida sirve únicamente como orientación preliminar para sugerir si es prudente acudir a una revisión profesional con un <strong>oftalmólogo u optómetra</strong>.
            </p>
            <button class="btn-entendido" onclick="cerrarModal()">Comprendo y deseo continuar</button>
        </div>
    </div>

    <header>
        <h1>Simuladores Visuales</h1>
        <a href="index.php" class="btn-volver">⬅ Menú Principal</a>
    </header>

    <div class="contenedor">
        <h2>Selecciona la Prueba Visual</h2>

        <!-- BOTONES DE SELECCIÓN -->
        <div class="selector-tests">
            <a href="simuladores.php?test=snellen" class="tab-btn <?php echo ($testActivo == 'snellen') ? 'activo' : ''; ?>">👓 Miopía (Snellen)</a>
            <a href="simuladores.php?test=reloj" class="tab-btn <?php echo ($testActivo == 'reloj') ? 'activo' : ''; ?>">🎯 Astigmatismo (Reloj)</a>
            <a href="simuladores.php?test=duocromo" class="tab-btn <?php echo ($testActivo == 'duocromo') ? 'activo' : ''; ?>">🔴🟢 Duocromo</a>
            <a href="simuladores.php?test=ishihara" class="tab-btn <?php echo ($testActivo == 'ishihara') ? 'activo' : ''; ?>">🎨 Daltonismo (Ishihara)</a>
        </div>

        <!-- TEST 1: SNELLEN -->
        <?php if ($testActivo == 'snellen'): ?>
            <div class="cartel-distancia">
                <span>📏</span> <span>Distancia sugerida: Colócate a <strong>1.5 a 2 metros</strong> de la pantalla. Cúbrete un ojo sin hacer presión.</span>
            </div>

            <div class="card-test">
                <h3>Test de Agudeza Visual (Miopía)</h3>
                <p>Ingresa las letras que distingues en la pantalla de arriba hacia abajo (con o sin espacios).</p>

                <?php if ($snellenActual !== null): ?>
                    <div class="caja-visual">
                        <div class="letras" style="font-size: <?php echo $snellenActual['tamaño']; ?>;">
                            <?php echo $snellenActual['letras']; ?>
                        </div>
                    </div>

                    <form method="POST" class="form-snellen" autocomplete="off">
                        <label for="letras_ingresadas" style="font-size: 0.85rem; font-weight: 600;">Escribe las letras que ves:</label>
                        <input type="text" name="letras_ingresadas" id="letras_ingresadas" class="input-letras" placeholder="Ej: E o FP" required autofocus>
                        <button type="submit" class="btn-accion">Enviar Fila y Avanzar</button>
                    </form>

                    <div class="info">
                        <p><strong>Fila actual:</strong> <?php echo ($posSnellen + 1); ?> de <?php echo count($lineasSnellen); ?> | <strong>Nivel AV:</strong> <?php echo $snellenActual['av']; ?></p>
                        <p><strong>Aciertos acumulados:</strong> <?php echo $_SESSION['snellen_puntos']; ?> de <?php echo $_SESSION['snellen_total']; ?> letras evaluadas.</p>
                    </div>
                <?php else: ?>
                    <?php 
                        $puntos = $_SESSION['snellen_puntos'];
                        $total = $_SESSION['snellen_total'];
                        $porcentaje = ($total > 0) ? round(($puntos / $total) * 100) : 0;
                    ?>
                    <div class="caja-visual" style="flex-direction: column; height: auto; padding: 20px;">
                        <h4 style="color: var(--azul); font-size: 1.4rem;">Evaluación Completada</h4>
                        <p style="font-size: 1.1rem; margin-top: 10px;">Puntaje total: <strong><?php echo $puntos; ?> / <?php echo $total; ?></strong> letras correctas (<?php echo $porcentaje; ?>% de precisión).</p>
                    </div>

                    <div class="info" style="border-left-color: <?php echo ($porcentaje < 75) ? '#d9534f' : '#2ecc71'; ?>;">
                        <h4 style="margin-bottom: 8px;">📋 Sugerencia de Orientación (Sin Diagnóstico Médico):</h4>
                        <?php if ($porcentaje >= 85): ?>
                            <p>Tu agudeza visual demostró un alto nivel de precisión en la simulación. No obstante, si sientes fatiga visual o dolores de cabeza, te recomendamos realizarte un chequeo preventivo con un especialista.</p>
                        <?php elseif ($porcentaje >= 60): ?>
                            <p>Presentaste algunas inconsistencias o fallas en filas intermedias/pequeñas. <strong>Sugerencia:</strong> Sería conveniente agendar un examen clínico con un optómetra u oftalmólogo para verificar tu graduación.</p>
                        <?php else: ?>
                            <p style="color: #c0392b; font-weight: 600;">Se detectaron dificultades para distinguir varias líneas de letras.</p>
                            <p><strong>Recomendación:</strong> Te sugerimos fuertemente asistir a una consulta profesional con un médico oftalmólogo para una evaluación presencial exhaustiva.</p>
                        <?php endif; ?>
                    </div>

                    <a href="simuladores.php?test=snellen&reiniciar_snellen=1" class="btn-accion" style="margin-top: 20px;">Reiniciar Test de Miopía</a>
                <?php endif; ?>
            </div>

        <!-- TEST 2: CÍRCULO HORARIO -->
        <?php elseif ($testActivo == 'reloj'): ?>
            <div class="cartel-distancia">
                <span>📏</span> <span>Distancia sugerida: Ubícate a 1 metro de la pantalla.</span>
            </div>

            <div class="card-test">
                <h3>Test de Círculo Horario (Astigmatismo)</h3>
                <p>Evalúa si la córnea enfoca la luz con distorsión en distintos ejes.</p>

                <div class="caja-visual">
                    <div class="reloj">
                        <div class="linea linea-v"></div>
                        <div class="linea linea-h"></div>
                        <div class="num n12">12</div><div class="num n3">3</div>
                        <div class="num n6">6</div><div class="num n9">9</div>
                    </div>
                </div>

                <p><strong>¿Observas alguna línea más enfocada o definida?</strong></p>
                <div class="btn-items">
                    <a href="simuladores.php?test=reloj&reloj=v" class="btn-sub">Línea Vertical (12 - 6)</a>
                    <a href="simuladores.php?test=reloj&reloj=h" class="btn-sub">Línea Horizontal (3 - 9)</a>
                    <a href="simuladores.php?test=reloj&reloj=i" class="btn-sub">Todas Iguales</a>
                </div>

                <div class="info" style="border-left-color: <?php echo ($opcionReloj == 'i' || $opcionReloj == '') ? '#2ecc71' : '#d9534f'; ?>;">
                    <h4 style="margin-bottom: 8px;">📋 Sugerencia de Orientación (Sin Diagnóstico Médico):</h4>
                    <?php if ($opcionReloj == 'v' || $opcionReloj == 'h'): ?>
                        <p style="color: #c0392b; font-weight: 600;">Percibiste asimetría en la nitidez de las líneas (eje <?php echo ($opcionReloj == 'v') ? 'vertical' : 'horizontal'; ?>).</p>
                        <p><strong>Recomendación:</strong> Esta diferencia suele relacionarse con la presencia de <strong>astigmatismo</strong>. Te aconsejamos programar un examen con un optómetra u oftalmólogo para una refracción completa.</p>
                    <?php elseif ($opcionReloj == 'i'): ?>
                        <p>Visualizas los radios de la figura con una intensidad y definición uniforme. Esto sugiere una curvatura corneal equilibrada en esta prueba preliminar.</p>
                    <?php else: ?>
                        <p>Selecciona una opción arriba para desplegar la sugerencia del simulador.</p>
                    <?php endif; ?>
                </div>
            </div>

        <!-- TEST 3: DUOCROMO -->
        <?php elseif ($testActivo == 'duocromo'): ?>
            <div class="cartel-distancia">
                <span>📏</span> <span>Distancia sugerida: Ubícate a 1 metro de la pantalla.</span>
            </div>

            <div class="card-test">
                <h3>Test Bicromático (Duocromo)</h3>
                <p>Utiliza longitudes de onda rojas y verdes para analizar el enfoque.</p>

                <div class="caja-visual">
                    <div class="duocromo">
                        <div class="mitad rojo">M U O H</div>
                        <div class="mitad verde">H U M O</div>
                    </div>
                </div>

                <p><strong>¿Qué letras resaltan con mayor contraste o nitidez?</strong></p>
                <div class="btn-items">
                    <a href="simuladores.php?test=duocromo&duocromo=rojo" class="btn-sub" style="background:#ff4d4d; color:white;">Fondo Rojo</a>
                    <a href="simuladores.php?test=duocromo&duocromo=verde" class="btn-sub" style="background:#2ecc71; color:white;">Fondo Verde</a>
                    <a href="simuladores.php?test=duocromo&duocromo=iguales" class="btn-sub">Ambos Iguales</a>
                </div>

                <div class="info" style="border-left-color: <?php echo ($opcionDuocromo == 'iguales' || $opcionDuocromo == '') ? '#2ecc71' : '#d9534f'; ?>;">
                    <h4 style="margin-bottom: 8px;">📋 Sugerencia de Orientación (Sin Diagnóstico Médico):</h4>
                    <?php if ($opcionDuocromo == 'rojo'): ?>
                        <p style="color: #c0392b; font-weight: 600;">Las letras sobre el fondo rojo se perciben más nítidas.</p>
                        <p><strong>Recomendación:</strong> Esto suele indicar una ligera tendencia a la <strong>miopía</strong> o que tu corrección actual puede requerir un leve ajuste. Se sugiere consulta con un profesional óptico.</p>
                    <?php elseif ($opcionDuocromo == 'verde'): ?>
                        <p style="color: #c0392b; font-weight: 600;">Las letras sobre el fondo verde destacan con mayor fuerza.</p>
                        <p><strong>Recomendación:</strong> Esta percepción suele vinculación con una tendencia hacia la <strong>hipermetropía</strong> o hipercorrección. Se aconseja agendar una consulta clínica.</p>
                    <?php elseif ($opcionDuocromo == 'iguales'): ?>
                        <p>Percibes ambos lados con igual nitidez y contraste. Esto sugiere un enfoque neutro y equilibrado para la distancia evaluada.</p>
                    <?php else: ?>
                        <p>Selecciona una opción arriba para desplegar la sugerencia del simulador.</p>
                    <?php endif; ?>
                </div>
            </div>

        <!-- TEST 4: ISHIHARA -->
        <?php elseif ($testActivo == 'ishihara'): ?>
            <div class="cartel-distancia">
                <span>📏</span> <span>Distancia sugerida: Colócate a unos <strong>75 cm</strong> de la pantalla.</span>
            </div>

            <div class="card-test">
                <h3>Test de Ishihara (Percepción del Color)</h3>

                <?php if ($ishiharaActual !== null): ?>
                    <p>Escribe el número percibido en esta placa o presiona el botón si no distingues ninguno.</p>

                    <div class="caja-visual">
                        <img src="Imagenes_Ishihara/<?php echo htmlspecialchars($ishiharaActual['file']); ?>" 
                             alt="Placa Ishihara" 
                             class="img-ishihara" 
                             onerror="this.src='https://via.placeholder.com/180/0056b3/ffffff?text=Placa+Ishihara';">
                    </div>

                    <form method="POST" action="simuladores.php?test=ishihara&ishihara=<?php echo $posIshihara; ?>" class="form-snellen" autocomplete="off">
                        <input type="text" 
                               id="input_ishihara_uno" 
                               name="resp_ishihara_individual" 
                               class="input-letras" 
                               placeholder="Ej: 12" 
                               required 
                               autofocus>

                        <div style="display: flex; gap: 10px; margin-top: 5px;">
                            <button type="submit" class="btn-accion">Enviar Respuesta y Siguiente</button>
                            <button type="button" class="btn-no-ver" onclick="setNingunoAndSubmit()">No veo ningún número</button>
                        </div>
                    </form>

                    <div class="info">
                        <p><strong>Placa actual:</strong> <?php echo ($posIshihara + 1); ?> de <?php echo count($placasIshihara); ?></p>
                    </div>

                    <script>
                    function setNingunoAndSubmit() {
                        const input = document.getElementById('input_ishihara_uno');
                        if (input) {
                            input.value = "Ninguno";
                            input.form.submit();
                        }
                    }
                    </script>

                <?php else: ?>
                    <!-- EVALUACIÓN Y PUNTAJE FINAL DE ISHIHARA -->
                    <?php
                        $aciertosIshihara = 0;
                        $totalIshihara = count($placasIshihara);
                        $respuestasUsuario = $_SESSION['ishihara_respuestas'] ?? [];

                        foreach ($placasIshihara as $index => $item) {
                            $userVal = $respuestasUsuario[$index] ?? '';
                            if (in_array(mb_strtolower($userVal), array_map('mb_strtolower', $item['correct']))) {
                                $aciertosIshihara++;
                            }
                        }
                        $porcentajeIshihara = round(($aciertosIshihara / $totalIshihara) * 100);
                    ?>

                    <div class="caja-visual" style="flex-direction: column; height: auto; padding: 20px;">
                        <h4 style="color: var(--azul); font-size: 1.4rem;">Test de Ishihara Completado</h4>
                        <p style="font-size: 1.1rem; margin-top: 10px;">Puntaje total: <strong><?php echo $aciertosIshihara; ?> / <?php echo $totalIshihara; ?></strong> aciertos (<?php echo $porcentajeIshihara; ?>%).</p>
                    </div>

                    <div class="info" style="border-left-color: <?php echo ($porcentajeIshihara < 75) ? '#d9534f' : '#2ecc71'; ?>;">
                        <h4 style="margin-bottom: 8px;">📋 Sugerencia de Orientación (Sin Diagnóstico Médico):</h4>
                        
                        <?php if ($aciertosIshihara === 22): ?>
                            <p style="color: #27ae60; font-weight: 600;">¡Puntuación perfecta! (22 de 22 aciertos)</p>
                            <p>Tu capacidad de discriminación cromática es óptima. Lograste identificar de forma correcta la totalidad de los números, trazos y placas nulas de la simulación.</p>
                        
                        <?php elseif ($porcentajeIshihara >= 80): ?>
                            <p>Tu capacidad para diferenciar los tonos del espectro cromático se encuentra dentro de los parámetros normales. No se detectan alteraciones significativas en esta simulación.</p>
                        
                        <?php elseif ($porcentajeIshihara >= 55): ?>
                            <p style="color: #e67e22; font-weight: 600;">Se detectaron inconsistencias en la identificación de algunas placas.</p>
                            <p><strong>Sugerencia:</strong> Podría existir una leve deficiencia en la percepción de ciertos tonos (como rojo-verde). Es aconsejable realizar un examen presencial con un optómetra u oftalmólogo.</p>
                        
                        <?php else: ?>
                            <p style="color: #c0392b; font-weight: 600;">Dificultad significativa en la lectura de placas cromáticas.</p>
                            <p><strong>Recomendación:</strong> Te sugerimos agendar una consulta médica especializada para realizar una prueba de Ishihara en condiciones de iluminación profesional estandarizada.</p>
                        <?php endif; ?>
                    </div>

                    <div class="info" style="margin-top: 20px;">
                        <h4>📋 Resumen de Respuestas por Placa:</h4>
                        <div style="overflow-x: auto;">
                            <table class="tabla-resumen">
                                <thead>
                                    <tr>
                                        <th>Placa</th>
                                        <th>Tu Respuesta</th>
                                        <th>Respuesta Correcta</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($placasIshihara as $idx => $placa): 
                                        $userAns = $respuestasUsuario[$idx] ?? 'Sin respuesta';
                                        $esCorrecto = in_array(mb_strtolower($userAns), array_map('mb_strtolower', $placa['correct']));
                                    ?>
                                        <tr>
                                            <td>#<?php echo ($idx + 1); ?></td>
                                            <td><?php echo htmlspecialchars($userAns); ?></td>
                                            <td><?php echo implode(' / ', $placa['correct']); ?></td>
                                            <td class="<?php echo $esCorrecto ? 'res-ok' : 'res-err'; ?>">
                                                <?php echo $esCorrecto ? 'Correcto' : 'Incorrecto'; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <a href="simuladores.php?test=ishihara&reiniciar_ishihara=1" class="btn-accion" style="margin-top: 20px;">Reiniciar Test de Ishihara</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- SCRIPT MANEJO DE MODAL -->
    <script>
        function cerrarModal() {
            document.getElementById('modalAdvertencia').style.display = 'none';
            sessionStorage.setItem('advertencia_aceptada', 'true');
        }

        window.addEventListener('DOMContentLoaded', () => {
            if (sessionStorage.getItem('advertencia_aceptada') === 'true') {
                document.getElementById('modalAdvertencia').style.display = 'none';
            }
        });
    </script>
</body>
</html>
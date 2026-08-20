<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Teoría de Óptica - Hackathon Sabattini</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --azul: #0056b3; --azul-claro: #00a8cc; --fondo: #f4f7f6; --oscuro: #181b24; }
        * { margin:0; padding:0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: var(--fondo); color: #222; }
        
        header { background: var(--oscuro); color: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; }
        .btn-volver { background: var(--azul-claro); color: white; text-decoration: none; padding: 8px 16px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }

        .contenedor { padding: 40px 5%; max-width: 1100px; margin: 0 auto; }
        h2 { color: var(--azul); text-align: center; margin-bottom: 25px; }

        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .card { background: white; padding: 22px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); }
        .borde { border-left: 5px solid var(--azul-claro); }
        .card h3 { color: var(--azul); margin-bottom: 10px; font-size: 1.1rem; }
        .card p { font-size: 0.9rem; color: #444; }
    </style>
</head>
<body>

    <header>
        <h1>Conceptos de Óptica e Instrumental</h1>
        <a href="index.php" class="btn-volver">⬅ Volver al Menú Principal</a>
    </header>

    <div class="contenedor">
        <h2>Ametropías y Evaluaciones Clínicas</h2>

        <div class="grid">
            <div class="card">
                <h3>Miopía</h3>
                <p>Es cuando el ojo es más largo de lo normal o la córnea tiene mucha potencia. La imagen se enfoca antes de la retina, haciendo que veas re borroso de lejos pero bien de cerca. Se corrige con lentes divergentes (negativas)[cite: 4].</p>
            </div>

            <div class="card">
                <h3>Hipermetropía</h3>
                <p>El ojo es más corto de lo habitual y la imagen se forma por detrás de la retina. Los jóvenes suelen disimularlo haciendo esfuerzo con el cristalino (acomodación), lo que causa dolor de cabeza y fatiga visual. Se corrige con lentes convergentes (positivas)[cite: 4].</p>
            </div>

            <div class="card">
                <h3>Astigmatismo</h3>
                <p>Ocurre cuando la córnea no es esférica pareja, sino ovalada. Genera distorsión o bordes dobles en las cosas tanto de cerca como de lejos. Se corrige con lentes cilíndricas[cite: 4].</p>
            </div>

            <div class="card borde">
                <h3>Daltonismo (Test de Ishihara)</h3>
                <p>Es una alteración en la capacidad para distinguir ciertos colores, habitualmente los tonos rojos y verdes. Se evalúa mediante placas pseudoisocromáticas compuestas por puntos de colores donde se ocultan números o caminos específicos.</p>
            </div>

            <div class="card borde">
                <h3>Salud Macular (Test de Amsler)</h3>
                <p>Prueba orientada a examinar la mácula (la parte central de la retina encargada de la visión detallada). Utiliza una cuadrícula con un punto central para detectar anomalías como líneas onduladas, borrosas o áreas con huecos.</p>
            </div>

            <div class="card borde">
                <h3>Tests Pediátricos</h3>
                <p>Con niños pequeños que no saben las letras se usan figuras como LEA Symbols (casitas, manzanas, círculos) o la C de Landolt para medir la visión sin depender de la lectura[cite: 4].</p>
            </div>

            <div class="card borde">
                <h3>Sensibilidad al Contraste</h3>
                <p>Mide qué tan bien distingues matices y sombras suaves, no solo letras negras en fondo blanco. Es clave para manejar de noche o detectar cataratas a tiempo[cite: 4].</p>
            </div>

            <div class="card borde">
                <h3>Cover Test</h3>
                <p>El profesional tapa y destapa un ojo para ver si se desvía. Sirve para detectar estrabismo (tropías) o esfuerzo muscular para mantener los ojos alineados (forias)[cite: 4].</p>
            </div>
        </div>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador Educativo de Tests Visuales - Sabattini</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --azul-principal: #0056b3;
            --azul-claro: #00a8cc;
            --fondo-oscuro: #181b24;
            --fondo-cuerpo: #f4f7f6;
            --texto-principal: #222222;
            --amarillo-alerta: #fff3cd;
            --texto-alerta: #856404;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--fondo-cuerpo); color: var(--texto-principal); line-height: 1.6; }

        header {
            background-color: var(--fondo-oscuro);
            color: white;
            padding: 1.2rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 { font-size: 1.3rem; }
        header h1 span { color: var(--azul-claro); font-size: 0.9rem; font-weight: 400; }

        .hero {
            background: linear-gradient(135deg, #0056b3, #001f3f);
            color: white;
            padding: 60px 5%;
            text-align: center;
        }

        .hero h2 { font-size: 2.2rem; margin-bottom: 10px; }
        .hero p { font-size: 1.1rem; max-width: 800px; margin: 0 auto 20px auto; }

        .cartel-aviso {
            background-color: var(--amarillo-alerta);
            border-bottom: 2px solid #ffeeba;
            color: var(--texto-alerta);
            padding: 12px 5%;
            text-align: center;
            font-size: 0.9rem;
        }

        /* MENÚ DE BOTONES PRINCIPALES */
        .seccion-botones {
            padding: 50px 5%;
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
        }

        .grid-botones {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .btn-seccion {
            background: white;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            text-decoration: none;
            color: var(--texto-principal);
            border-top: 5px solid var(--azul-principal);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .btn-seccion:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .btn-seccion h3 { color: var(--azul-principal); margin-bottom: 10px; font-size: 1.3rem; }
        .btn-seccion p { font-size: 0.9rem; color: #666; }

        footer { background-color: var(--fondo-oscuro); color: white; text-align: center; padding: 18px; font-size: 0.85rem; margin-top: 50px; }
    </style>
</head>
<body>

    <header>
        <h1>VisioTech <span>| Hackathon Sabattini</span></h1>
    </header>

    <section class="hero">
        <h2>Simulador Educativo de Tests Visuales</h2>
        <p>Un proyecto interactivo desarrollado por estudiantes de <strong>Programación</strong> y <strong>Óptica e Instrumental</strong> para la concientización sobre la salud ocular.</p>
    </section>

    <div class="cartel-aviso">
        <p>⚠️ <strong>Aviso Importante:</strong> Esta página es exclusivamente educativa y demostrativa. No reemplaza un examen profesional ni emite diagnósticos médicos.</p>
    </div>

    <section class="seccion-botones">
        <h2>Elegí una sección para presentar:</h2>
        
        <div class="grid-botones">
            <a href="simuladores.php" class="btn-seccion">
                <h3>🎮 Simuladores</h3>
                <p>Probar los tests de Snellen, Amsler, Ishihara y Círculo Horario en vivo.</p>
            </a>

            <a href="teoria.php" class="btn-seccion">
                <h3>📚 Teoría de Óptica</h3>
                <p>Aprender sobre Miopía, Hipermetropía, Astigmatismo y tests clínicos.</p>
            </a>

            <a href="equipo.php" class="btn-seccion">
                <h3>👥 El Equipo</h3>
                <p>Ver los integrantes y la división de tareas interdisciplinaria.</p>
            </a>
        </div>
    </section>

    <footer>
        <p>&copy; 2026 Hackathon Institucional Sabattini - Proyecto Integrador de Óptica y Programación.</p>
    </footer>

</body>
</html>
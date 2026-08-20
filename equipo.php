<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Equipo de Trabajo - Hackathon Sabattini</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --azul: #0056b3; --azul-claro: #00a8cc; --fondo: #f4f7f6; --oscuro: #181b24; }
        * { margin:0; padding:0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: var(--fondo); color: #222; }
        
        header { background: var(--oscuro); color: white; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; }
        .btn-volver { background: var(--azul-claro); color: white; text-decoration: none; padding: 8px 16px; border-radius: 20px; font-weight: 600; font-size: 0.85rem; }

        .contenedor { padding: 40px 5%; max-width: 1000px; margin: 0 auto; }
        h2 { color: var(--azul); text-align: center; margin-bottom: 25px; }

        .tabla { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .tabla th, .tabla td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; font-size: 0.9rem; }
        .tabla th { background: var(--azul); color: white; }

        .badge { padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 600; }
        .prog { background: #d1ecf1; color: #0c5460; }
        .opt { background: #d4edda; color: #155724; }
    </style>
</head>
<body>

    <header>
        <h1>Equipo Interdisciplinario</h1>
        <a href="index.php" class="btn-volver">⬅ Volver al Menú Principal</a>
    </header>

    <div class="contenedor">
        <h2>Integrantes y Roles del Proyecto</h2>

        <div style="overflow-x: auto;">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre y Apellido</th>
                        <th>Especialidad</th>
                        <th>Aporte en el Proyecto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Lisandro Tabares</td>
                        <td><span class="badge prog">Programación</span></td>
                        <td>Desarrollo Backend PHP, sistema modular e interactividad.</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Elias Uriel Cortez</td>
                        <td><span class="badge prog">Programación</span></td>
                        <td>Maquetación CSS, interfaz adaptable a pantallas y TV.</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Perez Santiago Nicolas</td>
                        <td><span class="badge opt">Óptica e Instrumental</span></td>
                        <td>Elaboración del archivo para la presentación en Canva y explicación del primer test (Snellen).</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Pereyra Santino Ivo</td>
                        <td><span class="badge opt">Óptica e Instrumental</span></td>
                        <td>Investigación y aportes de información para los tests y explicación del test de Ishihara.</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Paz Estefano Alejo</td>
                        <td><span class="badge opt">Óptica e Instrumental</span></td>
                        <td>Explicación del test del reloj de astigmatismo.</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Lamas Andres Juan</td>
                        <td><span class="badge opt">Óptica e Instrumental</span></td>
                        <td>Explicación del test bicromático (Duocromo).</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
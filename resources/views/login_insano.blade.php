<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Veterinaria</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1a2e 50%, #16213e 100%);
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Partículas animadas de fondo */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(74, 144, 226, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(138, 43, 226, 0.08) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.05); }
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                repeating-linear-gradient(
                    0deg,
                    rgba(0, 0, 0, 0.1) 0px,
                    transparent 1px,
                    transparent 2px,
                    rgba(0, 0, 0, 0.1) 3px
                );
            pointer-events: none;
            opacity: 0.03;
            z-index: 1;
        }

        .header {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: rgba(10, 14, 39, 0.7);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(120, 119, 198, 0.2);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 1px;
            text-shadow: 0 0 30px rgba(102, 126, 234, 0.5);
            animation: glow 3s ease-in-out infinite;
        }

        @keyframes glow {
            0%, 100% { filter: drop-shadow(0 0 5px rgba(102, 126, 234, 0.5)); }
            50% { filter: drop-shadow(0 0 20px rgba(118, 75, 162, 0.8)); }
        }

        .nav {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: #b8b9cc;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            width: 100%;
        }

        .hero {
            position: relative;
            z-index: 5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 200px);
            padding: 2rem 5%;
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content h2 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            color: #fff;
            text-shadow: 0 0 40px rgba(102, 126, 234, 0.3);
        }

        .hero-content h2 span {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
            margin-top: 0.5rem;
            animation: shimmer 3s ease-in-out infinite;
            background-size: 200% auto;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 0% center; }
            50% { background-position: 100% center; }
        }

        .hero-content p {
            font-size: 1.25rem;
            color: #b8b9cc;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn.login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            border: 2px solid transparent;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .btn.login:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
        }

        .btn.register {
            background: transparent;
            color: #fff;
            border: 2px solid #667eea;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }

        .btn.register:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
        }

        .footer {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 2rem 5%;
            background: rgba(10, 14, 39, 0.5);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(120, 119, 198, 0.1);
            color: #7c7d96;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 5%;
            }

            .nav {
                gap: 1rem;
            }

            .hero-content h2 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                width: 100%;
            }
        }

        /* Efectos adicionales de partículas */
        .hero::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: pulse 4s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.1; }
        }
    </style>
</head>
<body>
    <div class="overlay"></div>

    <header class="header">
        <h1 class="logo">LOS MAS INSANOS</h1>
        <nav class="nav">
            <a href="#inicio" class="nav-link active">KEVIN</a>
            <a href="#nosotros" class="nav-link">CITLALI</a>
            <a href="#contacto" class="nav-link">JONYBOY</a>
            <a href="#contacto" class="nav-link">EL VALE</a>
        </nav>
    </header>

    <main class="hero">
        <div class="hero-content">
            <h2>Bienvenido al <span>LOS MAS PENUDOS</span></h2>
            <p>Administra tus pacientes, servicios y reportes de manera rápida, profesional y segura.</p>
            <div class="buttons">
                <a href="login.html" class="btn login">Iniciar sesión</a>
                <a href="register.html" class="btn register">Registrarse</a>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 Patitas Felices VET — Todos los derechos reservados.</p>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Gestión Docente</title>
    <link rel="stylesheet" href="/gestion-docentes-web/public/css/style.css">
    <style>
        .login-body {
            min-height: 100vh;
            display: flex;
            background: var(--bg-dark);
            font-family: var(--font-main);
            position: relative;
            overflow: hidden;
        }

        /* Panel izquierdo decorativo */
        .login-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 4rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99,102,241,0.3) 0%, transparent 70%);
            border-radius: 50%;
        }

        .login-left::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(16,185,129,0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .login-brand {
            position: relative;
            z-index: 1;
        }

        .login-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 3rem;
        }

        .login-logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--c-primary-main), #818cf8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-logo span {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .login-headline {
            font-size: 2.8rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 1.25rem;
        }

        .login-headline span {
            background: linear-gradient(135deg, #818cf8, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-description {
            color: rgba(255,255,255,0.6);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 380px;
            margin-bottom: 3rem;
        }

        .login-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255,255,255,0.75);
            font-size: 0.9rem;
        }

        .feature-dot {
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #818cf8, #34d399);
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Panel derecho: formulario */
        .login-right {
            width: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 3.5rem;
            background: #fff;
            position: relative;
        }

        .login-form-container {
            width: 100%;
            max-width: 380px;
        }

        .login-form-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.03em;
            margin-bottom: 0.5rem;
        }

        .login-form-subtitle {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin-bottom: 2.5rem;
        }

        .login-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #DC2626;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: none;
        }

        .login-error.visible {
            display: block;
        }

        .login-form .form-group {
            margin-bottom: 1.25rem;
        }

        .login-form label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
        }

        .login-form .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1.5px solid #E5E7EB;
            border-radius: 10px;
            font-size: 0.95rem;
            color: var(--text-dark);
            background: #FAFAFA;
            transition: all 0.2s;
            box-sizing: border-box;
            outline: none;
        }

        .login-form .form-input:focus {
            border-color: var(--c-primary-main);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99,102,241,0.08);
        }

        .btn-login {
            width: 100%;
            padding: 0.95rem;
            background: linear-gradient(135deg, var(--c-primary-main) 0%, #818cf8 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 0.75rem;
            letter-spacing: 0.01em;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(99,102,241,0.35);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-gray);
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .login-left { display: none; }
            .login-right { width: 100%; padding: 2rem; }
        }
    </style>
</head>
<body class="login-body">

    <!-- Panel izquierdo -->
    <div class="login-left">
        <div class="login-brand">
            <div class="login-logo">
                <div class="login-logo-icon">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                </div>
                <span>GestiónDocente</span>
            </div>

            <h1 class="login-headline">
                Gestiona tu <span>actividad docente</span> con facilidad.
            </h1>

            <p class="login-description">
                Plataforma centralizada para el control de actividades, asistencias, asignaturas y más. Todo en un solo lugar.
            </p>

            <div class="login-features">
                <div class="feature-item"><div class="feature-dot"></div>Control de actividades y calificaciones</div>
                <div class="feature-item"><div class="feature-dot"></div>Gestión de asistencias en tiempo real</div>
                <div class="feature-item"><div class="feature-dot"></div>Administración de cursos y asignaturas</div>
                <div class="feature-item"><div class="feature-dot"></div>Perfiles de docentes integrados</div>
            </div>
        </div>
    </div>

    <!-- Panel derecho: Formulario -->
    <div class="login-right">
        <div class="login-form-container">
            <h2 class="login-form-title">Bienvenido</h2>
            <p class="login-form-subtitle">Ingresa tus credenciales para continuar.</p>

            <div id="alertaError" class="login-error">
                Credenciales incorrectas. Intente nuevamente.
            </div>

            <form id="formLogin" class="login-form" action="/gestion-docentes-web/auth?accion=login" method="POST">
                <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="text" class="form-input" id="cedula" required placeholder="Ej: 0912345678" autocomplete="username" name="cedula">
                </div>
                <div class="form-group">
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-input" id="clave" required placeholder="Ej: 123" autocomplete="current-password" name="clave">
                </div>
                <button type="submit" class="btn-login">Ingresar al Sistema</button>
            </form>

            <p class="login-footer">&copy; 2026 Sistema de Gestión Docente</p>
        </div>
    </div>

    <!-- <script src="../../public/js/login/dataMock.js"></script>
    <script src="../../public/js/login/login.js"></script> -->
</body>
</html>

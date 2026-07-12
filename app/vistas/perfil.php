<?php

$menu = [
    "ruta" => "inicio",
    "nombre" => "Inicio"
];

require_once __DIR__."/layout/curso/header.php";

$usuario = $_SESSION["usuario"] ?? ["nombre" => "Usuario", "cedula" => "No definida", "rol" => "Sin Rol", "correo" => "", "telefono" => ""];

?>

<div class="dot-pattern top-left"></div>
<div class="dot-pattern bottom-right"></div>

<main class="main-container">
    <header class="main-header">
        <div class="header-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" /><circle cx="12" cy="7" r="4" /></svg>
        </div>
        <h1>Mi Perfil</h1>
        <div class="divider"></div>
        <p>Actualiza la información personal de tu cuenta.</p>
    </header>

    <?php if (isset($mensaje)): ?>
        <div style="background: #D1FAE5; color: #065F46; padding: 1rem; border-radius: 0.5rem; text-align: center; font-weight: 500; max-width: 600px; margin: 1rem auto; border: 1px solid #10B981;">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div style="background: #FEE2E2; color: #991B1B; padding: 1rem; border-radius: 0.5rem; text-align: center; font-weight: 500; max-width: 600px; margin: 1rem auto; border: 1px solid #EF4444;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/gestion-docentes-web/perfil/actualizar" style="max-width: 1000px; margin: 0 auto 3rem auto; position: relative; top: -1.5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; align-items: start;">
        
        <!-- Tarjeta Izquierda: Información General -->
        <div style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);">
            <div style="margin-bottom: 2rem;">
                <h3 style="margin-top: 0; color: #111827; font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Información General</h3>
                <p style="color: #6B7280; font-size: 0.95rem; margin: 0; border-bottom: 1px solid #E5E7EB; padding-bottom: 1rem;">Actualiza tus datos personales y de contacto.</p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.875rem; color: #4B5563; font-weight: 600; margin-bottom: 0.5rem;">Cédula <span style="color: #9CA3AF; font-weight: 400;">(No editable)</span></label>
                <input type="text" value="<?php echo htmlspecialchars($usuario["cedula"] ?? ""); ?>" readonly style="width: 100%; padding: 0.875rem; border: 1px solid #E5E7EB; border-radius: 0.5rem; background: #F9FAFB; color: #6B7280; box-sizing: border-box; font-family: inherit; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.875rem; color: #4B5563; font-weight: 600; margin-bottom: 0.5rem;">Rol Asignado <span style="color: #9CA3AF; font-weight: 400;">(No editable)</span></label>
                <input type="text" value="<?php echo htmlspecialchars($usuario["rol"] ?? ""); ?>" readonly style="width: 100%; padding: 0.875rem; border: 1px solid #E5E7EB; border-radius: 0.5rem; background: #F9FAFB; color: #6B7280; text-transform: capitalize; box-sizing: border-box; font-family: inherit; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.875rem; color: #4B5563; font-weight: 600; margin-bottom: 0.5rem;">Nombre Completo</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario["nombre"] ?? ""); ?>" placeholder="Ej: Juan Pérez" style="width: 100%; padding: 0.875rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; box-sizing: border-box; font-family: inherit; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.875rem; color: #4B5563; font-weight: 600; margin-bottom: 0.5rem;">Correo Electrónico</label>
                <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario["correo"] ?? ""); ?>" placeholder="Ej: correo@ejemplo.com" style="width: 100%; padding: 0.875rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; box-sizing: border-box; font-family: inherit; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
            </div>

            <div style="margin-bottom: 2.5rem;">
                <label style="display: block; font-size: 0.875rem; color: #4B5563; font-weight: 600; margin-bottom: 0.5rem;">Teléfono de Contacto</label>
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario["telefono"] ?? ""); ?>" placeholder="Ej: 0987654321" style="width: 100%; padding: 0.875rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; box-sizing: border-box; font-family: inherit; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
            </div>

            <div style="display: flex; justify-content: center;">
                <button type="submit" style="background: #4F46E5; color: white; border: none; padding: 0.875rem 3rem; font-size: 1rem; font-weight: 600; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3);" onmouseover="this.style.backgroundColor='#4338CA'; this.style.transform='translateY(-1px)';" onmouseout="this.style.backgroundColor='#4F46E5'; this.style.transform='translateY(0)';">
                    Guardar Cambios
                </button>
            </div>
        </div>

        <!-- Tarjeta Derecha: Seguridad -->
        <div style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);">
            <div style="margin-bottom: 2rem;">
                <h3 style="margin-top: 0; color: #111827; font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem;">Seguridad</h3>
                <p style="color: #6B7280; font-size: 0.95rem; margin: 0; border-bottom: 1px solid #E5E7EB; padding-bottom: 1rem;">Modifica tu contraseña para mantener tu cuenta segura.</p>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.875rem; color: #4B5563; font-weight: 600; margin-bottom: 0.5rem;">Nueva Contraseña <span style="color: #9CA3AF; font-weight: 400;">(Opcional)</span></label>
                <input type="password" name="clave_nueva" placeholder="Ingresa la nueva contraseña" style="width: 100%; padding: 0.875rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; box-sizing: border-box; font-family: inherit; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-size: 0.875rem; color: #4B5563; font-weight: 600; margin-bottom: 0.5rem;">Confirmar Contraseña</label>
                <input type="password" name="clave_confirmar" placeholder="Repetir nueva contraseña" style="width: 100%; padding: 0.875rem; border: 1px solid #D1D5DB; border-radius: 0.5rem; box-sizing: border-box; font-family: inherit; font-size: 1rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3B82F6'" onblur="this.style.borderColor='#D1D5DB'">
            </div>
        </div>

    </form>
</main>

<?php require_once __DIR__."/layout/curso/footer.php" ?>

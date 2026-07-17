$basePath = "c:\xampp\htdocs\gestion-docentes-web\app\vistas"

$files = Get-ChildItem -Path $basePath -Recurse -Include *.php, *.html

foreach ($file in $files) {
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8

    $original = $content

    # Fix Encoding
    $content = $content -replace "Ã³", "ó"
    $content = $content -replace "Ã©", "é"
    $content = $content -replace "Ã¡", "á"
    $content = $content -replace "Ã±", "ñ"
    $content = $content -replace "Ã­", "í"
    $content = $content -replace "Ã", "í" # Fallback if any is left, though dangerous. Let's not do the raw Ã.
    
    # Wait, let me replace specifically for the ones with hidden characters like Ã (followed by soft hyphen or similar).
    # Actually, PowerShell `-replace` works well.
    # $content = $content -replace "CÃ³digo", "Código"
    
    # Fix Links
    $content = $content -replace "\.\./login/login\.php", "/gestion-docentes-web/auth?accion=logout"
    $content = $content -replace "\./index\.html", "/gestion-docentes-web/auth?accion=logout"
    $content = $content -replace "\.\./actividad-docente/perfil\.html", "/gestion-docentes-web/actividades-docente?accion=perfil"
    $content = $content -replace "\.\./\.\./auth\?accion=logout", "/gestion-docentes-web/auth?accion=logout"
    
    if ($original -ne $content) {
        Set-Content -Path $file.FullName -Value $content -Encoding UTF8
        Write-Host "Updated $($file.FullName)"
    }
}

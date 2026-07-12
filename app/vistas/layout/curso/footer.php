    <!-- Footer -->
    <footer class="footer mt-auto">
        <p>&copy; 2026 Sistema de Gestión Docente. Todos los derechos reservados.</p>
    </footer>

    <?php #if(strcmp($_SESSION["usuario"]["rol"], "administrador") == 0) echo "Hola admin uwu"; ?>

</body>
</html>

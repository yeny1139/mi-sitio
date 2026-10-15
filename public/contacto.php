<?php
$titulo = 'Contacto';
require __DIR__ . '/../includes/header.php';

// Recuperar errores y datos previos (se muestran una sola vez)
$errores =$_SESSION['errores'] ?? [];
$viejo   =$_SESSION['viejo'] ?? [];
unset($_SESSION['errores'],$_SESSION['viejo']);
?>
<h1>Contacto</h1>

<?php if ($errores): ?>
    <ul class="errores">
        <?php foreach ($errores as$error): ?>
            <li><?= e($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form id="form-contacto" action="procesar.php" method="post" novalidate>
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" maxlength="100"
           value="<?= e($viejo['nombre'] ?? '') ?>" required>

    <label for="asunto">Asunto</label>
    <input type="text" id="asunto" name="asunto" maxlength="150"
           value="<?= e($viejo['asunto'] ?? '') ?>" required>

    <label for="email">Correo electrónico</label>
    <input type="email" id="email" name="email" maxlength="150"
           value="<?= e($viejo['email'] ?? '') ?>" required>

    <label for="mensaje">Mensaje</label>
    <textarea id="mensaje" name="mensaje" rows="5"
              required><?= e($viejo['mensaje'] ?? '') ?></textarea>
    <small id="contador-mensaje">0 / 2000 caracteres</small>

    <button type="submit" id="btn-enviar">Enviar</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Contador de caracteres dinámico (Reto 2)
    const textarea = document.getElementById('mensaje');
    const contador = document.getElementById('contador-mensaje');
    const max = 2000;

    function actualizarContador() {
        const largo = textarea.value.length;
        contador.textContent = `${largo} / ${max} caracteres`;
        
        if (largo > max) {
            contador.style.color = 'red';
        } else {
            contador.style.color = '#666';
        }
    }

    textarea.addEventListener('input', actualizarContador);
    actualizarContador();

    // 2. Prevención de doble envío (Reto 3)
    const form = document.getElementById('form-contacto');
    const btn = document.getElementById('btn-enviar');

    form.addEventListener('submit', () => {
        btn.disabled = true;
        btn.textContent = 'Enviando...';
    });
});
</script>

<?php require __DIR__ . '/../includes/footer.php'; ?>
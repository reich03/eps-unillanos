<?php require_once 'views/components/header.php'; ?>
<h2 class="text-2xl font-bold mb-4">Registrar Servicio</h2>

<form action="/servicio/store" method="POST" class="bg-white p-6 shadow rounded space-y-4">
    <input type="text" name="desc_serv" placeholder="Descripción del Servicio" class="border p-2 w-full" required>
    <input type="number" name="costo_serv" step="0.01" placeholder="Costo del Servicio" class="border p-2 w-full" required>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar Servicio</button>
</form>

<?php require_once 'views/components/footer.php'; ?>

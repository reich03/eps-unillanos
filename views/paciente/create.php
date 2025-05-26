<?php require_once 'views/components/header.php'; ?>

<h2 class="text-2xl font-bold mb-4">Registrar Nuevo Paciente</h2>

<form action="/paciente/store" method="POST" class="bg-white p-6 shadow rounded space-y-4">
    <input type="text" name="nom_pac" placeholder="Nombre" class="border p-2 w-full" required>
    <input type="text" name="ape_pac" placeholder="Apellido" class="border p-2 w-full" required>
    <input type="text" name="dni_pac" placeholder="Documento de Identidad" class="border p-2 w-full" required>
    <input type="date" name="fec_pac" class="border p-2 w-full" required>
    <select name="est_pac" class="border p-2 w-full">
        <option value="activo" selected>Activo</option>
        <option value="inactivo">Inactivo</option>
    </select>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar Paciente</button>
</form>

<?php require_once 'views/components/footer.php'; ?>

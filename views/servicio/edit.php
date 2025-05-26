<?php require_once 'views/components/header.php'; ?>
<h2 class="text-2xl font-bold mb-4">Editar Servicio</h2>

<form action="/servicio/update" method="POST" class="bg-white p-6 shadow rounded space-y-4">
    <input type="hidden" name="id_serv" value="<?= $this->d['servicio']['id_serv'] ?>">

    <input type="text" name="desc_serv" value="<?= $this->d['servicio']['desc_serv'] ?>" class="border p-2 w-full" required>
    <input type="number" name="costo_serv" step="0.01" value="<?= $this->d['servicio']['costo_serv'] ?>" class="border p-2 w-full" required>

    <select name="est_serv" class="border p-2 w-full">
        <option value="activo" <?= $this->d['servicio']['est_serv'] == 'activo' ? 'selected' : '' ?>>Activo</option>
        <option value="inactivo" <?= $this->d['servicio']['est_serv'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
    </select>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
</form>

<?php require_once 'views/components/footer.php'; ?>

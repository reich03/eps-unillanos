<?php require_once 'views/components/header.php'; ?>

<h2 class="text-2xl font-bold mb-4">Servicios Registrados</h2>
<a href="/servicio/create" class="bg-green-500 text-white px-4 py-2 rounded">➕ Nuevo Servicio</a>

<table class="table-auto w-full mt-6 bg-white shadow">
    <thead>
        <tr>
            <th class="px-4 py-2">Descripción</th>
            <th class="px-4 py-2">Costo</th>
            <th class="px-4 py-2">Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->d as $s): ?>
            <tr class="border-t">
                <td class="px-4 py-2"><?= $s['desc_serv'] ?></td>
                <td class="px-4 py-2">$<?= number_format($s['costo_serv'], 2) ?></td>
                <td class="px-4 py-2"><?= $s['est_serv'] ?></td>
                <td class="px-4 py-2">
                    <a href="/servicio/edit/<?= $s['id_serv'] ?>" class="text-blue-500">✏️</a>
                    <a href="/servicio/delete/<?= $s['id_serv'] ?>" class="text-red-500 ml-2" onclick="return confirm('¿Eliminar servicio?')">🗑️</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'views/components/footer.php'; ?>
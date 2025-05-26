<?php require_once 'views/components/header.php'; ?>

<h2 class="text-2xl font-bold mb-4">Pacientes Registrados</h2>
<a href="/paciente/create" class="bg-green-500 text-white px-4 py-2 rounded">➕ Nuevo Paciente</a>

<table class="table-auto w-full mt-6 bg-white shadow">
<thead>
    <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Nombre</th>
        <th class="px-4 py-2">Apellido</th>
        <th class="px-4 py-2">DNI</th>
        <th class="px-4 py-2">Fecha Nacimiento</th>
        <th class="px-4 py-2">Estado</th>
        <th class="px-4 py-2">Acciones</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($this->d as $p): ?>
    <tr class="border-t">
        <td class="px-4 py-2"><?= $p['id_pac'] ?></td>
        <td class="px-4 py-2"><?= $p['nom_pac'] ?></td>
        <td class="px-4 py-2"><?= $p['ape_pac'] ?></td>
        <td class="px-4 py-2"><?= $p['dni_pac'] ?></td>
        <td class="px-4 py-2"><?= $p['fec_pac'] ?></td>
        <td class="px-4 py-2"><?= $p['est_pac'] ?></td>
        <td class="px-4 py-2">
            <a href="/paciente/edit/<?= $p['id_pac'] ?>" class="text-blue-500">✏️</a>
            <a href="/paciente/delete/<?= $p['id_pac'] ?>" class="text-red-500 ml-2" onclick="return confirm('¿Eliminar paciente?')">🗑️</a>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>

<?php require_once 'views/components/footer.php'; ?>

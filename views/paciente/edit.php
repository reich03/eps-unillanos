<?php require_once 'views/components/header.php'; ?>

<h2 class="text-2xl font-bold mb-4">Editar Paciente</h2>

<form action="/paciente/update" method="POST" class="bg-white p-6 shadow rounded space-y-4">
    <input type="hidden" name="id_pac" value="<?= $this->d['paciente']['id_pac'] ?>">
    <input type="text" name="nom_pac" value="<?= $this->d['paciente']['nom_pac'] ?>" class="border p-2 w-full" required>
    <input type="text" name="ape_pac" value="<?= $this->d['paciente']['ape_pac'] ?>" class="border p-2 w-full" required>
    <input type="text" name="dni_pac" value="<?= $this->d['paciente']['dni_pac'] ?>" class="border p-2 w-full" required>
    <input type="date" name="fec_pac" value="<?= $this->d['paciente']['fec_pac'] ?>" class="border p-2 w-full" required>
    <select name="est_pac" class="border p-2 w-full">
        <option value="activo" <?= $this->d['paciente']['est_pac'] == 'activo' ? 'selected' : '' ?>>Activo</option>
        <option value="inactivo" <?= $this->d['paciente']['est_pac'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
    </select>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar Paciente</button>
</form>

<?php require_once 'views/components/footer.php'; ?>

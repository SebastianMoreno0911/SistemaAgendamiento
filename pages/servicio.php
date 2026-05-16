<?php require_once __DIR__ . '/../config/conexionDB.php'; ?>
<!--no se si se necesite la inclusion de la base de datos pero la dejo por si la necesito -->

<?php 
$mostrarNavbar = true;
include(__DIR__ . "/../layout/header.php");

$cardServicio = "group block rounded-2xl border border-red-100 bg-white p-5 text-left shadow-lg shadow-neutral-slate/10 transition hover:-translate-y-1 hover:border-primary-red hover:shadow-xl hover:shadow-neutral-slate/15";

$cardServicioEmpresa = "group block rounded-2xl border border-blue-100 bg-terciario-gray p-5 text-left shadow-lg shadow-blue-100/60 transition hover:-translate-y-1 hover:border-secundary-blue hover:shadow-xl hover:shadow-blue-100 hover:bg-terciario-gray_hover";

$sql = "SELECT id_tramite, nombre_tramite FROM tramites ORDER BY nombre_tramite";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$tramites = $stmt->fetchAll(PDO::FETCH_ASSOC);

$id_tramite = $_GET['id_tramite'] ?? null;
$id_region = $_GET['id_region'] ?? null;
$id_ciudad = $_GET['id_ciudad'] ?? null;
$id_oficina = $_GET['id_oficina'] ?? null;
$fecha_cita = $_GET['fecha_cita'] ?? null;
?>

<?php if ($id_tramite): ?>
<!-- mostrar regionales -->
<?php endif; ?>

<!-- aqui solo son tarjetas para seleccionar  -->


<main class="flex-1 py-10">
    <div class=" text-center">
        <h1 class="text-3xl font-black leading-tight text-slate-950 sm:text-5x1">Selecciona el servicio necesario
        </h1>
        <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-600">
            Elige el tipo de atencion que necesitas para continuar con tu agendamiento.
        </p>
    </div>

    <section class="mx-auto  max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-2 mb-10">
            <?php foreach ($tramites as $tramite): ?>
            <a href="oficina.php?id_tramite=<?php echo $tramite['id_tramite']; ?>" class="<?php echo $cardServicio; ?>">
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-primary-red">
                    servicio
                </p>

                <h2 class="mt-3 text-xl font-black text-slate-950">
                    <?php echo $tramite['nombre_tramite']; ?>
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-600">
                    Selecciona este servicio para continuar con el agendamiento.
                </p>
            </a>

            <?php endforeach; ?>
        </div>

        <div class="mt-10 text-center">
            <a href="../index.php"
                class="inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-6 py-4 text-base font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200 sm:w-auto">
                Cancelar / Volver
            </a>
        </div>
    </section>

</main>

<?php include(__DIR__ . "/../layout/footer.php") ?>

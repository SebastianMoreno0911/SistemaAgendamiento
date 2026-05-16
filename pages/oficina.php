<!-- flujo de esta pantalla servicio - departamento - ciudad - oficina - fecha - hora - agendado ok -->

<?php
require_once __DIR__ . '/../config/conexionDB.php';

// Datos que llegan por URL para saber en que paso va el agendamiento.
$id_tramite = $_GET['id_tramite'] ?? null;
$id_region = $_GET['id_region'] ?? null;
$id_ciudad = $_GET['id_ciudad'] ?? null;
$id_oficina = $_GET['id_oficina'] ?? null;
$fecha_cita = $_GET['fecha_cita'] ?? null;


// Validacion inicial: sin tramite no hay flujo de agendamiento.
if (!$id_tramite) {
    header("Location: servicio.php");
    exit;
}

// Variables que controlan el paso actual y lo que se muestra en pantalla.
$opciones = [];
$tipoPaso = "";
$tituloPaso = "";
$descripcionPaso = "";
$horasDisponibles = [];

// Asistente de pasos: decide si se muestran regiones, ciudades, oficinas, fecha u horas.
if (!$id_region) {
    $tituloPaso = "Selecciona tu departamento";
    $descripcionPaso = "Elige la zona donde quieres realizar el agendamiento.";
    $tipoPaso = "region";

    $sql = "SELECT id_region, nombre_region
            FROM regionales
            ORDER BY nombre_region";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $opciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif (!$id_ciudad) {
    $tituloPaso = "Selecciona tu ciudad";
    $descripcionPaso = "Escoge la ciudad donde quieres realizar tu cita.";
    $tipoPaso = "ciudad";

    $sql = "SELECT id_ciudad, nombre_ciudad
            FROM ciudades
            WHERE id_region = :id_region
            ORDER BY nombre_ciudad";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':id_region' => $id_region
    ]);

    $opciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif (!$id_oficina) {
    $tituloPaso = "Selecciona la oficina";
    $descripcionPaso = "Elige la oficina donde quieres ser atendido.";
    $tipoPaso = "oficina";

    $sql = "SELECT id_oficina, nombre_oficina, direccion_oficina
            FROM oficinas
            WHERE id_ciudad = :id_ciudad
            ORDER BY nombre_oficina";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':id_ciudad' => $id_ciudad
    ]);

    $opciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

} elseif (!$fecha_cita) {

    $tituloPaso = "Selecciona la fecha";
    $descripcionPaso = "Elige el dia en que quieres agendar tu cita.";
    $tipoPaso = "fecha";
} else {
    $tituloPaso = "Selecciona la hora";
    $descripcionPaso = "Elige un horario disponible para tu cita.";    
    $tipoPaso = "hora"; 

    $horasPermitidas = ['08:00:00','09:00:00','10:00:00','11:00:00','12:00:00','13:00:00','14:00:00','15:00:00'];

    $sql = "  SELECT hora_cita
                        FROM citas
                        WHERE id_oficina = :id_oficina
                        AND fecha_cita = :fecha_cita";
    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ':id_oficina' => $id_oficina,
        ':fecha_cita' => $fecha_cita
    ]);

    $horasOcupadas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    $horasDisponibles = array_diff($horasPermitidas, $horasOcupadas);

}

// Boton volver inteligente: retrocede solo un paso y conserva lo ya seleccionado.
$urlVolver = "";
$textoVolver = "Volver";

if ($tipoPaso === "region") {
    $urlVolver = "servicio.php";
    $textoVolver = "Volver a servicios";
} elseif ($tipoPaso === "ciudad") {
    $urlVolver = "oficina.php?id_tramite=$id_tramite";
    $textoVolver = "Volver a departamentos";
} elseif ($tipoPaso === "oficina") {
    $urlVolver = "oficina.php?id_tramite=$id_tramite&id_region=$id_region";
    $textoVolver = "Volver a ciudades";
} elseif ($tipoPaso === "fecha") {
    $urlVolver = "oficina.php?id_tramite=$id_tramite&id_region=$id_region&id_ciudad=$id_ciudad";
    $textoVolver = "Volver a oficinas";
} elseif ($tipoPaso === "hora") {
    $urlVolver = "oficina.php?id_tramite=$id_tramite&id_region=$id_region&id_ciudad=$id_ciudad&id_oficina=$id_oficina";
    $textoVolver = "Volver a fecha";
}

$mostrarNavbar = true;
include(__DIR__ . "/../layout/header.php");

// Clases reutilizables para mantener las tarjetas con la misma estetica.
$cardOpcion = "group block rounded-2xl border border-red-100 bg-white p-5 text-left shadow-lg shadow-neutral-slate/10 transition hover:-translate-y-1 hover:border-primary-red hover:shadow-xl hover:shadow-neutral-slate/15 focus:outline-none focus:ring-4 focus:ring-red-100";
?>
<main class="flex-1 py-10">
    <section class="mx-auto max-w-6xl px-4 py-12 sm:px-6 lg:px-8">
        <!-- Titulo dinamico del paso actual. -->
        <div class="mb-10 text-center">

            <h1 class="text-3xl font-black leading-tight text-slate-950 sm:text-5xl">
                <?php echo $tituloPaso; ?>
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-600">
                <?php echo $descripcionPaso; ?>
            </p>

        </div>

        <!-- Tarjetas para seleccionar departamento, ciudad u oficina. -->
        <?php if ($tipoPaso === "region" || $tipoPaso === "ciudad" || $tipoPaso === "oficina"): ?>
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

            <?php foreach ($opciones as $opcion): ?>
            <?php
            if ($tipoPaso === "region") {
                $url = "oficina.php?id_tramite=$id_tramite&id_region=" . $opcion['id_region'];
                $etiqueta = "Departamento";
                $nombre = $opcion['nombre_region'];
                $descripcion = "Selecciona este departamento para ver las ciudades disponibles.";
            } elseif ($tipoPaso === "ciudad") {
                $url = "oficina.php?id_tramite=$id_tramite&id_region=$id_region&id_ciudad=" . $opcion['id_ciudad'];
                $etiqueta = "Ciudad";
                $nombre = $opcion['nombre_ciudad'];
                $descripcion = "Selecciona esta ciudad para ver las oficinas disponibles.";
            } elseif ($tipoPaso === "oficina") {
                $url = "oficina.php?id_tramite=$id_tramite&id_region=$id_region&id_ciudad=$id_ciudad&id_oficina=" . $opcion['id_oficina'];
                $etiqueta = "Oficina";
                $nombre = $opcion['nombre_oficina'];
                $descripcion = $opcion['direccion_oficina'];
            } 
            ?>

            <a href="<?php echo $url; ?>" class="<?php echo $cardOpcion; ?>">
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-primary-red">
                    <?php echo $etiqueta; ?>
                </p>

                <h2 class="mt-3 text-xl font-black text-slate-950">
                    <?php echo $nombre; ?>
                </h2>

                <p class="mt-2 text-sm leading-6 text-slate-600">
                    <?php echo $descripcion; ?>
                </p>

            </a>

            <?php endforeach; ?>
            <?php endif; ?>


        </div>

        <!-- Formulario de fecha: usa GET porque aun solo estamos avanzando en el flujo. -->
        <?php if ($tipoPaso === "fecha"): ?>
        <form method="GET" action="oficina.php"
            class="mx-auto max-w-md rounded-2xl border border-red-100 bg-white p-6 shadow-lg shadow-red-100/60">
            <input type="hidden" name="id_tramite" value="<?php echo $id_tramite; ?>">
            <input type="hidden" name="id_region" value="<?php echo $id_region; ?>">
            <input type="hidden" name="id_ciudad" value="<?php echo $id_ciudad; ?>">
            <input type="hidden" name="id_oficina" value="<?php echo $id_oficina; ?>">



            <label for="fecha_cita" class="mb-2 block text-sm font-semibold text-slate-800">
                Fecha de la cita
            </label>

            <input id="fecha_cita" type="date" name="fecha_cita" required
                class="block w-full rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-primary-red focus:ring-4 focus:ring-red-100">

            <button type="submit"
                class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-6 py-4 text-base font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200">
                Continuar
            </button>
        </form>
        <?php endif ?>

        <!-- Horas disponibles: cada boton envia la hora elegida para guardar la cita. -->
        <?php if ($tipoPaso === "hora"): ?>
        <div class="mx-auto grid max-w-3xl gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($horasDisponibles as $hora): ?>
            <form method="POST" action="../controllers/guardar_cita.php" class="w-full">
                <input type="hidden" name="id_tramite" value="<?php echo $id_tramite; ?>">
                <input type="hidden" name="id_oficina" value="<?php echo $id_oficina; ?>">
                <input type="hidden" name="fecha_cita" value="<?php echo $fecha_cita; ?>">
                <input type="hidden" name="hora_cita" value="<?php echo $hora; ?>">
                <input type="hidden" name="id_region" value="<?php echo $id_region; ?>">
                <input type="hidden" name="id_ciudad" value="<?php echo $id_ciudad; ?>">


                <button type="submit"
                    class="flex min-h-24 w-full items-center justify-center rounded-2xl border border-red-100 bg-white px-5 py-4 text-xl font-black text-slate-950 shadow-lg shadow-red-100/60 transition hover:-translate-y-1 hover:border-primary-red hover:bg-primary-soft focus:outline-none focus:ring-4 focus:ring-red-100">
                    <?php echo substr($hora, 0, 5); ?>
                </button>

            </form>



            <?php endforeach ?>
        </div>
        <?php endif; ?>


        <!-- Accion secundaria para regresar al paso anterior. -->
        <div class="mt-10 text-center">
            <a href="<?php echo $urlVolver; ?>"
                class="inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-6 py-4 text-base font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200 sm:w-auto">
                <?php echo $textoVolver; ?>
            </a>
        </div>

    </section>



</main>

<?php include(__DIR__ . "/../layout/footer.php") ?>
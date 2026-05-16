<?php 
$success = $_GET['success'] ?? null;
$error = $_GET['error'] ?? null;
$mode = $_GET['mode'] ?? null;

session_start(); //memoria de sesion

// tengo que validar que se tiene seccion activa lo lleve a ver citas si no a login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php?redirect=ver_citas");
    exit;
    // tengo que validar que se tiene seccion activa lo lleve a ver citas si no a login
}

if (isset($_SESSION['id_usuario'])) {
    require_once __DIR__ .'/../config/conexionDB.php';

    $sql="  SELECT c.id_cita,
            t.nombre_tramite,
            o.nombre_oficina,
            o.direccion_oficina,
            ci.nombre_ciudad,
            c.fecha_cita,
            c.hora_cita,
            e.nombre_estado
            FROM citas c
            JOIN tramites t ON c.id_tramite = t.id_tramite
            JOIN oficinas o ON c.id_oficina = o.id_oficina
            JOIN ciudades ci ON o.id_ciudad = ci.id_ciudad
            JOIN estados e ON c.id_estado = e.id_estado
            WHERE c.id_usuario = :id_usuario
            ORDER BY c.fecha_cita, c.hora_cita
            ";
    
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':id_usuario' => $_SESSION['id_usuario']
    ]); 
    $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$mostrarNavbar = true;
include(__DIR__ . '/../layout/header.php');
?>

<main class="flex-1 py-1">
    <section class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-4 text-center">
            <p class="mb-3 text-sm font-bold uppercase tracking-[0.2em] text-primary-red">
                Mis Citas
            </p>
            <h1 class="text-3xl font-black leading-tight text-slate-950 sm:text-5xl">
                Citas Agendadas
            </h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-600">
                Consulta el detalle de tus citas y revisa su estado actual
            </p>

        </div>

        <?php if ($success === 'cancelada'): ?>
        <div
            class="mx-auto mb-6 max-w-2xl rounded-2xl border border-green-100 bg-green-50 p-4 text-green-800 shadow-sm">
            Cita cancelada exitosamente.
        </div>
        <?php elseif ($error): ?>
        <div class="mx-auto mb-6 max-w-2xl rounded-2xl border border-red-100 bg-red-50 p-4 text-red-800 shadow-sm">
            Ocurrió un error al procesar la cita.
        </div>
        <?php endif; ?>

        <?php if ($mode === 'cancelar'): ?>
        <div
            class="mx-auto mb-6 max-w-2xl rounded-2xl border border-primary-red bg-primary-soft p-4 text-primary-red shadow-sm">
            Selecciona una cita para cancelar o modificar.
        </div>
        <?php endif; ?>

        <?php if (empty($citas)): ?>
        <div
            class="mx-auto max-w-md rounded-2xl border border-red-100 bg-white p-8 text-center shadow-lg shadow-red-100/60">
            <h2 class="text-2xl font-black text-slate-950">
                No tiene citas Agendadas
            </h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">
                Cuando agendes una cita, aparecera aqui con todos sus detalles
            </p>
            <a href="servicio.php"
                class="mt-6 inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-6 py-4 text-base font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200 sm:w-auto">
                Agendar cita
            </a>

        </div>

        <?php else: ?>
        <div class="grid gap-5 lg:grid-cols-2">
            <?php foreach ($citas as $cita): ?>
            <article class="rounded-2xl border border-red-100 bg-white p-6 shadow-lg shadow-red-100/60">
                <header
                    class="mb-5 flex flex-col gap-3 border-b border-red-100 pb-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.18em] text-primary-red">
                            Tramite
                        </p>

                        <h2 class="mt-2 text-xl font-black text-slate-950">
                            <?php echo $cita['nombre_tramite']?>
                        </h2>
                    </div>

                    <span
                        class="inline-flex w-fit items-center rounded-full bg-primary-soft px-3 py-1 text-xs font-bold uppercase tracking-[0.16em] text-primary-red">
                        <?php echo $cita['nombre_estado']?>
                    </span>

                </header>
                <dl class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-xl bg-primary-soft/60 p-4">
                        <dt class="text-xs font-bold uppercase tracking-[0.16em] text-primary-red">
                            Fecha
                        </dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-800">
                            <?php echo $cita['fecha_cita']; ?>
                        </dd>
                    </div>

                    <div class="rounded-xl bg-primary-soft/60 p-4">
                        <dt class="text-xs font-bold uppercase tracking-[0.16em] text-primary-red">
                            Hora
                        </dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-800">
                            <?php echo substr($cita['hora_cita'], 0, 5); ?>

                        </dd>
                    </div>

                    <div class="rounded-xl bg-primary-soft/60 p-4">
                        <dt class="text-xs font-bold uppercase tracking-[0.16em] text-primary-red">
                            Oficina
                        </dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-800">
                            <?php echo $cita['nombre_oficina']; ?>
                        </dd>
                    </div>

                    <div class="rounded-xl bg-primary-soft/60 p-4">
                        <dt class="text-xs font-bold uppercase tracking-[0.16em] text-primary-red">
                            Ciudad
                        </dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-800">
                            <?php echo $cita['nombre_ciudad']; ?>
                        </dd>
                    </div>

                    <div class="rounded-xl bg-primary-soft/60 p-4 sm:col-span-2">
                        <div class="rounded-xl bg-primary-soft/60 p-4">
                            <dt class="text-xs font-bold uppercase tracking-[0.16em] text-primary-red">
                                Direccion
                            </dt>
                            <dd class="mt-1 text-sm font-semibold text-slate-800">
                                <?php echo $cita['direccion_oficina']; ?>
                            </dd>
                        </div>
                    </div>

                </dl>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-center">
                    <form method="POST" action="../controllers/cancelar_cita.php" class="w-full">
                        <input type="hidden" name="id_cita" value="<?php echo $cita['id_cita']; ?>">
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-bold text-primary-red shadow-sm transition hover:-translate-y-0.5 hover:border-primary-red hover:bg-primary-soft focus:outline-none focus:ring-4 focus:ring-red-100">
                            Cancelar Cita
                        </button>
                    </form>
                    <form method="POST" action="../controllers/modificar_cita.php" class="w-full">
                        <input type="hidden" name="id_cita" value="<?php echo $cita['id_cita']; ?>">
                        <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-xl bg-secundary-blue px-4 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-secundary-blue_hover focus:outline-none focus:ring-4 focus:ring-blue-200">
                            Modificar Cita
                        </button>
                    </form>
                </div>

            </article>
            <?php endforeach; ?>

        </div>

        <?php endif; ?>
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-center">
            <a href="servicio.php"
                class="inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-4 py-3 text-sm font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200 sm:w-auto">
                Agendar otra cita
            </a>

            <a href="../controllers/cerrar_sesion.php"
                class="inline-flex w-full items-center justify-center rounded-xl border border-red-100 bg-white px-6 py-3 text-sm font-bold text-primary-red shadow-sm transition hover:-translate-y-0.5 hover:border-primary-red hover:bg-primary-soft focus:outline-none focus:ring-4 focus:ring-red-100 sm:w-auto">
                Cerrar
            </a>

    </section>

</main>
<?php include(__DIR__ . "/../layout/footer.php") ?>
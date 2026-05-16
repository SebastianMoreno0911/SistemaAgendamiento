<?php 
//desde url
$tipo_documento = $_GET['tipo_documento'] ?? null;
$documento = $_GET['documento'] ?? null;
$redirect = $_GET['redirect'] ?? null;

if (!$tipo_documento || !$documento) {
    header("Location: login.php");
    exit;
}

$mostrarNavbar = true;
include(__DIR__ . "/../layout/header.php");

?>

<main class="mx-auto flex flex-1 max-w-6xl items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <section class="w-full max-w-md rounded-2xl border border-red-100 bg-white p-6 shadow-2xl shadow-red-100/70 sm:p-8">

        <h1 class="text-3xl font-black leading-tight text-slate-950 text-center">
            Completa tus datos
        </h1>

        <p class="mt-3 text-sm leading-6 text-slate-600">
            Necesitamos esta informacion para crear tu usuario y continuar con el agendamiento
        </p>

        <form method="POST" action="../controllers/guardar_usuario.php" class="mt-6 space-y-5">
            <!-- Campos ocultos con tipo_documento y documento -->
            <input type="hidden" name="tipo_documento" value="<?php echo $tipo_documento; ?>">
            <input type="hidden" name="documento" value="<?php echo $documento; ?>">
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>">

            <!-- Nombre -->
            <div>
                <p class="mb-2 text-sm font-semibold text-slate-800">
                    Nombre
                </p>
                <input name="nombre" type="text" placeholder="Ej: Juan"
                    class="block w-full rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-primary-red focus:ring-4 focus:ring-red-100"
                    required>
            </div>

            <!-- Apellido -->
            <div>
                <p class="mb-2 text-sm font-semibold text-slate-800">
                    Apellido
                </p>
                <input name="apellido" type="text" placeholder="Ej: Perez"
                    class="block w-full rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-primary-red focus:ring-4 focus:ring-red-100"
                    required>
            </div>

            <!-- Teléfono -->
            <div>
                <p class="mb-2 text-sm font-semibold text-slate-800">
                    Telefono
                </p>
                <input name="telefono" type="number" placeholder="Ej: 3001234567"
                    class="block w-full rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-primary-red focus:ring-4 focus:ring-red-100"
                    required>
            </div>

            <!-- Correo Electrónico -->
            <div>
                <p class="mb-2 text-sm font-semibold text-slate-800">
                    Correo Electronico
                </p>
                <input name="correo_electronico" type="email" placeholder="Ej: tu@correo.com"
                    class="block w-full rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-primary-red focus:ring-4 focus:ring-red-100"
                    required>
            </div>

            <!-- Botón Enviar -->
            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-6 py-4 text-base font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200">
                Crear Usuario
            </button>
            <div>
                <a href=" ../index.php"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-red-100 bg-white px-6 py-3 text-sm font-bold text-primary-red shadow-sm transition hover:-translate-y-0.5 hover:border-primary-red hover:bg-primary-soft focus:outline-none focus:ring-4 focus:ring-red-100">
                    Volver al inicio
                </a>
            </div>
        </form>
    </section>

</main>

<?php include(__DIR__ . "/../layout/footer.php") ?>
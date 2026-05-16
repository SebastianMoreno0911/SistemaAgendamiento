<!-- aqui el hecho es colocar la identificacion para poder ya no pedir mas datos y solo centrarse en el agendamiento, luego habra una parte para actualizar datos pero solo el correo y el numero de telefono (aunque para seguridad estaria mal hecho) -->

<?php 
$redirect = $_GET['redirect'] ?? null; //obtengo el redirect de ver citas
require_once __DIR__ . '/../config/conexionDB.php'; ?>
<!--no se si se necesite la inclusion de la base de datos pero la dejo por si la necesito -->

<?php 
$mostrarNavbar = false;
include(__DIR__ . "/../layout/header.php") 
?>

<main class="mx-auto flex flex-1 max-w-6xl items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
    <section class="w-full max-w-md rounded-2xl border border-red-100 bg-white p-6 shadow-2xl shadow-red-100/70 sm:p-8">
        <div class="mb-8 text-center">
            <div
                class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-primary-red text-xl font-black text-white shadow-lg shadow-red-200">
                ID
            </div>
            <p class="mb-2 text-sm font-bold uppercase tracking-[0.2em] text-primary-red">Validacion</p>
            <h1 class="text-3xl font-black leading-tight text-slate-950">Identifica tu cita</h1>
            <p class="mt-3 text-sm leading-6 text-slate-600">
                Selecciona tu documento para continuar con el agendamiento virtual.
            </p>
        </div>

        <form class="space-y-5" action="../controllers/validar_usuario.php" method="POST">
            <!-- lo mando a validar usuario -->
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>">
            <!--  -->
            <div>
                <label for="opciones-id" class="mb-2 block text-sm font-semibold text-slate-800">
                    Tipo de identificacion
                </label>
                <select id="opciones-id" name="tipo_id"
                    class="block w-full rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition focus:border-primary-red focus:ring-4 focus:ring-red-100">
                    <option selected value="CC">Cedula de Ciudadania</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="PS">Pasaporte</option>
                </select>
            </div>

            <div>
                <label for="numero-id" class="mb-2 block text-sm font-semibold text-slate-800">
                    Numero de identificacion
                </label>

                <input id="numero-id" name="numero_id" type="number" placeholder="Ej: 1000000000"
                    class="block w-full rounded-xl border border-red-100 bg-white px-4 py-3 text-sm font-medium text-slate-800 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-primary-red focus:ring-4 focus:ring-red-100">
                <p class="mt-1 text-sm leading-6 text-slate-600 text-center">
                    Sin puntos ni comas
                </p>

            </div>

            <div>
                <button type="submit"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-6 py-4 text-base font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200"
                    name="btn-continuar-login">
                    Continuar
                </button>

            </div>

            <a href="../index.php"
                class="inline-flex w-full items-center justify-center rounded-xl bg-secundary-blue px-6 py-4 text-base font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-secundary-blue_hover focus:outline-none focus:ring-4 focus:ring-blue-200">
                Volver al inicio
            </a>

            <a href="../pages/crear_usuario.php"
                class="inline-flex w-full items-center justify-center rounded-xl border border-red-100 bg-white px-6 py-3 text-sm font-bold text-primary-red shadow-sm transition hover:-translate-y-0.5 hover:border-primary-red hover:bg-primary-soft focus:outline-none focus:ring-4 focus:ring-red-100">Crear
                cuenta</a>

        </form>
    </section>
</main>

<?php include(__DIR__ . "/../layout/footer.php") ?>
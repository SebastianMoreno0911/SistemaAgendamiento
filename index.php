<!-- agrego base de datos -->
<?php require_once 'config/conexionDB.php';?>

<!-- agrego el header -->
<?php include("layout/header.php") ?>

<main class="relative flex-1 overflow-hidden">
    <section class="mx-auto flex h-full max-w-6xl items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div
            class="w-full max-w-xl rounded-2xl border border-red-100/40 bg-white p-6 text-center shadow-2xl shadow-neutral-slate/10 sm:p-10">
            <div
                class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary-red text-2xl font-black text-white shadow-lg shadow-red-200">
                SA
            </div>

            <p class="mb-3 text-sm font-bold uppercase tracking-[0.2em] text-primary-red">Agenda virtual</p>
            <h1 class="text-3xl font-black leading-tight text-slate-950 sm:text-5xl">
                Sistema de Agendamiento Virtual
            </h1>
            <p class="mx-auto mt-5 max-w-md text-base leading-7 text-slate-600">
                Gestiona tus citas virtuales de forma rapida, clara y segura desde un solo lugar.
            </p>

            <div class="mt-8">
                <a href="pages/login.php"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-primary-red px-6 py-4 text-base font-bold text-white shadow-lg shadow-red-200 transition hover:-translate-y-0.5 hover:bg-primary-dark focus:outline-none focus:ring-4 focus:ring-red-200 sm:w-auto">
                    Agendar Cita Virtual
                </a>

                <a href="pages/login.php?redirect=ver_citas"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-secundary-blue px-6 py-4 text-base font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-secundary-blue_hover focus:outline-none focus:ring-4 focus:ring-blue-200 sm:w-auto">
                    Ver Citas Agendadas
                </a>

                <a href="pages/login.php?redirect=cancelar_cita"
                    class="inline-flex w-full items-center justify-center rounded-xl border border-primary-red bg-white px-6 py-4 text-base font-bold text-primary-red shadow-sm transition hover:-translate-y-0.5 hover:bg-primary-soft focus:outline-none focus:ring-4 focus:ring-red-100 sm:w-auto">
                    Cancelar Cita
                </a>




            </div>


        </div>
    </section>
</main>

<!-- agrego el footer -->
<?php include("layout/footer.php") ?>
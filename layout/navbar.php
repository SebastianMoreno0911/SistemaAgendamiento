<?php
$isInsidePages = basename(dirname($_SERVER['SCRIPT_NAME'])) === 'pages';
$homeLink = $isInsidePages ? '../index.php' : 'index.php';
$loginLink = $isInsidePages ? 'login.php' : 'pages/login.php';
?>
<nav class="sticky top-0 z-50 border-b border-red-100 bg-white/95 shadow-sm backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-center px-2 py-2 sm:px-6 lg:px-8">
        <a href="<?php echo $homeLink; ?>" class="flex items-center gap-3">
            <span
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary-red text-lg font-black text-white shadow-sm">
                SA
            </span>
            <span>
                <span class="block text-base font-bold leading-tight text-slate-950">Sistema de Agendamiento</span>
                <span class="block text-xs font-medium text-slate-500">Citas virtuales</span>
            </span>
            <span class="block text-xs font-medium text-slate-300">V.1</span>

        </a>

    </div>
</nav>
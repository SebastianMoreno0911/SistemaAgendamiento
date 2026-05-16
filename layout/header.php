<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Agendamiento Virtual</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        red: '#c1121f',
                        dark: '#7f0000',
                        soft: '#ffe4e6'
                    },
                    secundary: {
                        blue: '#2563eb',
                        blue_hover: '#1d4ed8',
                        soft: '#eff6ff'
                    },
                    terciario: {
                        gray: '#f8fafc',
                        gray_hover: '#e2e8f0'
                    },
                    neutral: {
                        slate: '#475569',
                        soft: '#f1f5f9'
                    },
                    success: {
                        green: '#16a34a'
                    },
                    warning: {
                        amber: '#f59e0b'
                    }
                },
                fontFamily: {
                    sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif']
                }
            }
        }
    }
    </script>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
</head>

<body class="min-h-screen bg-terciario-gray text-slate-900 antialiased flex flex-col">

    <?php 
    if(!isset($mostrarNavbar) || $mostrarNavbar){
        include(__DIR__ . "/navbar.php");
    }
     ?>
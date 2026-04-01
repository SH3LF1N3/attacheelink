<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AttachKE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
          crossorigin="anonymous" />

    {{-- OverlayScrollbars --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
          crossorigin="anonymous" />

    {{-- AdminLTE --}}
    <link rel="stylesheet" href="/src/css/adminlte.css" />

    {{-- ApexCharts --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
          crossorigin="anonymous" />

    {{-- App styles (navy/gold variables) --}}
    @vite(['resources/css/app.css'])

    {{-- Dashboard color overrides --}}
    <style>
        /* Sidebar active link uses gold */
        .app-sidebar .nav-sidebar .nav-link.active,
        .app-sidebar .nav-sidebar .nav-link:hover {
            background-color: rgba(212, 168, 67, 0.15) !important;
            color: var(--gold-400) !important;
        }
        .app-sidebar .nav-sidebar .nav-link.active .nav-icon,
        .app-sidebar .nav-sidebar .nav-link:hover .nav-icon {
            color: var(--gold-400) !important;
        }
        /* Top nav brand color */
        .app-header { background-color: #fff !important; }
        /* Footer */
        .app-footer {
            background-color: var(--navy-800) !important;
            color: #9ca3af !important;
            font-size: 0.8125rem;
        }
        .app-footer a { color: var(--gold-400) !important; }
    </style>

    @stack('styles')
</head>
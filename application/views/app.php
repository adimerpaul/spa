<?php
// Shell de la SPA: Vue 3 + Quasar + Vue Router (CDN). El layout se carga una sola vez y
// cada módulo es un componente en assets/app/pages/. Los módulos aún no migrados se
// muestran con la ruta /m/<Controlador> dentro de un iframe (sin su menú antiguo).
$menu = array(
    array('Dashboard', 'dashboard', '/'),
    array('Pacientes', 'people', '/pacientes'),
    array('Reservas', 'event', '/reservas'),
    array('Reporte diario', 'assessment', '/m/Consulta'),
    array('Ventas', 'point_of_sale', '/m/Venta'),
    array('Listado venta', 'receipt_long', '/m/Listaventa'),
    array('Filtrados', 'filter_alt', '/m/Filtros'),
    array('Cumpleaños', 'cake', '/m/Cumpleanos'),
);
$menuAdmin = array(
    array('Usuarios', 'manage_accounts', '/m/Usuarios'),
    array('Consentimiento', 'description', '/m/Consentimientos'),
    array('Indicaciones', 'list_alt', '/m/Indicaciones'),
    array('Tipo tratamiento', 'category', '/m/Tipotratamiento'),
    array('Tratamientos', 'spa', '/m/Tratamientos'),
    array('Inventario', 'inventory_2', '/m/Inventario'),
    array('Productos', 'shopping_bag', '/m/Productos'),
    array('Dosificación factura', 'receipt', '/m/Dosificacion'),
    array('Exportar BD', 'cloud_download', '/m/Export'),
    array('Papelera', 'delete_sweep', '/papelera'),
    array('Ajustes', 'settings', '/ajustes'),
);
$usuario = array(
    'idusuario' => (int)$_SESSION['idusuario'],
    'nombre' => $_SESSION['nombre'],
    'tipo' => $_SESSION['tipo'],
);
// Versión para evitar caché: fecha del archivo más reciente de assets/app
$v = '?v=' . max(array_map('filemtime', array_merge(glob(FCPATH . 'assets/app/*.*'), glob(FCPATH . 'assets/app/pages/*.js'))));
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Esencia Spa Médico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/images/icon/favicon-esencia.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>assets/images/icon/favicon-esencia-32.png">
    <link rel="apple-touch-icon" href="<?=base_url()?>assets/images/icon/apple-touch-icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Material+Icons&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/quasar@2.16.9/dist/quasar.prod.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/app/app.css<?=$v?>" rel="stylesheet">
</head>
<body>
<div id="q-app" v-cloak>
    <q-layout view="lHh Lpr lFf">
        <q-header class="app-header">
            <q-toolbar style="min-height:60px">
                <q-btn flat dense round icon="menu" @click="drawer = !drawer" aria-label="Menú"></q-btn>
                <q-toolbar-title class="text-subtitle1 text-weight-medium">{{ $route.meta.title || titulo }}</q-toolbar-title>
                <q-btn flat dense round :icon="$q.fullscreen.isActive ? 'fullscreen_exit' : 'fullscreen'" @click="$q.fullscreen.toggle()" class="gt-xs q-mr-sm"></q-btn>
                <q-btn flat no-caps class="q-px-sm">
                    <q-avatar size="34px" color="secondary" text-color="white">{{ usuario.nombre.charAt(0) }}</q-avatar>
                    <div class="q-ml-sm text-left gt-xs">
                        <div class="text-weight-medium" style="font-size:13px;line-height:1.2">{{ usuario.nombre }}</div>
                        <div class="text-grey-6" style="font-size:11px">{{ usuario.tipo }}</div>
                    </div>
                    <q-icon name="expand_more" size="18px" class="q-ml-xs"></q-icon>
                    <q-menu anchor="bottom right" self="top right">
                        <q-list style="min-width:180px">
                            <q-item>
                                <q-item-section>
                                    <q-item-label>{{ usuario.nombre }}</q-item-label>
                                    <q-item-label caption>Tipo: {{ usuario.tipo }}</q-item-label>
                                </q-item-section>
                            </q-item>
                            <q-separator></q-separator>
                            <q-item clickable tag="a" href="<?=base_url()?>welcome/logout">
                                <q-item-section avatar><q-icon name="logout" color="negative"></q-icon></q-item-section>
                                <q-item-section>Salir</q-item-section>
                            </q-item>
                        </q-list>
                    </q-menu>
                </q-btn>
            </q-toolbar>
        </q-header>

        <q-drawer v-model="drawer" show-if-above :width="220" class="app-drawer">
            <q-scroll-area class="fit">
                <router-link to="/" class="drawer-logo block">
                    <img :src="logo" alt="Esencia Spa Médico">
                </router-link>
                <q-list>
                    <q-item v-for="m in menu" :key="m.to" clickable :to="m.to" :exact="m.to === '/'" active-class="active" @click="recargar(m.to)">
                        <q-item-section avatar><q-icon :name="m.icon"></q-icon></q-item-section>
                        <q-item-section>{{ m.label }}</q-item-section>
                    </q-item>
                    <template v-if="menuAdmin.length">
                        <q-item-label header class="header">Administración</q-item-label>
                        <q-item v-for="m in menuAdmin" :key="m.to" clickable :to="m.to" active-class="active" @click="recargar(m.to)">
                            <q-item-section avatar><q-icon :name="m.icon"></q-icon></q-item-section>
                            <q-item-section>{{ m.label }}</q-item-section>
                        </q-item>
                    </template>
                    <q-separator dark spaced inset style="opacity:.25"></q-separator>
                    <q-item clickable tag="a" href="<?=base_url()?>welcome/logout">
                        <q-item-section avatar><q-icon name="logout"></q-icon></q-item-section>
                        <q-item-section>Salir</q-item-section>
                    </q-item>
                </q-list>
            </q-scroll-area>
        </q-drawer>

        <q-page-container>
            <router-view v-slot="{ Component, route }">
                <transition name="fade" mode="out-in">
                    <component :is="Component" :key="route.path + '#' + recarga"></component>
                </transition>
            </router-view>
        </q-page-container>
    </q-layout>
</div>

<script>
    window.APP = {
        base: '<?=base_url()?>',
        usuario: <?=json_encode($usuario)?>,
        logo: <?=json_encode($this->Configuracion->logoUrl())?>,
        menu: <?=json_encode(array_map(function ($m) { return array('label' => $m[0], 'icon' => $m[1], 'to' => $m[2]); }, $menu))?>,
        menuAdmin: <?=json_encode($_SESSION['tipo'] == 'ADMIN' ? array_map(function ($m) { return array('label' => $m[0], 'icon' => $m[1], 'to' => $m[2]); }, $menuAdmin) : array())?>
    };
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@3.4.38/dist/vue.global.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-router@4.4.5/dist/vue-router.global.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quasar@2.16.9/dist/quasar.umd.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quasar@2.16.9/dist/lang/es.umd.prod.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/locales/es.global.min.js"></script>
<script src="<?=base_url()?>assets/app/pages/dashboard.js<?=$v?>"></script>
<script src="<?=base_url()?>assets/app/pages/pacientes.js<?=$v?>"></script>
<script src="<?=base_url()?>assets/app/pages/reservas.js<?=$v?>"></script>
<script src="<?=base_url()?>assets/app/pages/legacy.js<?=$v?>"></script>
<script src="<?=base_url()?>assets/app/pages/papelera.js<?=$v?>"></script>
<script src="<?=base_url()?>assets/app/pages/ajustes.js<?=$v?>"></script>
<script src="<?=base_url()?>assets/app/pages/fotos.js<?=$v?>"></script>
<script src="<?=base_url()?>assets/app/app.js<?=$v?>"></script>
</body>
</html>

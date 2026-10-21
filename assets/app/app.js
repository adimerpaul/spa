// Arranque de la SPA: router, helpers y montaje de Vue + Quasar
(function () {
    // Helper para llamar a los controladores que devuelven JSON
    window.api = function (url, datos, metodo) {
        var opts = { headers: { 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' };
        if (datos && metodo !== 'GET') {
            var fd = new FormData();
            Object.keys(datos).forEach(function (k) { fd.append(k, datos[k] == null ? '' : datos[k]); });
            opts.method = 'POST';
            opts.body = fd;
        } else if (datos) {
            url += '?' + new URLSearchParams(datos).toString();
        }
        return fetch(APP.base + url, opts).then(function (r) {
            if (r.status === 401) { location.href = APP.base; throw new Error('Sesión expirada'); }
            return r.json().catch(function () { return {}; }).then(function (j) {
                if (!r.ok) throw new Error(j.error || ('Error ' + r.status));
                return j;
            });
        });
    };

    var router = VueRouter.createRouter({
        history: VueRouter.createWebHashHistory(),
        routes: [
            { path: '/', component: Pages.Dashboard, meta: { title: 'Dashboard' } },
            { path: '/pacientes', component: Pages.Pacientes, meta: { title: 'Pacientes' } },
            { path: '/reservas', component: Pages.Reservas, meta: { title: 'Reservas' } },
            // El enlace antiguo al módulo de reservas abre la nueva agenda
            { path: '/m/Reserva', redirect: '/reservas' },
            { path: '/papelera', component: Pages.Papelera, meta: { title: 'Papelera' } },
            { path: '/ajustes', component: Pages.Ajustes, meta: { title: 'Ajustes' } },
            { path: '/pacientes/:id/fotos', component: Pages.Fotos, meta: { title: 'Fotografías' } },
            // El enlace antiguo de fotos abre la nueva galería
            { path: '/m/photo/index/:id', redirect: function (to) { return '/pacientes/' + to.params.id + '/fotos'; } },
            { path: '/m/Photo/index/:id', redirect: function (to) { return '/pacientes/' + to.params.id + '/fotos'; } },
            { path: '/m/:ruta(.*)', component: Pages.Legacy }
        ],
        scrollBehavior: function () { return { top: 0 }; }
    });

    var app = Vue.createApp({
        data: function () {
            return {
                drawer: false,
                recarga: 0,
                usuario: APP.usuario,
                logo: APP.logo,
                menu: APP.menu,
                menuAdmin: APP.menuAdmin
            };
        },
        computed: {
            // Título para los módulos antiguos, sacado del menú
            titulo: function () {
                // /m/Paciente/escoger/5 → "paciente"; se compara con el menú sin importar mayúsculas
                var ctrl = (this.$route.path.split('/')[2] || '').toLowerCase();
                var item = this.menu.concat(this.menuAdmin).find(function (m) {
                    var to = m.to.toLowerCase().replace(/^\/m\//, '/');
                    return to !== '/' && (to === '/' + ctrl || to === '/' + ctrl + 's');
                });
                return item ? item.label : 'Esencia';
            }
        },
        methods: {
            // Clic en el ítem del menú de la página actual: volver a cargar el módulo desde cero
            recargar: function (to) {
                if (this.$route.path === to) this.recarga++;
            }
        },
        watch: {
            '$route': function () {
                document.title = (this.$route.meta.title || this.titulo) + ' | Esencia Spa Médico';
                if (this.$q.screen.lt.md) this.drawer = false;
            }
        }
    });

    app.use(router);
    app.use(Quasar, {
        lang: Quasar.lang.es,
        config: {
            brand: { primary: '#5e768a', secondary: '#89bcab', accent: '#c9a96e', positive: '#5aa98a', negative: '#c0565b' },
            notify: { position: 'top-right', timeout: 2500 }
        }
    });
    app.mount('#q-app');
})();

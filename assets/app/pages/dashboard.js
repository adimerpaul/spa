window.Pages = window.Pages || {};

Pages.Dashboard = {
    template: `
<q-page class="q-pa-md">
    <div class="row items-center q-mb-md">
        <div class="col">
            <h1 class="page-title">Hola, {{ nombre }}</h1>
            <div class="page-sub">{{ hoy }}</div>
        </div>
        <q-btn flat round icon="refresh" color="primary" :loading="cargando" @click="cargar"></q-btn>
    </div>

    <div class="row q-col-gutter-md q-mb-md">
        <div class="col-6 col-md-3" v-for="s in stats" :key="s.label">
            <q-card flat class="card full-height">
                <q-card-section class="row items-center no-wrap q-pa-md">
                    <q-avatar :style="{ background: s.bg }" text-color="white" :icon="s.icon" size="46px" class="gt-xs q-mr-md"></q-avatar>
                    <div class="ellipsis">
                        <div class="text-grey-7" style="font-size:12px">{{ s.label }}</div>
                        <q-skeleton v-if="!datos" type="text" width="80px"></q-skeleton>
                        <div v-else class="text-weight-bold" style="font-size:20px;color:#4a5f71">{{ s.valor }}</div>
                    </div>
                </q-card-section>
            </q-card>
        </div>
    </div>

    <div class="row q-col-gutter-md">
        <div class="col-12 col-md-8">
            <q-card flat class="card full-height column">
                <q-card-section class="row items-center">
                    <div class="text-subtitle1 text-weight-medium col">Ingresos de los últimos 14 días</div>
                    <div class="text-grey-7" style="font-size:13px">Bs {{ formato(totalDias) }}</div>
                </q-card-section>
                <!-- El gráfico ocupa todo el alto de la tarjeta para no dejar espacio en blanco -->
                <q-card-section class="q-pt-none col column">
                    <div class="col" style="position:relative;min-height:280px;min-width:0;width:100%;overflow:hidden">
                        <canvas ref="grafico" style="position:absolute;inset:0"></canvas>
                    </div>
                </q-card-section>
            </q-card>
        </div>

        <div class="col-12 col-md-4">
            <q-card flat class="card q-mb-md">
                <q-card-section class="row items-center q-pb-sm">
                    <q-icon name="event" color="primary" size="22px" class="q-mr-sm"></q-icon>
                    <div class="text-subtitle1 text-weight-medium col">Reservas de hoy</div>
                    <q-badge color="secondary" :label="datos ? datos.reservasHoy.length : 0"></q-badge>
                </q-card-section>
                <q-list separator v-if="datos && datos.reservasHoy.length" style="max-height:300px;overflow:auto">
                    <q-item v-for="r in datos.reservasHoy" :key="r.id">
                        <q-item-section avatar>
                            <q-chip dense square color="blue-grey-1" text-color="primary" class="text-weight-medium">{{ r.hora }}</q-chip>
                        </q-item-section>
                        <q-item-section>
                            <q-item-label class="ellipsis">{{ r.paciente }}</q-item-label>
                            <q-item-label caption class="ellipsis">{{ r.usuario }}<span v-if="r.descripcion"> · {{ r.descripcion }}</span></q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>
                <q-card-section v-else class="text-grey-6 text-center q-py-lg" style="font-size:13px">
                    <q-icon name="event_available" size="32px" class="q-mb-sm"></q-icon>
                    <div>No hay reservas para hoy</div>
                </q-card-section>
                <q-card-actions align="right">
                    <q-btn flat no-caps color="primary" label="Ver agenda" icon-right="chevron_right" to="/m/Reserva"></q-btn>
                </q-card-actions>
            </q-card>

            <q-card flat class="card">
                <q-card-section class="row items-center q-pb-sm">
                    <q-icon name="cake" color="secondary" size="22px" class="q-mr-sm"></q-icon>
                    <div class="text-subtitle1 text-weight-medium col">Cumpleaños de hoy</div>
                </q-card-section>
                <q-list separator v-if="datos && datos.cumpleanosHoy.length">
                    <q-item v-for="c in datos.cumpleanosHoy" :key="c.idpaciente">
                        <q-item-section>
                            <q-item-label class="ellipsis">{{ c.nombre }}</q-item-label>
                            <q-item-label caption>Cumple {{ c.edad }} años</q-item-label>
                        </q-item-section>
                        <q-item-section side v-if="c.celular">
                            <q-btn flat round dense color="positive" icon="chat" type="a" target="_blank"
                                   :href="'https://wa.me/591' + c.celular.replace(/\\D/g, '')"></q-btn>
                        </q-item-section>
                    </q-item>
                </q-list>
                <q-card-section v-else class="text-grey-6 text-center q-py-md" style="font-size:13px">
                    Nadie cumple años hoy
                </q-card-section>
                <q-card-actions align="right">
                    <q-btn flat no-caps color="primary" label="Ver el mes" icon-right="chevron_right" to="/m/Cumpleanos"></q-btn>
                </q-card-actions>
            </q-card>
        </div>
    </div>
</q-page>`,
    data: function () {
        return { datos: null, cargando: false };
    },
    computed: {
        nombre: function () {
            return APP.usuario.nombre.split(' ')[0];
        },
        hoy: function () {
            var t = new Date().toLocaleDateString('es-BO', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            return t.charAt(0).toUpperCase() + t.slice(1);
        },
        totalDias: function () {
            return this.datos ? this.datos.ingresosDias.reduce(function (a, d) { return a + Number(d.total); }, 0) : 0;
        },
        stats: function () {
            var d = this.datos || {};
            return [
                { label: 'Ingresos hoy', valor: 'Bs ' + this.formato(d.ingresosHoy || 0), icon: 'payments', bg: '#5e768a' },
                { label: 'Ingresos del mes', valor: 'Bs ' + this.formato(d.ingresosMes || 0), icon: 'trending_up', bg: '#89bcab' },
                { label: 'Atenciones hoy', valor: d.atencionesHoy || 0, icon: 'spa', bg: '#7399a0' },
                { label: 'Pacientes', valor: this.formato(d.pacientes || 0), icon: 'people', bg: '#c9a96e' }
            ];
        }
    },
    mounted: function () {
        this.cargar();
    },
    beforeUnmount: function () {
        if (this.chart) this.chart.destroy();
    },
    methods: {
        formato: function (n) {
            return Number(n).toLocaleString('es-BO', { maximumFractionDigits: 0 });
        },
        cargar: function () {
            var vm = this;
            vm.cargando = true;
            api('Dashboard/datos').then(function (d) {
                vm.datos = d;
                vm.$nextTick(vm.dibujar);
            }).catch(function () {
                vm.$q.notify({ type: 'negative', message: 'No se pudo cargar el dashboard' });
            }).finally(function () {
                vm.cargando = false;
            });
        },
        dibujar: function () {
            if (!this.$refs.grafico) return;
            var dias = this.datos.ingresosDias;
            var ctx = this.$refs.grafico.getContext('2d');
            // Degradado según el alto real del área del gráfico
            var grad = function (c) {
                var area = c.chart.chartArea;
                if (!area) return '#7399a0';
                var g = c.chart.ctx.createLinearGradient(0, area.top, 0, area.bottom);
                g.addColorStop(0, '#5e768a');
                g.addColorStop(1, '#89bcab');
                return g;
            };
            if (this.chart) this.chart.destroy();
            // Se guarda fuera de data para que Vue no lo vuelva reactivo
            this.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dias.map(function (d) { return d.dia; }),
                    datasets: [{ data: dias.map(function (d) { return Number(d.total); }), backgroundColor: grad, borderRadius: 6, maxBarThickness: 34 }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { callbacks: { label: function (c) { return 'Bs ' + c.parsed.y.toLocaleString('es-BO'); } } }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, grid: { color: '#eef2f4' }, ticks: { callback: function (v) { return v.toLocaleString('es-BO'); } } }
                    }
                }
            });
        }
    }
};

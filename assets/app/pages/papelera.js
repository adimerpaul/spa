window.Pages = window.Pages || {};

// Papelera (soft delete): lo eliminado en cualquier módulo, con opción de restaurar
Pages.Papelera = {
    template: `
<q-page class="q-pa-md">
    <div class="row items-center q-col-gutter-sm q-mb-md">
        <div class="col-12 col-sm">
            <h1 class="page-title">Papelera</h1>
            <div class="page-sub">Todo lo eliminado en el sistema se guarda aquí y se puede restaurar</div>
        </div>
        <div class="col-12 col-sm-auto row no-wrap q-gutter-sm items-center">
            <q-btn-toggle v-model="estado" no-caps unelevated dense toggle-color="primary" color="white" text-color="grey-8"
                          :options="[{label:'Pendientes', value:'pendientes'}, {label:'Restaurados', value:'restaurados'}, {label:'Todos', value:''}]"
                          @update:model-value="buscar" class="bg-white" style="border:1px solid #dde4e8"></q-btn-toggle>
            <q-input v-model="search" dense outlined clearable debounce="300" placeholder="Buscar..." class="bg-white col" style="min-width:180px" @update:model-value="buscar">
                <template v-slot:prepend><q-icon name="search"></q-icon></template>
            </q-input>
        </div>
    </div>

    <q-card flat class="card">
        <q-table flat dense :rows="rows" :columns="columns" row-key="idpapelera" v-model:pagination="pagination"
                 :rows-per-page-options="[20, 50, 100]" :loading="cargando" @request="onRequest"
                 :grid="$q.screen.xs" no-data-label="La papelera está vacía" rows-per-page-label="Filas por página">
            <template v-slot:body-cell-descripcion="props">
                <q-td :props="props">
                    <div class="text-weight-medium">{{ props.row.descripcion }}</div>
                    <div class="text-grey-6" style="font-size:11px">{{ etiqueta(props.row.tabla) }} · {{ props.row.filas }} registro(s)</div>
                </q-td>
            </template>
            <template v-slot:body-cell-estado="props">
                <q-td :props="props">
                    <q-badge v-if="props.row.restaurado" color="positive" outline>Restaurado {{ props.row.restaurado }}</q-badge>
                    <q-badge v-else color="grey-6" outline>Eliminado</q-badge>
                </q-td>
            </template>
            <template v-slot:body-cell-acciones="props">
                <q-td :props="props" auto-width>
                    <q-btn flat dense round icon="visibility" color="grey-7" @click="ver(props.row)"><q-tooltip>Ver detalle</q-tooltip></q-btn>
                    <q-btn v-if="!props.row.restaurado" flat dense round icon="restore" color="primary" @click="restaurar(props.row)"><q-tooltip>Restaurar</q-tooltip></q-btn>
                </q-td>
            </template>
            <template v-slot:item="props">
                <div class="col-12 q-pa-xs">
                    <q-card flat bordered class="q-pa-sm" style="border-radius:12px">
                        <div class="text-weight-medium">{{ props.row.descripcion }}</div>
                        <div class="text-grey-6" style="font-size:12px">{{ props.row.fecha }} · {{ props.row.usuario }} · {{ props.row.filas }} registro(s)</div>
                        <div class="row items-center q-mt-xs">
                            <q-badge v-if="props.row.restaurado" color="positive" outline>Restaurado</q-badge>
                            <q-space></q-space>
                            <q-btn flat dense round icon="visibility" color="grey-7" @click="ver(props.row)"></q-btn>
                            <q-btn v-if="!props.row.restaurado" flat dense no-caps icon="restore" label="Restaurar" color="primary" @click="restaurar(props.row)"></q-btn>
                        </div>
                    </q-card>
                </div>
            </template>
        </q-table>
    </q-card>

    <q-dialog v-model="detalle.ver">
        <q-card style="width:760px;max-width:95vw">
            <q-card-section class="row items-center q-pb-none">
                <div class="text-subtitle1 text-weight-medium col">{{ detalle.titulo }}</div>
                <q-btn flat round dense icon="close" v-close-popup></q-btn>
            </q-card-section>
            <q-card-section style="max-height:70vh;overflow:auto">
                <q-inner-loading :showing="detalle.cargando"></q-inner-loading>
                <div v-for="(g, i) in detalle.grupos" :key="i" class="q-mb-md">
                    <div class="text-caption text-weight-bold text-primary q-mb-xs">
                        {{ etiqueta(g.tabla) }} <span class="text-grey-6">({{ g.filas.length }})</span>
                        <span v-if="g.nivel > 0" class="text-grey-6"> · eliminado en cascada</span>
                    </div>
                    <q-markup-table flat bordered dense separator="cell" class="text-caption" style="overflow:auto">
                        <thead><tr><th v-for="c in columnasDe(g)" :key="c" class="text-left">{{ c }}</th></tr></thead>
                        <tbody>
                            <tr v-for="(f, j) in g.filas.slice(0, 20)" :key="j">
                                <td v-for="c in columnasDe(g)" :key="c" style="max-width:220px" class="ellipsis">{{ f[c] }}</td>
                            </tr>
                        </tbody>
                    </q-markup-table>
                    <div v-if="g.filas.length > 20" class="text-grey-6 text-caption q-mt-xs">… y {{ g.filas.length - 20 }} más</div>
                </div>
            </q-card-section>
        </q-card>
    </q-dialog>
</q-page>`,
    data: function () {
        return {
            search: '',
            estado: 'pendientes',
            rows: [],
            cargando: false,
            pagination: { page: 1, rowsPerPage: 20, rowsNumber: 0 },
            columns: [
                { name: 'fecha', label: 'Eliminado', field: 'fecha', align: 'left', style: 'width:130px' },
                { name: 'descripcion', label: 'Registro', field: 'descripcion', align: 'left' },
                { name: 'usuario', label: 'Por', field: 'usuario', align: 'left' },
                { name: 'estado', label: 'Estado', field: 'restaurado', align: 'left' },
                { name: 'acciones', label: '', field: 'idpapelera', align: 'right' }
            ],
            detalle: { ver: false, cargando: false, titulo: '', grupos: [] }
        };
    },
    mounted: function () {
        this.onRequest({ pagination: this.pagination });
    },
    methods: {
        etiqueta: function (t) {
            var nombres = {
                paciente: 'Paciente', events: 'Reserva', historial: 'Historial', cotizacion: 'Cotización', montos: 'Pagos',
                usuario: 'Usuario', producto: 'Producto', tratamiento: 'Tratamiento', tipotratamiento: 'Tipo de tratamiento',
                reactivo: 'Reactivo', indicaciones: 'Indicación', consentimiento: 'Consentimiento', soap: 'SOAP',
                dosificacion: 'Dosificación', egreso: 'Egresos', ingreso: 'Ingresos', detallefactura: 'Detalle de factura',
                cotizaciontratamiento: 'Tratamientos de la cotización', cotizacionconsetimeinto: 'Consentimientos de la cotización'
            };
            return nombres[t] || t;
        },
        columnasDe: function (g) {
            return g.filas.length ? Object.keys(g.filas[0]) : [];
        },
        buscar: function () {
            this.onRequest({ pagination: Object.assign({}, this.pagination, { page: 1 }) });
        },
        onRequest: function (props) {
            var vm = this;
            var p = props.pagination;
            vm.cargando = true;
            api('Eliminados/lista', { search: vm.search || '', estado: vm.estado, page: p.page, per: p.rowsPerPage }, 'GET').then(function (r) {
                vm.rows = r.rows;
                vm.pagination = Object.assign({}, p, { rowsNumber: r.total });
            }).catch(function (e) {
                vm.$q.notify({ type: 'negative', message: e.message });
            }).finally(function () {
                vm.cargando = false;
            });
        },
        ver: function (row) {
            var vm = this;
            vm.detalle = { ver: true, cargando: true, titulo: row.descripcion, grupos: [] };
            api('Eliminados/detalle/' + row.idpapelera).then(function (r) {
                vm.detalle.grupos = r.grupos.slice().sort(function (a, b) { return a.nivel - b.nivel; });
            }).catch(function (e) {
                vm.$q.notify({ type: 'negative', message: e.message });
            }).finally(function () {
                vm.detalle.cargando = false;
            });
        },
        restaurar: function (row) {
            var vm = this;
            vm.$q.dialog({
                title: 'Restaurar',
                message: '¿Restaurar "' + row.descripcion + '" (' + row.filas + ' registro(s))?',
                cancel: { flat: true, label: 'Cancelar', color: 'grey-8', noCaps: true },
                ok: { unelevated: true, label: 'Restaurar', color: 'primary', noCaps: true }
            }).onOk(function () {
                api('Eliminados/restaurar', { id: row.idpapelera }).then(function () {
                    vm.$q.notify({ type: 'positive', message: 'Restaurado correctamente' });
                    vm.onRequest({ pagination: vm.pagination });
                }).catch(function (e) {
                    vm.$q.notify({ type: 'negative', message: e.message, timeout: 5000 });
                });
            });
        }
    }
};

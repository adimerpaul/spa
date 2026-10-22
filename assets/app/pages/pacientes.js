window.Pages = window.Pages || {};

Pages.Pacientes = {
    template: `
<q-page class="q-pa-md">
    <div class="row items-center q-col-gutter-sm q-mb-md">
        <div class="col-12 col-sm">
            <h1 class="page-title">Pacientes</h1>
            <div class="page-sub">{{ formato(pagination.rowsNumber) }} registrados</div>
        </div>
        <div class="col-12 col-sm-auto row no-wrap q-gutter-sm">
            <q-input v-model="search" dense outlined clearable debounce="300" placeholder="Buscar nombre, CI, celular, zona..."
                     class="col bg-white" style="min-width:260px" @update:model-value="buscar">
                <template v-slot:prepend><q-icon name="search"></q-icon></template>
            </q-input>
            <q-btn unelevated color="primary" icon="person_add" :label="$q.screen.gt.xs ? 'Nuevo paciente' : ''" no-caps @click="nuevo"></q-btn>
        </div>
    </div>

    <q-card flat class="card">
        <q-table
            class="tabla-pacientes"
            flat
            :rows="rows"
            :columns="columns"
            row-key="idpaciente"
            v-model:pagination="pagination"
            :rows-per-page-options="[15, 30, 50, 100]"
            :loading="cargando"
            :grid="$q.screen.xs"
            binary-state-sort
            @request="onRequest"
            no-data-label="No se encontraron pacientes"
            rows-per-page-label="Filas por página"
        >
            <template v-slot:body-cell-nombre="props">
                <q-td :props="props">
                    <div class="row items-center no-wrap">
                        <q-avatar size="34px" :style="{ background: color(props.row.idpaciente) }" text-color="white" class="q-mr-sm text-weight-medium">
                            {{ iniciales(props.row) }}
                        </q-avatar>
                        <div>
                            <div class="text-weight-medium">{{ props.row.nombres }} {{ props.row.apellidos }}</div>
                            <div class="text-grey-6" style="font-size:12px">CI {{ props.row.ci || '—' }}</div>
                        </div>
                    </div>
                </q-td>
            </template>

            <template v-slot:body-cell-celular="props">
                <q-td :props="props">
                    <a v-if="props.row.celular" :href="whatsapp(props.row.celular)" target="_blank" class="text-positive" style="text-decoration:none">
                        <q-icon name="chat" size="16px"></q-icon> {{ props.row.celular }}
                    </a>
                    <span v-else class="text-grey-5">—</span>
                </q-td>
            </template>

            <template v-slot:body-cell-acciones="props">
                <q-td :props="props" auto-width>
                    <q-btn flat dense round color="primary" icon="note_add" :to="'/m/Paciente/reghistorial/' + props.row.idpaciente">
                        <q-tooltip>Registrar historial</q-tooltip>
                    </q-btn>
                    <q-btn flat dense round color="secondary" icon="folder_open" :to="'/m/Paciente/escoger/' + props.row.idpaciente">
                        <q-tooltip>Historiales</q-tooltip>
                    </q-btn>
                    <q-btn flat dense round color="primary" icon="edit" @click="editar(props.row)">
                        <q-tooltip>Modificar datos</q-tooltip>
                    </q-btn>
                    <q-btn flat dense round icon="more_vert" color="grey-7">
                        <q-menu auto-close>
                            <q-list style="min-width:190px">
                                <q-item clickable @click="tomarFoto(props.row)">
                                    <q-item-section avatar><q-icon name="photo_camera" color="primary"></q-icon></q-item-section>
                                    <q-item-section>Tomar fotografía</q-item-section>
                                </q-item>
                                <q-item clickable :to="'/pacientes/' + props.row.idpaciente + '/fotos'">
                                    <q-item-section avatar><q-icon name="photo_library" color="primary"></q-icon></q-item-section>
                                    <q-item-section>Ver fotografías</q-item-section>
                                </q-item>
                                <template v-if="puedeEliminar">
                                    <q-separator></q-separator>
                                    <q-item clickable @click="eliminar(props.row)">
                                        <q-item-section avatar><q-icon name="delete" color="negative"></q-icon></q-item-section>
                                        <q-item-section class="text-negative">Eliminar</q-item-section>
                                    </q-item>
                                </template>
                            </q-list>
                        </q-menu>
                    </q-btn>
                </q-td>
            </template>

            <!-- Vista de tarjetas en celular -->
            <template v-slot:item="props">
                <div class="col-12 q-pa-xs">
                    <q-card flat bordered class="q-pa-sm" style="border-radius:12px">
                        <div class="row items-center no-wrap">
                            <q-avatar size="40px" :style="{ background: color(props.row.idpaciente) }" text-color="white" class="q-mr-sm text-weight-medium">
                                {{ iniciales(props.row) }}
                            </q-avatar>
                            <div class="col" style="min-width:0">
                                <div class="text-weight-medium ellipsis">{{ props.row.nombres }} {{ props.row.apellidos }}</div>
                                <div class="text-grey-6 ellipsis" style="font-size:12px">
                                    #{{ props.row.idpaciente }}<span v-if="props.row.edad !== null"> · {{ props.row.edad }} años</span><span v-if="props.row.zona"> · {{ props.row.zona }}</span>
                                </div>
                            </div>
                            <q-btn v-if="props.row.celular" flat round dense color="positive" icon="chat" type="a" target="_blank" :href="whatsapp(props.row.celular)"></q-btn>
                            <q-btn flat round dense icon="more_vert" color="grey-7">
                                <q-menu auto-close>
                                    <q-list style="min-width:190px">
                                        <q-item clickable :to="'/m/Paciente/reghistorial/' + props.row.idpaciente">
                                            <q-item-section avatar><q-icon name="add_circle" color="primary"></q-icon></q-item-section>
                                            <q-item-section>Registrar historial</q-item-section>
                                        </q-item>
                                        <q-item clickable :to="'/m/Paciente/escoger/' + props.row.idpaciente">
                                            <q-item-section avatar><q-icon name="folder_open" color="secondary"></q-icon></q-item-section>
                                            <q-item-section>Historiales</q-item-section>
                                        </q-item>
                                        <q-item clickable @click="editar(props.row)">
                                            <q-item-section avatar><q-icon name="edit" color="primary"></q-icon></q-item-section>
                                            <q-item-section>Modificar datos</q-item-section>
                                        </q-item>
                                        <q-item clickable @click="tomarFoto(props.row)">
                                            <q-item-section avatar><q-icon name="photo_camera" color="primary"></q-icon></q-item-section>
                                            <q-item-section>Tomar fotografía</q-item-section>
                                        </q-item>
                                        <q-item clickable :to="'/pacientes/' + props.row.idpaciente + '/fotos'">
                                            <q-item-section avatar><q-icon name="photo_library" color="primary"></q-icon></q-item-section>
                                            <q-item-section>Ver fotografías</q-item-section>
                                        </q-item>
                                        <q-item v-if="puedeEliminar" clickable @click="eliminar(props.row)">
                                            <q-item-section avatar><q-icon name="delete" color="negative"></q-icon></q-item-section>
                                            <q-item-section class="text-negative">Eliminar</q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-menu>
                            </q-btn>
                        </div>
                    </q-card>
                </div>
            </template>
        </q-table>
    </q-card>

    <!-- Crear / modificar paciente -->
    <q-dialog v-model="dialogo" :maximized="$q.screen.xs" persistent>
        <q-card style="width:720px;max-width:95vw">
            <q-form @submit="guardar">
                <q-card-section class="row items-center q-pb-none">
                    <q-icon :name="form.idpaciente ? 'edit' : 'person_add'" color="primary" size="24px" class="q-mr-sm"></q-icon>
                    <div class="text-h6 col" style="font-size:18px">{{ form.idpaciente ? 'Modificar paciente' : 'Nuevo paciente' }}</div>
                    <q-btn flat round dense icon="close" v-close-popup></q-btn>
                </q-card-section>
                <q-card-section>
                    <div class="row q-col-gutter-md">
                        <q-input class="col-12 col-sm-6" outlined dense v-model="form.nombres" label="Nombres *" :rules="[v => !!v || 'Requerido']" hide-bottom-space autofocus></q-input>
                        <q-input class="col-12 col-sm-6" outlined dense v-model="form.apellidos" label="Apellidos"></q-input>
                        <q-input class="col-12 col-sm-4" outlined dense v-model="form.ci" label="CI"></q-input>
                        <q-input class="col-12 col-sm-4" outlined dense v-model="form.fechanac" type="date" label="Fecha de nacimiento" stack-label></q-input>
                        <q-input class="col-12 col-sm-4" outlined dense v-model="form.referencia" label="Referencia"></q-input>
                        <q-input class="col-12 col-sm-6" outlined dense v-model="form.celular" label="Celular">
                            <template v-slot:prepend><q-icon name="smartphone"></q-icon></template>
                        </q-input>
                        <q-input class="col-12 col-sm-6" outlined dense v-model="form.telefono" label="Teléfono">
                            <template v-slot:prepend><q-icon name="call"></q-icon></template>
                        </q-input>
                        <q-input class="col-12 col-sm-4" outlined dense v-model="form.zona" label="Zona"></q-input>
                        <q-input class="col-12 col-sm-8" outlined dense v-model="form.direccion" label="Dirección"></q-input>
                    </div>
                </q-card-section>
                <q-card-actions align="right" class="q-px-md q-pb-md">
                    <q-btn flat no-caps label="Cancelar" color="grey-8" v-close-popup></q-btn>
                    <q-btn unelevated no-caps type="submit" color="primary" :loading="guardando" :label="form.idpaciente ? 'Guardar cambios' : 'Registrar paciente'"></q-btn>
                </q-card-actions>
            </q-form>
        </q-card>
    </q-dialog>
</q-page>`,
    data: function () {
        return {
            search: '',
            rows: [],
            cargando: false,
            puedeEliminar: false,
            pagination: { sortBy: 'idpaciente', descending: true, page: 1, rowsPerPage: 15, rowsNumber: 0 },
            columns: [
                { name: 'idpaciente', label: '#', field: 'idpaciente', align: 'left', sortable: true, style: 'width:70px' },
                { name: 'nombre', label: 'Paciente', field: 'nombres', align: 'left', sortable: true },
                { name: 'edad', label: 'Edad', field: 'edad', align: 'left', sortable: true, format: function (v) { return v === null ? '—' : v + ' años'; } },
                { name: 'celular', label: 'Celular', field: 'celular', align: 'left' },
                { name: 'zona', label: 'Zona', field: 'zona', align: 'left', sortable: true, classes: 'ellipsis', style: 'max-width:180px' },
                { name: 'acciones', label: '', field: 'idpaciente', align: 'right' }
            ],
            dialogo: false,
            guardando: false,
            form: {}
        };
    },
    mounted: function () {
        this.onRequest({ pagination: this.pagination });
    },
    methods: {
        formato: function (n) {
            return Number(n || 0).toLocaleString('es-BO');
        },
        iniciales: function (p) {
            return ((p.nombres || '').charAt(0) + (p.apellidos || '').charAt(0)).toUpperCase() || '?';
        },
        color: function (id) {
            var colores = ['#5e768a', '#89bcab', '#7399a0', '#c9a96e', '#8e9fb0', '#6fa595'];
            return colores[id % colores.length];
        },
        // Abre la cámara en el mismo clic y luego lleva a sus fotos, donde se sube
        tomarFoto: function (row) {
            FotosPaciente.abrirCamara(row.idpaciente, this.$router, false);
        },
        whatsapp: function (cel) {
            return 'https://wa.me/591' + String(cel).replace(/\D/g, '');
        },
        buscar: function () {
            this.onRequest({ pagination: Object.assign({}, this.pagination, { page: 1 }) });
        },
        onRequest: function (props) {
            var vm = this;
            var p = props.pagination;
            vm.cargando = true;
            api('Paciente/lista', {
                search: vm.search || '',
                page: p.page,
                per: p.rowsPerPage,
                sort: p.sortBy || 'idpaciente',
                desc: p.descending ? 1 : 0
            }, 'GET').then(function (r) {
                vm.rows = r.rows;
                vm.puedeEliminar = r.puedeEliminar;
                vm.pagination = Object.assign({}, p, { rowsNumber: r.total });
            }).catch(function (e) {
                vm.$q.notify({ type: 'negative', message: e.message });
            }).finally(function () {
                vm.cargando = false;
            });
        },
        recargar: function () {
            this.onRequest({ pagination: this.pagination });
        },
        nuevo: function () {
            this.form = { idpaciente: 0, nombres: '', apellidos: '', ci: '', fechanac: '', referencia: '', celular: '', telefono: '', zona: '', direccion: '' };
            this.dialogo = true;
        },
        editar: function (row) {
            this.form = Object.assign({}, row);
            this.dialogo = true;
        },
        guardar: function () {
            var vm = this;
            var datos = Object.assign({}, vm.form);
            delete datos.edad;
            vm.guardando = true;
            api('Paciente/guardar', datos).then(function () {
                vm.$q.notify({ type: 'positive', message: vm.form.idpaciente ? 'Paciente actualizado' : 'Paciente registrado' });
                vm.dialogo = false;
                vm.recargar();
            }).catch(function (e) {
                var msg = /^Error \d+$/.test(e.message) ? 'No se pudo registrar los datos (' + e.message + ')' : e.message;
                vm.$q.notify({ type: 'negative', message: msg });
            }).finally(function () {
                vm.guardando = false;
            });
        },
        eliminar: function (row) {
            var vm = this;
            vm.$q.dialog({
                title: 'Eliminar paciente',
                message: '¿Seguro que deseas eliminar a ' + row.nombres + ' ' + row.apellidos + '? Esta acción no se puede deshacer.',
                cancel: { flat: true, label: 'Cancelar', color: 'grey-8', noCaps: true },
                ok: { unelevated: true, label: 'Eliminar', color: 'negative', noCaps: true },
                persistent: true
            }).onOk(function () {
                api('Paciente/eliminar', { idpaciente: row.idpaciente }).then(function () {
                    vm.$q.notify({ type: 'positive', message: 'Paciente eliminado' });
                    vm.recargar();
                }).catch(function (e) {
                    vm.$q.notify({ type: 'negative', message: e.message });
                });
            });
        }
    }
};

window.Pages = window.Pages || {};

// Fotografías del paciente. La compresión a WebP la hace el servidor (Photo/subir).
window.FotosPaciente = {
    pendientes: null,   // fotos tomadas desde otra pantalla, esperando a subirse

    // Abre la cámara al instante. Debe llamarse dentro del clic (el navegador no deja abrirla después)
    abrirCamara: function (idpaciente, router, multiple) {
        var input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        if (multiple) input.multiple = true;
        else input.setAttribute('capture', 'environment');
        input.style.display = 'none';
        input.addEventListener('change', function () {
            if (input.files.length) {
                FotosPaciente.pendientes = { idpaciente: String(idpaciente), files: Array.prototype.slice.call(input.files) };
                var destino = '/pacientes/' + idpaciente + '/fotos';
                if (router.currentRoute.value.path === destino) window.dispatchEvent(new Event('fotos-pendientes'));
                else router.push(destino);
            }
            input.remove();
        });
        document.body.appendChild(input);
        input.click();
    }
};

Pages.Fotos = {
    template: `
<q-page class="q-pa-md">
    <q-card flat class="card q-mb-md">
        <q-card-section class="row items-center no-wrap q-py-sm">
            <q-btn flat round dense icon="arrow_back" color="primary" to="/pacientes" class="q-mr-sm"></q-btn>
            <q-avatar size="44px" color="primary" text-color="white" class="q-mr-md text-weight-medium gt-xs">{{ iniciales }}</q-avatar>
            <div class="col" style="min-width:0">
                <q-skeleton v-if="!paciente" type="text" width="200px"></q-skeleton>
                <template v-else>
                    <div class="text-weight-bold ellipsis" style="font-size:17px;color:#4a5f71">{{ paciente.nombres }} {{ paciente.apellidos }}</div>
                    <div class="text-grey-7 ellipsis" style="font-size:12px">
                        #{{ paciente.idpaciente }}<span v-if="paciente.ci"> · CI {{ paciente.ci }}</span><span v-if="paciente.edad !== null"> · {{ paciente.edad }} años</span>
                        · {{ fotos.length }} foto(s)
                    </div>
                </template>
            </div>
        </q-card-section>
    </q-card>

    <div class="row q-col-gutter-sm q-mb-md">
        <div class="col-8 col-sm-auto">
            <q-btn unelevated color="primary" icon="photo_camera" label="Tomar foto" no-caps class="full-width" size="md" @click="camara(false)"></q-btn>
        </div>
        <div class="col-4 col-sm-auto">
            <q-btn outline color="primary" icon="collections" :label="$q.screen.gt.xs ? 'Subir desde galería' : 'Galería'" no-caps class="full-width" @click="camara(true)"></q-btn>
        </div>
    </div>

    <!-- Subidas en curso -->
    <q-card v-if="subidas.length" flat class="card q-mb-md">
        <q-list separator dense>
            <q-item v-for="s in subidas" :key="s.key">
                <q-item-section avatar>
                    <q-avatar rounded size="42px"><img :src="s.preview" style="object-fit:cover"></q-avatar>
                </q-item-section>
                <q-item-section>
                    <q-item-label style="font-size:13px">
                        <span v-if="s.estado === 'subiendo'">Subiendo… {{ s.progreso }}%</span>
                        <span v-else-if="s.estado === 'comprimiendo'">Comprimiendo…</span>
                        <span v-else-if="s.estado === 'ok'" class="text-positive">Listo · {{ tam(s.original) }} → {{ tam(s.comprimido) }} ({{ ahorro(s) }}% menos)</span>
                        <span v-else-if="s.estado === 'error'" class="text-negative">{{ s.error }}</span>
                        <span v-else class="text-grey-6">En espera</span>
                    </q-item-label>
                    <q-linear-progress v-if="s.estado === 'subiendo' || s.estado === 'comprimiendo'" :value="s.progreso / 100"
                                       :indeterminate="s.estado === 'comprimiendo'" color="secondary" rounded class="q-mt-xs"></q-linear-progress>
                </q-item-section>
                <q-item-section side>
                    <q-icon v-if="s.estado === 'ok'" name="check_circle" color="positive"></q-icon>
                    <q-btn v-else-if="s.estado === 'error'" flat dense round icon="refresh" color="primary" @click="reintentar(s)"><q-tooltip>Reintentar</q-tooltip></q-btn>
                </q-item-section>
            </q-item>
        </q-list>
    </q-card>

    <!-- Galería -->
    <div v-if="cargando && !fotos.length" class="row q-col-gutter-sm">
        <div v-for="n in 6" :key="n" class="col-6 col-sm-4 col-md-3 col-lg-2"><q-skeleton square style="padding-top:100%;border-radius:12px"></q-skeleton></div>
    </div>
    <div v-else-if="!fotos.length && !subidas.length" class="text-center text-grey-6 q-py-xl">
        <q-icon name="photo_library" size="56px" color="grey-5"></q-icon>
        <div class="q-mt-sm">Este paciente aún no tiene fotografías</div>
    </div>
    <div v-else class="row q-col-gutter-sm">
        <div v-for="(f, i) in fotos" :key="f.idphoto" class="col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="foto-thumb" @click="abrir(i)">
                <img v-if="f.url" :src="f.url" loading="lazy" :alt="'Foto ' + f.idphoto">
                <div v-else class="fit flex flex-center text-grey-5"><q-icon name="broken_image" size="32px"></q-icon></div>
                <div class="foto-fecha">{{ f.fecha }}</div>
            </div>
        </div>
    </div>

    <!-- Visor -->
    <q-dialog v-model="visor.ver" maximized transition-show="fade" transition-hide="fade">
        <q-card class="bg-black text-white column no-wrap">
            <q-bar class="bg-transparent" style="height:48px">
                <div class="ellipsis" style="font-size:13px">{{ actual && actual.fecha }} · {{ visor.i + 1 }} / {{ fotos.length }}</div>
                <q-space></q-space>
                <q-btn dense flat round icon="download" :href="actual && actual.url" :download="actual && ('foto-' + actual.idphoto)" type="a"><q-tooltip>Descargar</q-tooltip></q-btn>
                <q-btn dense flat round icon="delete" @click="eliminar(actual)"><q-tooltip>Eliminar</q-tooltip></q-btn>
                <q-btn dense flat round icon="close" v-close-popup></q-btn>
            </q-bar>
            <q-carousel v-model="visor.i" swipeable animated arrows navigation-position="bottom" control-color="white"
                        class="col bg-black" transition-prev="slide-right" transition-next="slide-left">
                <q-carousel-slide v-for="(f, i) in fotos" :key="f.idphoto" :name="i" class="flex flex-center q-pa-none">
                    <img v-if="f.url" :src="f.url" style="max-width:100%;max-height:100%;object-fit:contain">
                </q-carousel-slide>
            </q-carousel>
        </q-card>
    </q-dialog>
</q-page>`,
    data: function () {
        return { paciente: null, fotos: [], cargando: false, subidas: [], visor: { ver: false, i: 0 } };
    },
    computed: {
        id: function () { return this.$route.params.id; },
        iniciales: function () {
            var p = this.paciente;
            return p ? ((p.nombres || '').charAt(0) + (p.apellidos || '').charAt(0)).toUpperCase() : '';
        },
        actual: function () { return this.fotos[this.visor.i]; }
    },
    mounted: function () {
        this.cargar();
        this.tomarPendientes();
        this._onPend = this.tomarPendientes.bind(this);
        window.addEventListener('fotos-pendientes', this._onPend);
    },
    beforeUnmount: function () {
        window.removeEventListener('fotos-pendientes', this._onPend);
        this.subidas.forEach(function (s) { URL.revokeObjectURL(s.preview); });
    },
    methods: {
        tam: function (b) {
            return b >= 1048576 ? (b / 1048576).toFixed(1) + ' MB' : Math.round(b / 1024) + ' KB';
        },
        ahorro: function (s) {
            return Math.max(0, Math.round(100 - s.comprimido * 100 / s.original));
        },
        cargar: function () {
            var vm = this;
            vm.cargando = true;
            return api('Photo/datos/' + vm.id).then(function (r) {
                vm.paciente = r.paciente;
                vm.fotos = r.fotos;
            }).catch(function (e) {
                vm.$q.notify({ type: 'negative', message: e.message });
            }).finally(function () {
                vm.cargando = false;
            });
        },
        camara: function (multiple) {
            FotosPaciente.abrirCamara(this.id, this.$router, multiple);
        },
        tomarPendientes: function () {
            var p = FotosPaciente.pendientes;
            if (!p || p.idpaciente !== String(this.id)) return;
            FotosPaciente.pendientes = null;
            var vm = this;
            p.files.forEach(function (file, n) {
                vm.subidas.unshift({ key: Date.now() + '-' + n, file: file, preview: URL.createObjectURL(file), estado: 'espera', progreso: 0 });
            });
            vm.siguiente();
        },
        // Sube una por una para no saturar la conexión del celular
        siguiente: function () {
            var vm = this;
            if (vm.subidas.some(function (s) { return s.estado === 'subiendo' || s.estado === 'comprimiendo'; })) return;
            var s = vm.subidas.slice().reverse().find(function (x) { return x.estado === 'espera'; });
            if (!s) return;

            s.estado = 'subiendo';
            var fd = new FormData();
            fd.append('idpaciente', vm.id);
            fd.append('foto', s.file, s.file.name || 'foto.jpg');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', APP.base + 'Photo/subir');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) s.progreso = Math.round(e.loaded * 100 / e.total);
                if (s.progreso >= 100) s.estado = 'comprimiendo';
            };
            xhr.onload = function () {
                var r = {};
                try { r = JSON.parse(xhr.responseText); } catch (e) {}
                if (xhr.status === 401) { location.href = APP.base; return; }
                if (xhr.status >= 200 && xhr.status < 300) {
                    s.estado = 'ok';
                    s.original = r.original;
                    s.comprimido = r.comprimido;
                    vm.cargar();
                    // Las subidas correctas se quitan de la lista después de unos segundos
                    setTimeout(function () {
                        var i = vm.subidas.indexOf(s);
                        if (i >= 0 && s.estado === 'ok') { URL.revokeObjectURL(s.preview); vm.subidas.splice(i, 1); }
                    }, 4000);
                } else {
                    s.estado = 'error';
                    s.error = r.error || ('Error ' + xhr.status + ' al subir');
                }
                vm.siguiente();
            };
            xhr.onerror = function () {
                s.estado = 'error';
                s.error = 'Sin conexión. Toca reintentar.';
                vm.siguiente();
            };
            xhr.send(fd);
        },
        reintentar: function (s) {
            s.estado = 'espera';
            s.progreso = 0;
            this.siguiente();
        },
        abrir: function (i) {
            this.visor = { ver: true, i: i };
        },
        eliminar: function (f) {
            var vm = this;
            vm.$q.dialog({
                title: 'Eliminar fotografía',
                message: 'La foto irá a la papelera (se puede restaurar).',
                cancel: { flat: true, label: 'Cancelar', color: 'grey-8', noCaps: true },
                ok: { unelevated: true, label: 'Eliminar', color: 'negative', noCaps: true }
            }).onOk(function () {
                api('Photo/eliminar', { idphoto: f.idphoto, idpaciente: vm.id }).then(function () {
                    vm.$q.notify({ type: 'positive', message: 'Foto eliminada' });
                    if (vm.fotos.length <= 1) vm.visor.ver = false;
                    else if (vm.visor.i >= vm.fotos.length - 1) vm.visor.i--;
                    vm.cargar();
                }).catch(function (e) {
                    vm.$q.notify({ type: 'negative', message: e.message });
                });
            });
        }
    }
};

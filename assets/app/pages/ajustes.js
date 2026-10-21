window.Pages = window.Pages || {};

// Ajustes del sistema: logo que sale en el login, el menú y los PDF (consentimientos, reporte diario...)
Pages.Ajustes = {
    template: `
<q-page class="q-pa-md">
    <div class="q-mb-md">
        <h1 class="page-title">Ajustes</h1>
        <div class="page-sub">Configuración general del sistema</div>
    </div>

    <q-card flat class="card" style="max-width:640px">
        <q-card-section>
            <div class="text-subtitle1 text-weight-medium">Logo</div>
            <div class="page-sub">Se muestra en el login, en el menú y en los PDF de impresión (consentimientos, reporte diario, recetas...).</div>
        </q-card-section>
        <q-card-section class="row q-col-gutter-md items-center">
            <div class="col-12 col-sm-6">
                <div class="flex flex-center bg-white q-pa-md" style="border:1px dashed #cfd8dd;border-radius:12px;height:180px">
                    <q-spinner v-if="cargando" color="primary" size="32px"></q-spinner>
                    <img v-else :src="logo" alt="Logo" style="max-width:100%;max-height:100%;object-fit:contain">
                </div>
                <div class="text-caption text-grey-6 q-mt-xs text-center">
                    {{ porDefecto ? 'Logo por defecto' : 'Logo personalizado' }}
                </div>
            </div>
            <div class="col-12 col-sm-6 column q-gutter-sm">
                <q-file v-model="archivo" outlined dense accept="image/png,image/jpeg,image/gif,image/webp" max-file-size="5242880"
                        label="Elegir imagen" @rejected="rechazado">
                    <template v-slot:prepend><q-icon name="image"></q-icon></template>
                </q-file>
                <q-btn unelevated no-caps color="primary" icon="upload" label="Subir logo" :disable="!archivo" :loading="subiendo" @click="subir"></q-btn>
                <q-btn flat no-caps color="grey-8" icon="restart_alt" label="Restablecer logo por defecto" :disable="porDefecto" @click="restablecer"></q-btn>
                <div class="text-caption text-grey-6">PNG, JPG, GIF o WEBP de hasta 5 MB. La transparencia se cambia por fondo blanco.</div>
            </div>
        </q-card-section>
    </q-card>
</q-page>`,
    data: function () {
        return { cargando: true, subiendo: false, logo: '', porDefecto: true, archivo: null };
    },
    mounted: function () {
        var vm = this;
        api('Ajustes/datos', null, 'GET').then(vm.aplicar).catch(function (e) {
            vm.$q.notify({ type: 'negative', message: e.message });
        }).finally(function () { vm.cargando = false; });
    },
    methods: {
        aplicar: function (d) {
            this.logo = d.logo;
            this.porDefecto = d.porDefecto;
            this.$root.logo = d.logo;
        },
        rechazado: function () {
            this.$q.notify({ type: 'negative', message: 'La imagen no debe pasar de 5 MB' });
        },
        subir: function () {
            var vm = this;
            vm.subiendo = true;
            api('Ajustes/logo', { logo: vm.archivo }).then(function (d) {
                vm.aplicar(d);
                vm.archivo = null;
                vm.$q.notify({ type: 'positive', message: 'Logo actualizado' });
            }).catch(function (e) {
                vm.$q.notify({ type: 'negative', message: e.message });
            }).finally(function () { vm.subiendo = false; });
        },
        restablecer: function () {
            var vm = this;
            vm.$q.dialog({ title: 'Restablecer logo', message: '¿Volver al logo por defecto?', cancel: { flat: true, label: 'Cancelar' }, ok: { label: 'Restablecer', unelevated: true } })
                .onOk(function () {
                    api('Ajustes/restablecer', {}).then(function (d) {
                        vm.aplicar(d);
                        vm.$q.notify({ type: 'positive', message: 'Se restableció el logo por defecto' });
                    }).catch(function (e) {
                        vm.$q.notify({ type: 'negative', message: e.message });
                    });
                });
        }
    }
};

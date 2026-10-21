window.Pages = window.Pages || {};

// Muestra un módulo antiguo (aún no migrado a Vue) dentro del layout, sin su menú propio.
// Ruta: /m/<Controlador>/<metodo>/<params>  →  iframe a base_url + ruta
Pages.Legacy = {
    template: `
<q-page>
    <q-linear-progress v-if="cargando" indeterminate color="secondary" size="3px" class="absolute-top" style="z-index:1"></q-linear-progress>
    <iframe ref="frame" class="legacy-frame" :src="src" @load="onLoad"></iframe>

    <q-dialog v-model="pdf.ver" maximized transition-show="slide-up" transition-hide="slide-down">
        <q-card class="column no-wrap" style="background:#525659">
            <q-bar class="bg-primary text-white" style="height:44px">
                <q-icon name="picture_as_pdf"></q-icon>
                <div class="q-ml-sm">Vista de impresión</div>
                <q-space></q-space>
                <q-btn dense flat icon="open_in_new" :href="pdf.url" target="_blank"><q-tooltip>Abrir en otra pestaña</q-tooltip></q-btn>
                <q-btn dense flat icon="close" v-close-popup><q-tooltip>Cerrar</q-tooltip></q-btn>
            </q-bar>
            <iframe v-if="pdf.url" :src="pdf.url" class="col" style="border:0;width:100%"></iframe>
        </q-card>
    </q-dialog>
</q-page>`,
    data: function () {
        return { cargando: true, cargas: 0, pdf: { ver: false, url: '' } };
    },
    computed: {
        src: function () {
            var q = this.$route.fullPath.split('?')[1];
            return APP.base + this.$route.params.ruta + (q ? '?' + q : '');
        }
    },
    methods: {
        onLoad: function () {
            this.cargando = false;
            this.cargas++;
            try {
                var w = this.$refs.frame.contentWindow;
                // Si la sesión expiró, el módulo redirige al login: sacarlo del iframe
                if (w.document.getElementById('loginForm')) location.href = APP.base;
                // Si el módulo abrió un PDF (Imprimir, Ver...), mostrarlo en un diálogo y volver a la página anterior
                if (w.document.contentType === 'application/pdf') {
                    this.pdf.url = w.location.href;
                    this.pdf.ver = true;
                    if (this.cargas > 1) w.history.back();
                }
            } catch (e) {}
        }
    }
};

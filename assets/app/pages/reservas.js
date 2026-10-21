window.Pages = window.Pages || {};

// Agenda de reservas: calendario FullCalendar + formulario con buscador de pacientes
Pages.Reservas = {
    template: `
<q-page class="q-pa-md">
    <div class="row items-center q-col-gutter-sm q-mb-md">
        <div class="col-12 col-sm">
            <h1 class="page-title">Reservas</h1>
            <div class="page-sub">{{ rango }}</div>
        </div>
        <div class="col-12 col-sm-auto row no-wrap q-gutter-sm">
            <q-input v-model="filtro" dense outlined clearable debounce="250" placeholder="Filtrar por paciente o descripción..."
                     class="col bg-white" style="min-width:260px" @update:model-value="aplicarFiltro">
                <template v-slot:prepend><q-icon name="search"></q-icon></template>
            </q-input>
            <q-btn flat round icon="refresh" color="primary" :loading="cargando" @click="recargar"><q-tooltip>Actualizar</q-tooltip></q-btn>
            <q-btn unelevated color="primary" icon="add" :label="$q.screen.gt.xs ? 'Nueva reserva' : ''" no-caps @click="nueva()"></q-btn>
        </div>
    </div>

    <div class="row q-col-gutter-md">
        <!-- Agenda del día seleccionado -->
        <div class="col-12 col-md-3 gt-sm">
            <q-card flat class="card">
                <q-card-section class="row items-center q-pb-sm">
                    <q-icon name="today" color="primary" size="22px" class="q-mr-sm"></q-icon>
                    <div class="col">
                        <div class="text-subtitle2 text-weight-medium">{{ diaTitulo }}</div>
                        <div class="text-grey-6" style="font-size:12px">{{ delDia.length }} reserva(s)</div>
                    </div>
                </q-card-section>
                <q-separator></q-separator>
                <q-list separator v-if="delDia.length" style="max-height:calc(100vh - 260px);overflow:auto">
                    <q-item v-for="e in delDia" :key="e.id" clickable @click="editar(e)">
                        <q-item-section avatar>
                            <q-chip dense square class="text-weight-medium" :style="chipEstilo(e)">{{ hora(e.start) }}</q-chip>
                        </q-item-section>
                        <q-item-section>
                            <q-item-label class="ellipsis text-weight-medium">{{ e.title }}</q-item-label>
                            <q-item-label caption class="ellipsis">{{ e.descripcion || 'Sin descripción' }}</q-item-label>
                        </q-item-section>
                    </q-item>
                </q-list>
                <div v-else class="q-pa-lg text-center text-grey-6">
                    <q-icon name="event_available" size="40px" class="q-mb-sm"></q-icon>
                    <div style="font-size:13px">Sin reservas este día</div>
                    <q-btn flat dense no-caps color="primary" label="Agendar" icon="add" class="q-mt-sm" @click="nueva(dia)"></q-btn>
                </div>
            </q-card>
        </div>

        <div class="col-12 col-md-9">
            <q-card flat class="card q-pa-sm reservas-cal">
                <div ref="cal"></div>
            </q-card>
        </div>
    </div>

    <!-- Crear / modificar reserva -->
    <q-dialog v-model="dialogo" :maximized="$q.screen.xs" persistent>
        <q-card style="width:620px;max-width:95vw">
            <q-form @submit="guardar">
                <q-card-section class="row items-center q-pb-none">
                    <q-icon :name="form.id ? 'edit_calendar' : 'event'" color="primary" size="24px" class="q-mr-sm"></q-icon>
                    <div class="text-h6 col" style="font-size:18px">{{ form.id ? 'Modificar reserva' : 'Nueva reserva' }}</div>
                    <q-btn flat round dense icon="close" v-close-popup></q-btn>
                </q-card-section>

                <q-card-section class="q-gutter-y-md">
                    <!-- Paciente: escribir para buscar -->
                    <div v-if="!nuevoPaciente">
                        <q-select ref="selPaciente" outlined dense v-model="paciente" :options="opciones" option-label="label"
                                  use-input hide-selected fill-input input-debounce="300" clearable
                                  label="Paciente *" placeholder="Escribe nombre, CI o celular..."
                                  :loading="buscando" @filter="buscarPaciente" @input-value="v => texto = v"
                                  :rules="[v => !!v || 'Selecciona un paciente']" hide-bottom-space>
                            <template v-slot:prepend><q-icon name="person_search"></q-icon></template>
                            <template v-slot:option="scope">
                                <q-item v-bind="scope.itemProps">
                                    <q-item-section avatar>
                                        <q-avatar size="32px" :style="{ background: color(scope.opt.idpaciente) }" text-color="white">{{ iniciales(scope.opt) }}</q-avatar>
                                    </q-item-section>
                                    <q-item-section>
                                        <q-item-label>{{ scope.opt.label }}</q-item-label>
                                        <q-item-label caption>
                                            #{{ scope.opt.idpaciente }}<span v-if="scope.opt.ci"> · CI {{ scope.opt.ci }}</span><span v-if="scope.opt.celular"> · {{ scope.opt.celular }}</span>
                                        </q-item-label>
                                    </q-item-section>
                                </q-item>
                            </template>
                            <template v-slot:no-option>
                                <q-item>
                                    <q-item-section class="text-grey-7">{{ texto && texto.length >= 2 ? 'Sin coincidencias' : 'Escribe al menos 2 letras' }}</q-item-section>
                                </q-item>
                                <q-item v-if="texto && texto.length >= 2" clickable @click="registrarNuevo">
                                    <q-item-section avatar><q-icon name="person_add" color="primary"></q-icon></q-item-section>
                                    <q-item-section class="text-primary">Registrar «{{ texto }}» como paciente nuevo</q-item-section>
                                </q-item>
                            </template>
                        </q-select>
                        <div class="row items-center q-mt-xs" style="min-height:24px">
                            <a v-if="paciente && paciente.celular" :href="whatsapp(paciente.celular, form)" target="_blank" class="text-positive" style="text-decoration:none;font-size:13px">
                                <q-icon name="chat" size="16px"></q-icon> WhatsApp {{ paciente.celular }}
                            </a>
                            <q-space></q-space>
                            <q-btn v-if="!form.id" flat dense no-caps size="sm" color="primary" icon="person_add" label="Paciente nuevo" @click="registrarNuevo"></q-btn>
                        </div>
                    </div>

                    <div v-else>
                        <div class="row items-center q-mb-sm">
                            <q-icon name="person_add" color="primary" class="q-mr-xs"></q-icon>
                            <div class="text-weight-medium col" style="font-size:13px">Paciente nuevo</div>
                            <q-btn flat dense no-caps size="sm" color="primary" icon="person_search" label="Buscar existente" @click="nuevoPaciente = false"></q-btn>
                        </div>
                        <div class="row q-col-gutter-sm">
                            <q-input class="col-12 col-sm-6" outlined dense v-model="form.nombres" label="Nombres *" autofocus :rules="[v => !!v || 'Requerido']" hide-bottom-space></q-input>
                            <q-input class="col-12 col-sm-6" outlined dense v-model="form.apellidos" label="Apellidos"></q-input>
                            <q-input class="col-12" outlined dense v-model="form.celular" label="Celular">
                                <template v-slot:prepend><q-icon name="smartphone"></q-icon></template>
                            </q-input>
                        </div>
                    </div>

                    <!-- Fecha, hora y duración -->
                    <div class="row q-col-gutter-sm">
                        <q-input class="col-7" outlined dense type="date" v-model="form.fecha" label="Fecha *" stack-label :rules="[v => !!v || 'Requerido']" hide-bottom-space></q-input>
                        <q-input class="col-5" outlined dense type="time" step="900" v-model="form.hora" label="Hora *" stack-label :rules="[v => !!v || 'Requerido']" hide-bottom-space></q-input>
                    </div>
                    <div>
                        <div class="text-grey-7 q-mb-xs" style="font-size:12px">Duración · termina a las {{ horaFin }}</div>
                        <q-btn-toggle v-model="form.duracion" no-caps unelevated dense spread toggle-color="primary" color="blue-grey-1" text-color="primary"
                                      :options="duraciones" class="duraciones"></q-btn-toggle>
                    </div>

                    <div>
                        <q-input outlined dense v-model="form.descripcion" label="Descripción / tratamiento" autogrow>
                            <template v-slot:prepend><q-icon name="spa"></q-icon></template>
                        </q-input>
                        <div v-if="frecuentes.length" class="q-mt-xs">
                            <q-chip v-for="f in frecuentes" :key="f" dense clickable size="sm" color="blue-grey-1" text-color="primary" @click="form.descripcion = f">{{ f }}</q-chip>
                        </div>
                    </div>

                    <!-- Indicaciones para imprimir (solo reservas existentes) -->
                    <div v-if="form.id && indicaciones.length" class="row no-wrap items-center q-gutter-sm">
                        <q-select class="col" outlined dense v-model="indicacion" :options="indicaciones" option-value="idindicaciones" option-label="titulo"
                                  emit-value map-options clearable label="Indicaciones para imprimir">
                            <template v-slot:prepend><q-icon name="list_alt"></q-icon></template>
                        </q-select>
                        <q-btn flat round color="primary" icon="print" :disable="!indicacion" type="a" target="_blank" :href="urlImprimir"><q-tooltip>Imprimir</q-tooltip></q-btn>
                    </div>
                </q-card-section>

                <q-card-actions class="q-px-md q-pb-md">
                    <q-btn v-if="form.id" flat no-caps color="negative" icon="delete" label="Eliminar" @click="eliminar"></q-btn>
                    <q-space></q-space>
                    <q-btn flat no-caps label="Cancelar" color="grey-8" v-close-popup></q-btn>
                    <q-btn unelevated no-caps type="submit" color="primary" :loading="guardando" :label="form.id ? 'Guardar cambios' : 'Agendar'"></q-btn>
                </q-card-actions>
            </q-form>
        </q-card>
    </q-dialog>
</q-page>`,
    data: function () {
        return {
            filtro: '',
            cargando: false,
            rango: '',
            eventos: [],
            dia: new Date(),
            dialogo: false,
            guardando: false,
            form: {},
            paciente: null,
            nuevoPaciente: false,
            opciones: [],
            texto: '',
            buscando: false,
            frecuentes: [],
            indicaciones: [],
            indicacion: null,
            duraciones: [15, 30, 45, 60, 90, 120].map(function (m) {
                return { label: m < 60 ? m + ' min' : Math.floor(m / 60) + ' h' + (m % 60 ? ' ' + (m % 60) : ''), value: m };
            })
        };
    },
    computed: {
        delDia: function () {
            var d = this.ymd(this.dia);
            var vm = this;
            return this.eventos.filter(function (e) { return e.start.slice(0, 10) === d && vm.coincide(e); });
        },
        diaTitulo: function () {
            var t = this.dia.toLocaleDateString('es-BO', { weekday: 'long', day: 'numeric', month: 'long' });
            return t.charAt(0).toUpperCase() + t.slice(1);
        },
        horaFin: function () {
            if (!this.form.hora) return '—';
            var p = this.form.hora.split(':');
            var m = (+p[0]) * 60 + (+p[1]) + (this.form.duracion || 0);
            return this.pad(Math.floor(m / 60) % 24) + ':' + this.pad(m % 60);
        },
        urlImprimir: function () {
            if (!this.indicacion || !this.form.id) return '';
            return APP.base + 'Reserva/imprimir/' + this.indicacion + '/' + this.form.idpaciente + '/' + this.form.fecha + 'T' + this.form.hora;
        }
    },
    mounted: function () {
        var vm = this;
        api('Reserva/opciones', null, 'GET').then(function (r) {
            vm.frecuentes = r.frecuentes;
            vm.indicaciones = r.indicaciones;
        }).catch(function () {});
        if (!window.FullCalendar) {
            vm.$q.notify({ type: 'negative', message: 'No se pudo cargar el calendario' });
            return;
        }
        var movil = vm.$q.screen.lt.md;
        vm.cal = new FullCalendar.Calendar(vm.$refs.cal, {
            locale: 'es',
            initialView: movil ? 'listWeek' : 'timeGridWeek',
            headerToolbar: movil
                ? { left: 'prev,next', center: 'title', right: 'today' }
                : { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' },
            footerToolbar: movil ? { center: 'listWeek,timeGridDay,dayGridMonth' } : false,
            buttonText: { today: 'Hoy', month: 'Mes', week: 'Semana', day: 'Día', list: 'Lista' },
            height: movil ? 'auto' : 'calc(100vh - 175px)',
            slotMinTime: '08:00:00',
            slotMaxTime: '22:00:00',
            slotDuration: '00:15:00',
            slotLabelInterval: '01:00',
            slotLabelFormat: { hour: '2-digit', minute: '2-digit', hour12: false },
            eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false },
            allDaySlot: false,
            nowIndicator: true,
            selectable: true,
            selectMirror: true,
            editable: true,
            dayMaxEvents: 4,
            expandRows: true,
            stickyHeaderDates: true,
            events: function (info, ok, fail) { vm.cargar(info, ok, fail); },
            eventDataTransform: function (e) {
                return { id: e.id, title: e.title, start: e.start, end: e.end, color: vm.colorEvento(e), extendedProps: e };
            },
            eventContent: function (arg) {
                if (arg.view.type.indexOf('timeGrid') !== 0) return;
                var p = arg.event.extendedProps;
                var html = '<div class="ev"><b>' + arg.timeText + '</b> ' + vm.escape(arg.event.title) +
                    (p.descripcion ? '<div class="ev-desc">' + vm.escape(p.descripcion) + '</div>' : '') + '</div>';
                return { html: html };
            },
            eventDidMount: function (arg) {
                var p = arg.event.extendedProps;
                arg.el.title = arg.event.title + (p.descripcion ? ' — ' + p.descripcion : '') + (p.usuario ? '\nRegistró: ' + p.usuario : '');
            },
            datesSet: function (info) {
                vm.rango = info.view.title;
                var hoy = new Date();
                vm.dia = (hoy >= info.start && hoy < info.end) ? hoy : info.start;
            },
            dateClick: function (info) { vm.dia = info.date; },
            select: function (info) {
                vm.cal.unselect();
                if (info.view.type === 'dayGridMonth') {
                    vm.dia = info.start;
                    vm.nueva(info.start);
                    return;
                }
                vm.nueva(info.start, Math.max(15, Math.round((info.end - info.start) / 60000)));
            },
            eventClick: function (info) { vm.editar(info.event.extendedProps); },
            eventDrop: function (info) { vm.mover(info); },
            eventResize: function (info) { vm.mover(info); }
        });
        vm.cal.render();
    },
    beforeUnmount: function () {
        if (this.cal) this.cal.destroy();
    },
    methods: {
        pad: function (n) { return String(n).padStart(2, '0'); },
        ymd: function (d) { return d.getFullYear() + '-' + this.pad(d.getMonth() + 1) + '-' + this.pad(d.getDate()); },
        hm: function (d) { return this.pad(d.getHours()) + ':' + this.pad(d.getMinutes()); },
        hora: function (s) { return s.slice(11, 16); },
        escape: function (s) {
            return String(s || '').replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; });
        },
        iniciales: function (p) {
            return ((p.nombres || '').charAt(0) + (p.apellidos || '').charAt(0)).toUpperCase() || (p.label || '?').charAt(0);
        },
        color: function (id) {
            var colores = ['#5e768a', '#89bcab', '#7399a0', '#c9a96e', '#8e9fb0', '#6fa595'];
            return colores[id % colores.length];
        },
        // Color por usuario que registró, para distinguir agendas
        colorEvento: function (e) {
            var colores = ['#5e768a', '#6fa595', '#c9a96e', '#7399a0', '#a07fa8', '#c47f6b', '#5b8fb9'];
            return colores[(+e.idusuario || 0) % colores.length];
        },
        chipEstilo: function (e) {
            return { background: this.colorEvento(e), color: '#fff' };
        },
        whatsapp: function (cel, form) {
            var txt = '';
            if (form && form.fecha && form.hora) {
                var f = new Date(form.fecha + 'T' + form.hora);
                txt = '?text=' + encodeURIComponent('Hola, le recordamos su reserva en Esencia Spa Médico el ' +
                    f.toLocaleDateString('es-BO', { weekday: 'long', day: 'numeric', month: 'long' }) + ' a las ' + form.hora + '.');
            }
            return 'https://wa.me/591' + String(cel).replace(/\D/g, '') + txt;
        },
        coincide: function (e) {
            var f = (this.filtro || '').trim().toLowerCase();
            if (!f) return true;
            return (e.title + ' ' + (e.descripcion || '') + ' ' + (e.celular || '') + ' ' + (e.ci || '')).toLowerCase().indexOf(f) !== -1;
        },

        // ---- Calendario ----
        // Solo consulta al servidor si cambió el rango; el filtro reutiliza lo ya cargado
        cargar: function (info, ok, fail) {
            var vm = this;
            var clave = info.startStr + '|' + info.endStr;
            if (vm._clave === clave) { ok(vm.eventos.filter(vm.coincide)); return; }
            vm.cargando = true;
            api('Reserva/eventos', { start: info.startStr.slice(0, 19), end: info.endStr.slice(0, 19) }, 'GET').then(function (r) {
                vm._clave = clave;
                vm.eventos = r;
                ok(r.filter(vm.coincide));
            }).catch(function (e) {
                vm.$q.notify({ type: 'negative', message: e.message });
                fail(e);
            }).finally(function () {
                vm.cargando = false;
            });
        },
        aplicarFiltro: function () {
            if (this.cal) this.cal.refetchEvents();
        },
        recargar: function () {
            this._clave = null;
            if (this.cal) this.cal.refetchEvents();
        },
        mover: function (info) {
            var vm = this;
            var ev = info.event;
            api('Reserva/mover', {
                id: ev.id,
                start: vm.ymd(ev.start) + ' ' + vm.hm(ev.start),
                end: vm.ymd(ev.end || new Date(ev.start.getTime() + 1800000)) + ' ' + vm.hm(ev.end || new Date(ev.start.getTime() + 1800000))
            }).then(function () {
                vm.$q.notify({ type: 'positive', message: ev.title + ' · ' + vm.hm(ev.start) });
                vm.recargar();
            }).catch(function (e) {
                info.revert();
                vm.$q.notify({ type: 'negative', message: e.message });
            });
        },

        // ---- Formulario ----
        nueva: function (inicio, duracion) {
            var d = inicio ? new Date(inicio) : new Date();
            if (!inicio || (d.getHours() === 0 && d.getMinutes() === 0)) {
                // Sin hora elegida: próxima media hora (o 09:00 si es otro día)
                var esHoy = this.ymd(d) === this.ymd(new Date());
                if (esHoy) { d = new Date(); d.setMinutes(Math.ceil(d.getMinutes() / 30) * 30, 0, 0); }
                else d.setHours(9, 0, 0, 0);
            }
            this.form = { id: 0, idpaciente: 0, nombres: '', apellidos: '', celular: '', descripcion: '',
                fecha: this.ymd(d), hora: this.hm(d), duracion: duracion || 30 };
            this.paciente = null;
            this.nuevoPaciente = false;
            this.opciones = [];
            this.texto = '';
            this.indicacion = null;
            this.dialogo = true;
            var vm = this;
            setTimeout(function () { if (vm.$refs.selPaciente) vm.$refs.selPaciente.focus(); }, 300);
        },
        editar: function (e) {
            var ini = new Date(e.start);
            var fin = new Date(e.end || e.start);
            var dur = Math.max(15, Math.round((fin - ini) / 60000));
            this.form = { id: e.id, idpaciente: e.idpaciente, nombres: '', apellidos: '', celular: '', descripcion: e.descripcion || '',
                fecha: this.ymd(ini), hora: this.hm(ini), duracion: dur };
            if (!this.duraciones.some(function (o) { return o.value === dur; })) {
                this.duraciones = this.duraciones.concat([{ label: dur + ' min', value: dur }]).sort(function (a, b) { return a.value - b.value; });
            }
            this.paciente = { idpaciente: e.idpaciente, label: e.title, celular: e.celular, ci: e.ci };
            this.opciones = [this.paciente];
            this.nuevoPaciente = false;
            this.indicacion = null;
            this.dialogo = true;
        },
        buscarPaciente: function (val, update, abort) {
            var vm = this;
            val = (val || '').trim();
            if (val.length < 2) { update(function () { vm.opciones = []; }); return; }
            vm.buscando = true;
            api('Paciente/lista', { search: val, page: 1, per: 15, sort: 'nombre', desc: 0 }, 'GET').then(function (r) {
                update(function () {
                    vm.opciones = r.rows.map(function (p) {
                        return Object.assign({}, p, { label: (p.nombres + ' ' + (p.apellidos || '')).trim() });
                    });
                });
            }).catch(function (e) {
                abort();
                vm.$q.notify({ type: 'negative', message: e.message });
            }).finally(function () {
                vm.buscando = false;
            });
        },
        registrarNuevo: function () {
            // Usa lo escrito en el buscador: "ROSA QUISPE MAMANI" → nombres ROSA, apellidos QUISPE MAMANI (con 4 palabras, 2 y 2)
            var partes = (this.texto || '').trim().toUpperCase().split(/\s+/).filter(Boolean);
            this.form.nombres = partes.slice(0, partes.length > 3 ? 2 : 1).join(' ');
            this.form.apellidos = partes.slice(partes.length > 3 ? 2 : 1).join(' ');
            this.paciente = null;
            this.nuevoPaciente = true;
            if (this.$refs.selPaciente) this.$refs.selPaciente.hidePopup();
        },
        guardar: function () {
            var vm = this;
            var f = vm.form;
            var ini = new Date(f.fecha + 'T' + f.hora);
            var fin = new Date(ini.getTime() + f.duracion * 60000);
            var datos = {
                id: f.id || '',
                idpaciente: vm.nuevoPaciente ? '' : (vm.paciente ? vm.paciente.idpaciente : ''),
                nombres: vm.nuevoPaciente ? f.nombres : '',
                apellidos: vm.nuevoPaciente ? f.apellidos : '',
                celular: vm.nuevoPaciente ? f.celular : '',
                descripcion: f.descripcion,
                start: vm.ymd(ini) + ' ' + vm.hm(ini),
                end: vm.ymd(fin) + ' ' + vm.hm(fin)
            };
            vm.guardando = true;
            api('Reserva/guardar', datos).then(function () {
                vm.$q.notify({ type: 'positive', message: f.id ? 'Reserva actualizada' : 'Reserva agendada' });
                vm.dialogo = false;
                vm.dia = ini;
                if (f.descripcion && vm.frecuentes.indexOf(f.descripcion.trim()) === -1 && vm.frecuentes.length < 8) vm.frecuentes.push(f.descripcion.trim());
                vm.recargar();
            }).catch(function (e) {
                vm.$q.notify({ type: 'negative', message: e.message });
            }).finally(function () {
                vm.guardando = false;
            });
        },
        eliminar: function () {
            var vm = this;
            var titulo = vm.paciente ? vm.paciente.label : 'esta reserva';
            vm.$q.dialog({
                title: 'Eliminar reserva',
                message: '¿Eliminar la reserva de ' + titulo + ' el ' + vm.form.fecha + ' a las ' + vm.form.hora + '?',
                cancel: { flat: true, label: 'Cancelar', color: 'grey-8', noCaps: true },
                ok: { unelevated: true, label: 'Eliminar', color: 'negative', noCaps: true },
                persistent: true
            }).onOk(function () {
                api('Reserva/eliminar', { id: vm.form.id }).then(function () {
                    vm.$q.notify({ type: 'positive', message: 'Reserva eliminada' });
                    vm.dialogo = false;
                    vm.recargar();
                }).catch(function (e) {
                    vm.$q.notify({ type: 'negative', message: e.message });
                });
            });
        }
    }
};

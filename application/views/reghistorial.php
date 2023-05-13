<style>
    label,div,input,form{
        padding: 0px;
        margin: 0px;
        border: 0px;
    }
    .sinespacio{
        padding: 0px;
        margin: 0px;
        border: 0px;
    }
    .sinespaciotexto{
        padding: 2px;
        margin: 2px;
    }
    label::first-letter {
        text-transform: uppercase;
    }
</style>
<form action="<?=base_url()?>Paciente/historialinsert" method="POST"   id="formulario">
    <div class="form-group">
        <input type="text" name="idpaciente" value="<?=$idpaciente?>" hidden>
        <label for="consulta">Motivo de la consulta y enfermedad actual</label>
        <textarea type="text" style="padding: 0px;margin: 0px"  class="form-control" id="consulta" placeholder="Motivo de consulta" name="consulta"></textarea>
    </div>
    <div class="form-group sinespacio">
        <label for="consulta" class="sinespacio"><b>Signos vitales</b></label>
        <div class="form-row sinespacio">
            <div class="form-group col-md-2 sinespacio" >
                <label for="pa" class="sinespacio">pa</label>
                <input type="text"  class="form-control sinespaciotexto" id="pa" placeholder="pa" name="pa" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="fc" class="sinespacio">fc</label>
                <input type="text"  class="form-control sinespaciotexto" id="fc" placeholder="fc" name="fc" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="peso" class="sinespacio">peso</label>
                <input type="text"  class="form-control sinespaciotexto" id="peso" placeholder="peso" name="peso" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="talla" class="sinespacio">talla</label>
                <input type="text"  class="form-control sinespaciotexto" id="talla" placeholder="talla" name="talla" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="imc" class="sinespacio">imc</label>
                <input type="text"  class="form-control sinespaciotexto" id="imc" placeholder="imc" name="imc" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="gc" class="sinespacio">gc</label>
                <input type="text"  class="form-control sinespaciotexto" id="gc" placeholder="gc" name="gc" >
            </div>
        </div>
    </div>
    <div class="form-group sinespacio">
        <label for="consulta" class="sinespacio"><b>Antecedentes Familiares</b></label>
        <div class="form-row sinespacio">
            <div class="form-group col-md-2 sinespacio" >
                <label for="diabetes" class="sinespacio">diabetes</label>
                <input type="checkbox"  class="form-control sinespaciotexto" id="diabetes" placeholder="diabetes" name="diabetes" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="hta" class="sinespacio">hta</label>
                <input type="checkbox"  class="form-control sinespaciotexto" id="hta" placeholder="hta" name="hta" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="cardios" class="sinespacio">cardios</label>
                <input type="checkbox"  class="form-control sinespaciotexto" id="cardios" placeholder="cardios" name="cardios" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="cancer" class="sinespacio">Cáncer</label>
                <input type="checkbox"  class="form-control sinespaciotexto" id="cancer" placeholder="Cáncer" name="cancer" >
            </div>
            <div class="form-group col-md-4 sinespacio" >
                <label for="quefamilia" class="sinespacio">Que familia</label>
                <input type="text"  class="form-control sinespaciotexto" id="quefamilia" placeholder="que familia" name="quefamilia" >
            </div>
        </div>
    </div>
    <div class="form-group sinespacio">
        <label for="consulta" class="sinespacio"><b>Antecedentes NO patologicos</b></label>
        <div class="form-row sinespacio">
            <div class="form-group col-md-2 sinespacio" >
                <label for="estadocivil" class="sinespacio">Estado civil</label>
                <select name="estadocivil" id="estadocivil" >
                    <option value="">Seleccionar...</option>
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Viudo">Viudo</option>
                    <option value="Union libre">Union libre</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="ocupacion" class="sinespacio">ocupacion</label>
                <input type="text"  class="form-control sinespaciotexto" id="ocupacion" placeholder="ocupacion" name="ocupacion" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="fuma" class="sinespacio">fuma</label>
                <br>
                <!--input type="text"  class="form-control sinespaciotexto" id="fuma" placeholder="fuma" name="fuma" -->
                <input type="radio"  class="sinespaciotexto" id="fuma" placeholder="fuma" name="fuma" value="si" >Si
                <input type="radio"   class="sinespaciotexto" id="fuma" placeholder="fuma" name="fuma" value="no" >No

            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="bebe" class="sinespacio">bebe</label>
                <br>
                <!--input type="text"  class="form-control sinespaciotexto" id="bebe" placeholder="bebe" name="bebe" -->
                <input type="radio"  class="sinespaciotexto" id="bebe" placeholder="bebe" name="bebe" value="si" >Si
                <input type="radio"   class="sinespaciotexto" id="bebe" placeholder="bebe" name="bebe" value="no" >No

            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="actividadfisica" class="sinespacio">Actividad Fisica</label>
                <br>
                <!--input type="text"  class="form-control sinespaciotexto" id="actividadfisica" placeholder="actividadfisica" name="actividadfisica" -->
                <input type="radio"  class="sinespaciotexto" id="actividadfisica" placeholder="actividadfisica" name="actividadfisica" value="si" >Si
                <input type="radio"   class="sinespaciotexto" id="actividadfisica" placeholder="actividadfisica" name="actividadfisica" value="no" >No

            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="sueno" class="sinespacio">Habito de sueño</label>
                <input type="text"  class="form-control sinespaciotexto" id="sueno" placeholder="sueño" name="sueno" >
            </div>
            <div class="form-group col-md-4 sinespacio" >
                <label for="alimentos" class="sinespacio">Habito de alimentos</label>
                <input type="text"  class="form-control sinespaciotexto" id="alimentos" placeholder="alimentos" name="alimentos" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="diuresis" class="sinespacio">diuresis</label>
                <input type="text"  class="form-control sinespaciotexto" id="diuresis" placeholder="diuresis" name="diuresis" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="catarsis" class="sinespacio">catarsis</label>
                <input type="text"  class="form-control sinespaciotexto" id="catarsis" placeholder="catarsis" name="catarsis" >
            </div>
        </div>
    </div>
    <div class="form-group sinespacio">
        <label for="consulta" class="sinespacio"><b>Antecedentes  patologicos</b></label><br>
        <textarea name="patologico" id="patologico" class="form-control sinespaciotexto" placeholder="Describa los antecedentes patologicos" ></textarea>
        <div class="form-row sinespacio">
            <div class="form-group col-md-4 sinespacio" >
                <label for="alergias" class="sinespacio">alergias</label>
                <input type="text"  class="form-control sinespaciotexto" id="alergias" placeholder="alergias" name="alergias" >
            </div>
            <div class="form-group col-md-4 sinespacio" >
                <label for="tratamientos" class="sinespacio">tratamientos Recientes</label>
                <input type="text"  class="form-control sinespaciotexto" value="ninguno" id="tratamientos" placeholder="tratamientos" name="tratamientos" >
            </div>
            <div class="form-group col-md-4 sinespacio" >
                <label for="estadopsicologico" class="sinespacio">estado Psicólogico</label>
                <input type="text"  class="form-control sinespaciotexto" id="estadopsicologico" placeholder="estado psicólogico" name="estadopsicologico" >
            </div>
        </div>
    </div>
    <div class="form-group sinespacio">
        <label for="consulta" class="sinespacio"><b>Antecedentes Gineco obstètricos</b></label>
        <div class="form-row sinespacio">
            <div class="form-group col-md-2 sinespacio" >
                <label for="fum" class="sinespacio">FUM</label>
                <input type="text"  class="form-control sinespaciotexto" id="fum" placeholder="fum" name="fum" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="dias" class="sinespacio">dias</label>
                <input type="text"  class="form-control sinespaciotexto" id="dias" placeholder="dias" name="dias" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="frecuencia" class="sinespacio">frecuencia</label>
                <input type="text"  class="form-control sinespaciotexto" id="frecuencia" placeholder="frecuencia" name="frecuencia" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="caracteristica" class="sinespacio">caracteristica</label>
                <input type="text"  class="form-control sinespaciotexto" id="caracteristica" placeholder="caracteristica" name="caracteristica" >
            </div>

            <div class="form-group col-md-2 sinespacio" >
                <label for="partos" class="sinespacio">partos</label>
                <input type="text"  class="form-control sinespaciotexto" id="partos" value="0" placeholder="partos" name="partos" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="ab" class="sinespacio">ab</label>
                <input type="text"  class="form-control sinespaciotexto" id="ab" value="0" placeholder="ab" name="ab" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="cesareas" class="sinespacio">cesareas</label>
                <input type="text"  class="form-control sinespaciotexto" id="cesareas" value="0" placeholder="cesareas" name="cesareas" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="gestas" class="sinespacio">gestas</label>
                <input type="text"  class="form-control sinespaciotexto" id="gestas" value="0" placeholder="gestas" name="gestas" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="lactancia" class="sinespacio">lactancia</label>
                <br>
                <!--input type="text"  class="form-control sinespaciotexto" id="lactancia" placeholder="lactancia" name="lactancia" -->
                <input type="radio"  class="sinespaciotexto" id="lactancia" placeholder="lactancia" name="lactancia" value="si" >Si
                <input type="radio" checked  class="sinespaciotexto" id="lactancia" placeholder="lactancia" name="lactancia" value="no" >No

            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="nhijos" class="sinespacio">n Hijos Vivos</label>
                <input type="text"  class="form-control sinespaciotexto" id="nhijos" placeholder="nhijos" name="nhijos" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="menopausia" class="sinespacio">menopausia</label>
                <br>
                <!--input type="text"  class="form-control sinespaciotexto" id="menopausia" placeholder="menopausia" name="menopausia" -->
                <input type="radio"  class="sinespaciotexto" id="menopausia" placeholder="menopausia" name="menopausia" value="si" >Si
                <input type="radio" checked  class="sinespaciotexto" id="menopausia" placeholder="menopausia" name="menopausia" value="no" >No

            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="pap" class="sinespacio">pap</label>
                <!--input type="text"  class="form-control sinespaciotexto" id="pap" placeholder="pap" name="pap" -->
<!--                <select name="pap" id="pap" class="sinespaciotexto" >-->
<!--                    <option value="">Selesccionar..</option>-->
<!--                    <option value="Pap1">Pap1</option>-->
<!--                    <option value="Pap2">Pap2</option>-->
<!--                    <option value="Pap3">Pap3</option>-->
<!--                    <option value="Pap4">Pap4</option>-->
<!--                    <option value="Pap5">Pap5</option>-->
<!--                </select>-->
                <br>
                <script>

                    function cambio(val) {
                        if(val=='SI'){
                            document.getElementById('pap').style.display = "block";
                        }else{
                            document.getElementById('pap').style.display = "none";
                        }
                    }
                </script>
                <input onclick="cambio('SI')" type="radio"  class="sinespaciotexto" id="pap1" placeholder="pap" name="pap2" value="si" >Si
                <input onclick="cambio('NO')" type="radio" checked  class="sinespaciotexto" id="pap2" placeholder="pap" name="pap2" value="no" >No
                <input type="text"  name="pap" id="pap" class="form-control sinespaciotexto" placeholder="pap" >
                <script>
                    document.getElementById('pap').style.display = "none";
                </script>
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="anticonceptivos" class="sinespacio">anticonceptivos</label>
                <input type="text"  class="form-control sinespaciotexto" id="anticonceptivos" placeholder="anticonceptivos" name="anticonceptivos" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="examenmamario" class="sinespacio">examen Mamario</label> <br>
                <input type="radio"  class="sinespaciotexto" id="examenmamario" placeholder="examenmamario" name="examenmamario" value="si" >Si
                <input type="radio" checked class="sinespaciotexto" id="examenmamario" placeholder="examenmamario" name="examenmamario" value="no" >No
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="ptsimamara" class="sinespacio">ptosis Mamaria</label> <br>
                <input type="radio"  class="sinespaciotexto" id="ptsimamaria" placeholder="ptsimamaria" name="ptsimamaria" value="si" >Si
                <input type="radio" checked class="sinespaciotexto" id="ptsimamaria" placeholder="ptsimamaria" name="ptsimamaria" value="no" >No
            </div>

        </div>
    </div>
    <div class="form-group sinespacio">
        <label for="consulta" class="sinespacio"><b>Piel y Faneras</b></label>
        <div class="form-row sinespacio">
            <div class="form-group col-md-2 sinespacio" >
                <label for="cremas" class="sinespacio">cremas que utiliza</label>
                <input type="text"  class="form-control sinespaciotexto" id="cremas" placeholder="cremas" name="cremas" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="cutis" class="sinespacio">cutis</label><br>
                <input type="radio"  class="sinespaciotexto" id="cutis" placeholder="cutis" name="cutis" value="si" >Si
                <input type="radio" checked  class="sinespaciotexto" id="cutis" placeholder="cutis" name="cutis" value="no" >No
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="donde" class="sinespacio">donde</label>
                <input type="text"  class="form-control sinespaciotexto" id="donde" placeholder="donde" name="donde" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="queutilizaron" class="sinespacio">que Utilizaron</label>
                <input type="text"  class="form-control sinespaciotexto" id="queutilizaron" placeholder="queutilizaron" name="queutilizaron" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="sol" class="sinespacio">Esta en el sol</label>
                <input type="text"  class="form-control sinespaciotexto" id="sol" placeholder="sol" name="sol" >
            </div>
            <div class="form-group col-md-2 sinespacio" >
                <label for="solar" class="sinespacio">Proteccion solar</label>
                <!--input type="text"  class="form-control sinespaciotexto" id="solar" placeholder="solar" name="solar" -->
                <input type="radio"  class="sinespaciotexto" id="solar" placeholder="solar" name="solar" value="si" >Si
                <input type="radio" checked  class="sinespaciotexto" id="solar" placeholder="solar" name="solar" value="no" >No

            </div>
            <div class="form-group col-md-4 sinespacio" >
                <label for="otros" class="sinespacio">Otros TX Esteticos</label>
                <input type="text"  class="form-control sinespaciotexto" id="otros" placeholder="otros" name="otros" >
            </div>
        </div>
    </div>
    <div class="form-row sinespacio">
        <div class="form-group col-md-4 sinespacio" >
            <label for="alopecia" class="sinespacio"><b>Alopecia</b></label><br>
            <input type="radio"  class="sinespaciotexto" id="alopecia" placeholder="alopecia" name="alopecia" value="si" >Si
            <input type="radio" checked  class="sinespaciotexto" id="alopecia" placeholder="alopecia" name="alopecia" value="no" >No
        </div>
        <div class="form-group col-md-4 sinespacio" >
            <label for="depilacion" class="sinespacio"><b>Depilacion <span>(Describa habitos depilatorios)</span></b>  </label>
            <input type="text"  class="form-control sinespaciotexto" id="depilacion" placeholder="depilacion" name="depilacion" >
        </div>
        <div class="form-group col-md-4 sinespacio" >
            <label for="unas" class="sinespacio"><b>Uñas</b>  </label>
            <input type="text"  class="form-control sinespaciotexto" id="unas" placeholder="unas" name="unas" >
        </div>
    </div>
    <div class="form-row sinespacio">
        <div class="form-group col-md-12 sinespacio" >
            <label for="piel" class="sinespacio"><b>Tipo de piel</b></label><br>
            Tipo I  <input type="radio"   class="sinespaciotexto" id="piel" placeholder="piel" name="piel" value="Tipo I" >
            Tipo II <input type="radio"  class="sinespaciotexto" id="piel" placeholder="piel" name="piel" value="Tipo II" >
            Tipo III <input type="radio"  class="sinespaciotexto" id="piel" placeholder="piel" name="piel" value="Tipo III" >
            Tipo IV <input type="radio"  class="sinespaciotexto" id="piel" placeholder="piel" name="piel" value="Tipo IV" >
            Tipo V <input type="radio"  class="sinespaciotexto" id="piel" placeholder="piel" name="piel" value="Tipo V" >
            Tipo VI <input type="radio"  class="sinespaciotexto" id="piel" placeholder="piel" name="piel" value="Tipo VI" >

        </div>
    </div>
    <div class="form-row sinespacio">
        <div class="form-group col-md-6 sinespacio" >
            <label for="biotipo" class="sinespacio"><b>Biotipo de la piel</b>  </label>
            <!--input type="text"  class="form-control sinespaciotexto" id="biotipo" placeholder="biotipo" name="biotipo"-->
            <select name="biotipo" id="biotipo"  >
                <option value="">Seleecionar...</option>
                <option value="Seco">Seco</option>
                <option value="Mixto">Mixto</option>
                <option value="Graso">Graso</option>
            </select>
        </div>
        <div class="form-group col-md-6 sinespacio" >
            <label for="arrugas" class="sinespacio"><b>Arrugas lugar y grado del I-III</b>  </label>
            <input type="text"  class="form-control sinespaciotexto" id="arrugas" placeholder="arrugas" name="arrugas" >
        </div>
    </div>
    <div class="align-content-center" style="align-items: center;width: 100%;">
        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="<?=base_url()?>Paciente/" class="btn btn-danger">Cancelar</a>
    </div>
</form>

<script>
    window.onload=function () {
     $('#formulario').submit(function (e) {
         if (!confirm("Seguro de guardar los datos?")){
             return false;
         }

     });

    var peso=document.getElementById('peso');
    var talla=document.getElementById('talla');
    var imc=document.getElementById('imc');
    peso.addEventListener("change",cimc);
    peso.addEventListener("keyup",cimc);
    talla.addEventListener("keyup",cimc);
    talla.addEventListener("change",cimc);
    function cimc() {
        imc.value=((peso.value)/Math.pow(talla.value,2)).toFixed(2);
    }
    var gestas=document.getElementById('gestas');
    var partos=document.getElementById('partos');
    var ab=document.getElementById('ab');
    var cesareas=document.getElementById('cesareas');
    partos.addEventListener("change",cgestas);
    partos.addEventListener("keyup",cgestas);
    ab.addEventListener("keyup",cgestas);
    ab.addEventListener("change",cgestas);
    cesareas.addEventListener("change",cgestas);
    cesareas.addEventListener("keyup",cgestas);
    function cgestas() {
        gestas.value= parseInt(partos.value) + parseInt( ab.value)+ parseInt(cesareas.value);
    }
    }
</script>

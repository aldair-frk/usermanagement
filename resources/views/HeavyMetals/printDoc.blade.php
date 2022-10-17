<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <table>
        <tr><td colspan="8"></td></tr>
        <tr>
            <td colspan="8" style="font-size: 18px; border: 3px solid #807d7d; font-weight: 500; text-align: center;">DIRESA PASCO DEIT</td>
        </tr>
        <tr><td colspan="8"></td></tr>
        <tr>
            <td colspan="8" style="font-size: 16px; border: 3px solid #807d7d; font-weight: 500; text-align: center;">Registro de Seguimiento de Personas Expuestas a Metales Pesados, Metaloides y Otras Sustancias Químicas</td>
        </tr>
        <tr><td colspan="8"></td></tr>
    </table>
    <table>
        @foreach($list as $pr)
            <tr>
                <th colspan="8" style="background: #92CDDC; text-align: center; font-weight: 500; border: 3px solid #A6A6A6;">DATOS DEL PACIENTE</th>
            </tr>
            <tr>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Tipo Doc / Documento:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->document_type }} / {{ $pr->document }}</td>
                <th></th>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Fecha Nacimiento:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->birth_date }}</td>
                <th></th>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Apellidos y Nombres:</th>
                <td style="background: #F2F2F2; border: 3px solid #A6A6A6;">{{ $pr->names }}</td>
            </tr>
            <tr>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Edad / Sexo:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->age }} / {{ $pr->gender }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Región Actual:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->region_current }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Provincia Actual:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->province_current }}</td>
                <th></th>
            </tr>
            <tr>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Distrito Actual:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->district_current }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Dirección Actual:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->direction_current }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Región Registrado:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->region_register }}</td>
                <th></th>
            </tr>
            <tr>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Provincia Registrado:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->province_register }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Distrito Registrado:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->district_register }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Establecimiento Registrado:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->establishment_register }}</td>
                <th></th>
            </tr>
            <tr>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Historia Clínica:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->clinic_history }}</td>
                <th></th>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Fecha Ingreso a Padrón:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->pn_registration_date }}</td>
                <th></th>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Tipo de Caso:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->case_type }}</td>
                <th></th>
            </tr>
            <tr>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Tipo Seguro:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->sure_type }}</td>
                <th></th>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Categoria:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->category }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Pseudónimo/Código:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->pseudonym_code }}</td>
                <th></th>
            </tr>
            <tr>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Celular:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->cellphone }}</td>
                <th></th>
                <th style="background: #DAEEF3; font-weight: 500; border: 3px solid #A6A6A6;">Vacunación Covid:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->covid_vaccination }}</td>
                <th></th>
            </tr>
            <tr></tr>
            <tr>
                <th colspan="8" style="background: #92CDDC; text-align: center; font-weight: 500; border: 3px solid #A6A6A6;">DATOS DEL APODERADO</th>
            </tr>
            <tr>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Documento Apoderado</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->document_authorized }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Nombres Apoderado</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->names_authorized }}</td>
                <th></th>
                <th style="background: #31869B; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Teléfono</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $pr->cellphone_authorized }}</td>
            </tr>
            <tr></tr>
            <tr>
                <th colspan="8" style="background: #CCC0DA; text-align: center; font-weight: 500; border: 3px solid #A6A6A6;">EXAMENES SEMESTRALES</th>
            </tr>
            <tr>
                <th style="background: #60497A; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Examen Especial</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;"></td>
                <th></th>
                <th style="background: #60497A; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Fecha Examen</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;"></td>
                <th></th>
                <th style="background: #60497A; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Entrega Resultado</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;"></td>
            </tr>
            <tr>
                <th style="background: #60497A; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Examen Censopas</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;"></td>
                <th></th>
                <th style="background: #60497A; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Fecha Examen</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;"></td>
                <th></th>
                <th style="background: #60497A; color: white; font-weight: 500; border: 3px solid #A6A6A6;">Entrega Resultado</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;"></td>
            </tr>
        @endforeach
    </table>
    <table>
        <tr></tr>
        <tr>
            <th colspan="8" style="background: #DA9694; font-size: 16px; text-align: center; font-weight: 500; border: 3px solid #A6A6A6;">ATENCIONES ESTRATEGIA METALES PESADOS</th>
        </tr>
        @foreach($list2 as $attentions)
            <tr>
                <th colspan="2" style="background: #FFFF00; text-align: center; font-weight: 500; border: 3px solid black;">SEGUIMIENTO MES
                    @if ($attentions->month_a == '1') ENERO @endif
                    @if ($attentions->month_a == '2') FEBRERO @endif
                    @if ($attentions->month_a == '3') MARZO @endif
                    @if ($attentions->month_a == '4') ABRIL @endif
                    @if ($attentions->month_a == '5') MAYO @endif
                    @if ($attentions->month_a == '6') JUNIO @endif
                    @if ($attentions->month_a == '7') JULIO @endif
                    @if ($attentions->month_a == '8') AGOSTO @endif
                    @if ($attentions->month_a == '9') SETIEMBRE @endif
                    @if ($attentions->month_a == '10') OCTUBRE @endif
                    @if ($attentions->month_a == '11') NOVIEMBRE @endif
                    @if ($attentions->month_a == '12') DICIEMBRE @endif
                </th>
            </tr>
            <tr>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Solicito Médico:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->solicitude_medic }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Tuvo Referencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->reference }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Lugar Referencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->reference_place }}</th>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Tuvo Contrareferencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->against_reference }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Lugar Contrareferencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->against_reference_place }}</th>
            </tr>
            <tr></tr>
            <tr>
                <th style="background: #C00000; color: white; font-weight: 500; border: 3px solid #A6A6A6;">ATENCIÓN PRESENCIAL</th>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Medicina:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->medicine_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Hemoglobina</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->hemoglobin }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Pb (µg/dl)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->pb_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Enfermería:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->nursing_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Orina:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->urine }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">As (µg/g creatinina)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->as_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Obstetricia:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->obstetrics_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Perfil Hepático:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->liver_profile }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Cd (µg/g creatinina)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->cd_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Psicología:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->psychology_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Hematocrito:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->hematocrit }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Hg (µg/g creatinina)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->hg_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Odontología:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->odontology_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Perfil Lipídico:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->lipidic_profile }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Otro</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->other_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Cred:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->cred_attention }}</td>
                <th></th>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Telemonitoreo:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->telemedicine_attention }}</td>
                <th></th>
            </tr>
            <tr></tr>
            <tr>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Atención Integral:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->integral_attention }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Aten. Especializada:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->specialized_attention }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Detalle de Atención:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->specialized_attention_detail }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Aten. Telemedicina:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->telemedicine }}</th>
                <th></th>
            </tr>
            <tr></tr>
            <tr>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Establecimiento:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->ipress_attention }}</th>
                <th></th>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Fecha:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->date_attention }}</th>
                <th></th>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Servicio:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->service_attention }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Resultados:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->results_attention }}</th>
                <th></th>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Observaciones:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $attentions->observations_attention }}</th>
                <th></th>
            </tr>
            <tr></tr>
        @endforeach
    </table>
    <table>
        <tr>
            <th colspan="8" style="background: #16365C; color: white; font-size: 16px; text-align: center; font-weight: 500; border: 3px solid #A6A6A6;">ATENCIONES POR OTRAS ESTRATEGIAS (NO METALES)</th>
        </tr>
        @foreach($list3 as $noMetals)
            <tr>
                <th colspan="2" style="background: #FFFF00; text-align: center; font-weight: 500; border: 3px solid black;">SEGUIMIENTO MES
                    @if ($noMetals->month_a == '1') ENERO @endif
                    @if ($noMetals->month_a == '2') FEBRERO @endif
                    @if ($noMetals->month_a == '3') MARZO @endif
                    @if ($noMetals->month_a == '4') ABRIL @endif
                    @if ($noMetals->month_a == '5') MAYO @endif
                    @if ($noMetals->month_a == '6') JUNIO @endif
                    @if ($noMetals->month_a == '7') JULIO @endif
                    @if ($noMetals->month_a == '8') AGOSTO @endif
                    @if ($noMetals->month_a == '9') SETIEMBRE @endif
                    @if ($noMetals->month_a == '10') OCTUBRE @endif
                    @if ($noMetals->month_a == '11') NOVIEMBRE @endif
                    @if ($noMetals->month_a == '12') DICIEMBRE @endif
                </th>
            </tr>
            <tr>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Solicito Médico:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->solicitude_medic }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Tuvo Referencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->reference }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Lugar Referencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->reference_place }}</th>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Tuvo Contrareferencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->against_reference }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Lugar Contrareferencia:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->against_reference_place }}</th>
            </tr>
            <tr></tr>
            <tr>
                <th style="background: #C00000; color: white; font-weight: 500; border: 3px solid #A6A6A6;">ATENCIÓN PRESENCIAL</th>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Medicina:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->medicine_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Hemoglobina</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->hemoglobin }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Pb (µg/dl)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->pb_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Enfermería:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->nursing_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Orina:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->urine }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">As (µg/g creatinina)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->as_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Obstetricia:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->obstetrics_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Perfil Hepático:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->liver_profile }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Cd (µg/g creatinina)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->cd_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Psicología:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->psychology_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Hematocrito:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->hematocrit }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Hg (µg/g creatinina)</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->hg_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Odontología:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->odontology_attention }}</td>
                <th></th>
                <td style="background: #C4D79B; font-weight: 500; border: 3px solid #A6A6A6;">Perfil Lipídico:</td>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->lipidic_profile }}</td>
                <th></th>
                <th style="background: #FABF8F; font-weight: 500; border: 3px solid #A6A6A6;">Otro</th>
                <td style="background: #F2F2F2;  text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->other_attention }}</td>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Cred:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->cred_attention }}</td>
                <th></th>
            </tr>
            <tr>
                <th style="background: #E6B8B7; font-weight: 500; border: 3px solid #A6A6A6;">Telemonitoreo:</th>
                <td style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->telemedicine_attention }}</td>
                <th></th>
            </tr>
            <tr></tr>
            <tr>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Atención Integral:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->integral_attention }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Aten. Especializada:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->specialized_attention }}</th>
                <th></th>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Detalle de Atención:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->specialized_attention_detail }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="background: ; font-weight: 500; border: 3px solid #A6A6A6;">Aten. Telemedicina:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->telemedicine }}</th>
                <th></th>
            </tr>
            <tr></tr>
            <tr>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Establecimiento:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->ipress_attention }}</th>
                <th></th>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Fecha:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->date_attention }}</th>
                <th></th>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Servicio:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->service_attention }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Resultados:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->results_attention }}</th>
                <th></th>
                <th style="background: #95B3D7; font-weight: 500; border: 3px solid #A6A6A6;">Observaciones:</th>
                <th style="background: #F2F2F2; text-align: center; border: 3px solid #A6A6A6;">{{ $noMetals->observations_attention }}</th>
                <th></th>
            </tr>
            <tr></tr>
            <tr></tr>
        @endforeach
    </table>
</body>
</html>
<HTML>

<HEAD>
    <META NAME="Author" CONTENT="Crystal Reports 13.0">
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</HEAD>

<BODY>
    <style>
        div {
            position: absolute;
            z-index: 25
        }

        a {
            text-decoration: none
        }

        a img {
            border-style: none;
            border-width: 0
        }

        .fc1id3qyyfqfr4-0 {
            font-size: 11pt;
            color: #000000;
            font-family: Arial;
            font-weight: normal;
        }

        .fc1id3qyyfqfr4-1 {
            font-size: 13pt;
            color: #000000;
            font-family: Arial;
            font-weight: bold;
        }

        .fc1id3qyyfqfr4-2 {
            font-size: 11pt;
            color: #000000;
            font-family: Arial;
            font-weight: bold;
        }

        .fc1id3qyyfqfr4-3 {
            font-size: 9pt;
            color: #000000;
            font-family: Arial;
            font-weight: normal;
        }

        .fc1id3qyyfqfr4-4 {
            font-size: 6pt;
            color: #808284;
            font-family: Century Gothic;
            font-weight: normal;
        }

        .ad1id3qyyfqfr4-0 {
            border-color: #000000;
            border-left-width: 0;
            border-right-width: 0;
            border-top-width: 0;
            border-bottom-width: 0;
        }

    </style>
    <div style="z-index:3;clip:rect(0px,771px,155px,0px);top:0px;left:0px;width:771px;height:155px;"></div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:27px;left:62px;width:232px;height:99px;"><img
            src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{14632F67-9520-4ED4-8A68-2107324CDA62}.png"
            border="0" width="232px" height="99px"></div>
    <div style="z-index:3;clip:rect(0px,771px,54px,0px);top:155px;left:0px;width:771px;height:54px;"></div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:169px;left:546px;width:167px;height:19px;"><span
            class="fc1id3qyyfqfr4-0">{{ formatDateGye() }}</span></div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:169px;left:465px;width:78px;height:18px;">
        <table width="78px" border="0" cellpadding="0" cellspacing="0">
            <td align="left"><span class="fc1id3qyyfqfr4-0">Guayaquil,</span></td>
        </table>
    </div>
    <div style="z-index:3;clip:rect(0px,771px,675px,0px);top:209px;left:0px;width:771px;height:675px;"></div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:259px;left:220px;width:382px;height:72px;">
        <table width="382px" border="0" cellpadding="0" cellspacing="0">
            <td align="center"><span class="fc1id3qyyfqfr4-1">CERTIFICADO&nbsp;DE&nbsp;CUMPLIMIENTO&nbsp;DE&nbsp;</span>
            </td>
        </table>
        <table width="382px" border="0" cellpadding="0" cellspacing="0">
            <td align="center"><span class="fc1id3qyyfqfr4-1">PRÁCTICAS&nbsp;{{ $practica }}&nbsp;</span></td>
        </table>
    </div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true"
        style="z-index:25;top:324px;left:73px;width:623px;height:350px;text-align:justify;">
        <table width="623px" border="0" cellpadding="0" cellspacing="0">
            <td align="left"><span class="fc1id3qyyfqfr4-1">&nbsp;</span></td>
        </table>
        <table width="623px" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="justify">
                    
                    <p>
                        Por medio del presente certifico que {{ strGenderPrintstroa($voluntario->genero)}} <span style="font-weight: 800">{{ strtoupper($voluntario->Apellidos) }} {{ strtoupper($voluntario->apellidoMaterno) }} {{ strtoupper($voluntario->Nombres) }} {{ strtoupper($voluntario->nombreSegundo) }}</span>, portador  de la Cédula de Identidad <span style="font-weight: 800">{{ $voluntario->Pasaporte }}</span>, estudiante de la carrera de <span style="font-weight: 800">{{ $periodo === null ? $voluntario->Carrera : $periodo->carrera }}</span> de la <span style="font-weight: 800">{{ $periodo === null ? $voluntario->universidad->Nombre : $periodo->universidad->Nombre }}</span>, realizó PRACTICAS <span style="font-weight: 800">{{ $practica }}</span> en {{ $periodo === null ? $voluntario->unidad->Nombre : $periodo->unidad->Nombre }}, institución regentada por la Benemérita Sociedad Protectora de la Infancia, en base al Convenio de Cooperación Interinstitucional entre la {{ $periodo === null ? $voluntario->universidad->Nombre : $periodo->universidad->Nombre }} y la Benemérita Sociedad Protectora de la Infancia firmado el {{ $periodo === null ? formatDateComplete($voluntario->universidad->Convenio) : formatDateComplete($periodo->universidad->Convenio) }} desde el {{ $periodo === null ? formatDateComplete($voluntario->FechaInicio) : formatDateComplete($periodo->fecha_inicio) }} al {{ $periodo === null ? formatDateComplete($voluntario->FechaFin) : formatDateComplete($periodo->fecha_fin) }} en el Departamento <span style="font-weight: 800">{{ $periodo === null ? $voluntario->departamento->Nombre : $periodo->departamento->Nombre }}</span>, completando un total de <span style="font-weight: 800">{{ $periodo === null ? $voluntario->HorasProgramada : $periodo->horas_programada }} horas</span>. 
                    </p>
                    {{-- <span class="fc1id3qyyfqfr4-2"></span> --}}
                    {{-- <span class="fc1id3qyyfqfr4-0"></span> --}}
                </td>
            </tr>
        </table>
        
        <table width="623px" border="0" cellpadding="0" cellspacing="0">
            <td align="justify"><span
                    class="fc1id3qyyfqfr4-0">Lo&nbsp;que&nbsp;se&nbsp;certifica&nbsp;para&nbsp;fines&nbsp;académicos.</span>
            </td>
        </table>
    </div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:702px;left:75px;width:125px;height:15px;">
        <table width="125px" border="0" cellpadding="0" cellspacing="0">
            <td align="left"><span class="fc1id3qyyfqfr4-0">Atentamente,</span></td>
        </table>
    </div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:716px;left:62px;width:291px;height:166px;"><img
            src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{626FF632-6C6C-4321-B04A-08548C0DAB80}.png"
            border="0" width="291px" height="166px"></div>
    <div style="z-index:3;clip:rect(0px,771px,13px,0px);top:884px;left:0px;width:771px;height:13px;"></div>
    <div style="z-index:3;clip:rect(0px,771px,61px,0px);top:1039px;left:0px;width:771px;height:61px;"></div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:1045px;left:579px;width:148px;height:53px;">
        <table width="148px" border="0" cellpadding="0" cellspacing="0">
            <td align="right"><span class="fc1id3qyyfqfr4-4">www.bspi.org</span></td>
        </table>
        <table width="148px" border="0" cellpadding="0" cellspacing="0">
            <td align="right"><span class="fc1id3qyyfqfr4-4">Eloy&nbsp;Alfaro&nbsp;2402&nbsp;y&nbsp;Bolivia</span></td>
        </table>
        <table width="148px" border="0" cellpadding="0" cellspacing="0">
            <td align="right"><span
                    class="fc1id3qyyfqfr4-4">Telf:&nbsp;(593)&nbsp;4&nbsp;2448955&nbsp;-&nbsp;2448313</span></td>
        </table>
        <table width="148px" border="0" cellpadding="0" cellspacing="0">
            <td align="right"><span class="fc1id3qyyfqfr4-4">Guayaquil-Ecuador</span></td>
        </table>
    </div>
    <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:1044px;left:68px;width:300px;height:50px;"><img
            src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{5E6B781A-68CD-44E0-854B-0E3923B35E67}.png"
            border="0" width="300px" height="50px"></div>

    <div id="pageNavigator" style="top:1100px;left:0px;font-style:italic;font-weight:100;font-size:smaller">
        <hr>
    </div>
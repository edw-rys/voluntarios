<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
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
            font-size: 10pt;
            color: #757575;
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
        .relative{position: relative;}
        .bold{
            font-weight: 900;
        }
        .text-center{
            text-align:center;
        }
        .text-justify{
            text-align:justify;
        }
        .w-80{
            width: 90%;
        }
        .m-auto{
            margin: 20px auto;
        }
        .text-right{text-align: right}
    </style>
</head>
<body>
    
    <div>
        <div class="relative">
            <div class="" style="position: absolute; top:-25px; left:-20px" >
                <img
                src="{{ asset('') }}/img/reportes/certificado/rptReporteFinal{14632F67-9520-4ED4-8A68-2107324CDA62}.png"
                {{-- src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{14632F67-9520-4ED4-8A68-2107324CDA62}.png" --}}
                border="0" width="232px" height="99px"></div>
            <div style="margin-top:100px">
                <h2 class="text-center">CONVENIO DE CONFIDENCIALIDAD</h2>
                <div>
                    <p class="text-justify w-80 m-auto"><span class="bold">PRIMERA: COMPARECIENTE. -</span>  A la celebración del presente convenio comparecen por una parte la <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>, legalmente representada por <span class="bold">DR.H.C. RICARDO JORGE KOENIG OLIVE</span>, en su calidad de Presidente y Representante Legal; y, por otra parte, <span class="bold">{{ strtoupper($voluntario->Apellidos) }} {{ strtoupper($voluntario->apellidoMaterno) }} {{ strtoupper($voluntario->Nombres) }} {{ strtoupper($voluntario->nombreSegundo) }}</span>, portador de la cédula de identidad <span class="bold">No. {{ $voluntario->Pasaporte }}</span> por sus propios y personales derechos, a quien se la denominará <span class="bold">“{{ tipo_practica_min($periodo->tipo_practica_id) }}”</span>. Los comparecientes son mayores de edad, hábiles para contratar y contraer obligaciones, quienes libre y voluntariamente y por los derechos que representan, acuerdan en celebrar, como en efecto lo hacen, un convenio de confidencialidad de información, procedimientos, proyectos, descubrimientos e invenciones, contenido en las siguientes cláusulas:</p>
                <p class="text-justify w-80 m-auto"><span class="bold">SEGUNDA: ANTECEDENTES. -  a)</span> La <span>BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>, institución de actividades de asistencia hospitalaria y social, ha aceptado la solicitud de <span class="bold">{{ strtoupper( tipo_practica_ext($periodo->tipo_practica_id) )}}</span> presentada ante la institución por estudiante <span class="bold">{{ strtoupper($voluntario->Apellidos) }} {{ strtoupper($voluntario->apellidoMaterno) }} {{ strtoupper($voluntario->Nombres) }} {{ strtoupper($voluntario->nombreSegundo) }}. b) {{ strtoupper($voluntario->Apellidos) }} {{ strtoupper($voluntario->apellidoMaterno) }} {{ strtoupper($voluntario->Nombres) }} {{ strtoupper($voluntario->nombreSegundo) }}, de {{ obtener_universiad($periodo->universidad_id)}}</span>, se encuentra realizando {{ tipo_practica_ext_long($periodo->tipo_practica_id) }} en el {{ obtener_unidad($periodo->unidad_id) }}, situación por la cual el voluntario tiene acceso, conocimiento y manejo de información de propiedad de la Institución.</p>
                    <p class="text-justify w-80 m-auto"><span class="bold">TERCERA: OBJETO.-</span> En razón de los antecedentes expuestos y en consideración a los derechos que le son propios a la <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>, este convenio tiene por objeto salvaguardar dichos derechos de propiedad intelectual, impidiendo la divulgación, propagación, impresión, traslado o transferencia de información de la institución, a la que <span class="bold">“{{ tipo_practica_min($periodo->tipo_practica_id) }}”</span> tiene acceso por medios electrónicos o físicos, conocimiento y capacitación; quien los utiliza para uso exclusivo en la materia o actividad para la que ha sido desarrollada y para beneficio de su propietaria la <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>. En tal virtud, <span class="bold">“{{ tipo_practica_min($periodo->tipo_practica_id) }}”</span> se compromete y obliga a no revelar bajo ninguna circunstancia, ya sea durante la vigencia {{ tipo_practica_ext_vigencia($periodo->tipo_practica_id) }}, o con posterioridad a la terminación de la misma, ninguna información con relación al sistema de la empresa, procesos, conocimientos y experiencias que fueron adquiridos o a los que tuvo acceso por su práctica dentro de la empresa; excepto cuando lo autorice expresamente el o los representantes de la Institución <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>, por escrito y según sus instrucciones o cuando sea requerido por autoridad judicial competente. Por lo tanto, guardará absoluta reserva, sigilo y confidencialidad sobre los datos, procedimientos, operaciones, normas, técnicas y demás informaciones que hayan llegado a su conocimiento.</p>
                </div>
            </div>
            <div class="" nowrap="true" style="margin-top: 27px">
                <img
                    src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{5E6B781A-68CD-44E0-854B-0E3923B35E67}.png"
                    border="0" width="490px" height="90px">
            </div>
            <div class="" nowrap="true" style="z-index:25;position: absolute; right:20px; bottom:30px; font-size:50px">
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span class="fc1id3qyyfqfr4-4 text-right">www.bspi.org</span></td>
                </table>
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span class="fc1id3qyyfqfr4-4 text-right">Eloy&nbsp;Alfaro&nbsp;2402&nbsp;y&nbsp;Bolivia</span></td>
                </table>
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span
                            class="fc1id3qyyfqfr4-4 text-right">Telf:&nbsp;(593)&nbsp;4&nbsp;2448955&nbsp;-&nbsp;2448313</span></td>
                </table>
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span class="fc1id3qyyfqfr4-4 text-right">Guayaquil-Ecuador</span></td>
                </table>
            </div>
        </div>
        <div class="relative">
            <div class="">
                <img
                src="{{ asset('') }}/img/reportes/certificado/rptReporteFinal{14632F67-9520-4ED4-8A68-2107324CDA62}.png"
                {{-- src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{14632F67-9520-4ED4-8A68-2107324CDA62}.png" --}}
                border="0" width="232px" height="99px">
            </div>
            <div>
                <p class="text-justify w-80 m-auto">Los descubrimientos, invenciones, las mejoras en los procedimientos, así como, los trabajos y resultados de las actividades productivas relacionadas con el objeto social de la empresa, son de propiedad exclusiva de la <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>, y quedarán en su beneficio, pudiendo patentar o registrar a su nombre tales mejoras o inventos, de conformidad a lo prescrito en los <span class="bold">arts. 275, 276 y 277 del Código Orgánico de la Economía Social de los Conocimientos</span>. Por lo expuesto, le queda totalmente prohibido a <span class="bold">“{{ tipo_practica_min($periodo->tipo_practica_id) }}”</span>, hacer uso de los conocimientos adquiridos, para su beneficio o de terceros, directa o indirectamente, durante el periodo de {{ tipo_practica_min($periodo->tipo_practica_id) }} para la institución y hasta por cinco <span class="bold">(5) años después de terminado la misma.</span> </p>
                <p class="text-justify w-80 m-auto"><span class="bold">“{{ tipo_practica_min($periodo->tipo_practica_id) }}”</span> también se obliga a mantener la confidencialidad sobre la información relativa a los socios, funcionarios y directores de ésta, sobre la información relativa a los negocios y actividades de la <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>, reconocidas como confidenciales, y que por motivo de sus actividades como pasante deba conocer y manejar; así como también sobre los términos de los distintos contratos celebrados con terceros. La obligación del voluntario se extiende a asegurar que la información a la que se refiere esta cláusula sea mantenida confidencial por todas las personas naturales y jurídicas que estuvieren, estén o vayan a estar en el futuro, involucradas en las pasantías.</p>
                <p class="text-justify w-80 m-auto"><span class="bold">CUARTA: PENALIDAD. -</span> Cualquier violación a este convenio, faculta a la <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span> para interponer la acción de daños y perjuicios, así como también las respectivas acciones contempladas en el <span class="bold">Título VII en los Capítulos I, II, y III del Código Orgánico de la Economía Social de los Conocimientos</span>; las previstas en el <span class="bold">Código Orgánico Integral Penal</span> y las demás contempladas en Tratados, Acuerdos, Convenciones, Protocolos, y Convenios internacionales. Para efecto de lo anotado el o los representantes de la <span class="bold">BENEMÉRITA SOCIEDAD PROTECTORA DE LA INFANCIA</span>, podrán presentar la respectiva denuncia fundamentados en lo dispuesto en el <span class="bold">art.179 del Código Orgánico Integral Penal</span>.</p>
                <p class="text-justify w-80 m-auto"><span class="bold">p. Benemérita Sociedad Protectora de la Infancia</span></p>
            </div>
            <div style="margin-top:100px">
                <p class="text-center">_________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________________________</p>
                <p class="text-center bold" style="font-size: 16px;">DR.H.C. RICARDO KOENIG OLIVE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ strtoupper($voluntario->Apellidos) }} {{ strtoupper($voluntario->apellidoMaterno) }} {{ strtoupper($voluntario->Nombres) }} {{ strtoupper($voluntario->nombreSegundo) }}</p>
                <p class="text-center bold" style="position: relative"><span style="position: absolute;left:200px">PRESIDENTE</span><span style="position: absolute;right: 200px">VOLUNTARIO</span></p>
            </div>
            <div class="" nowrap="true" style="margin-top: 27px; position: absolute; bottom:20px">
                <img
                    src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{5E6B781A-68CD-44E0-854B-0E3923B35E67}.png"
                    border="0" width="490px" height="90px">
            </div>
            <div class="" nowrap="true" style="z-index:25;position: absolute; right:20px; bottom:30px; font-size:50px">
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span class="fc1id3qyyfqfr4-4 text-right">www.bspi.org</span></td>
                </table>
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span class="fc1id3qyyfqfr4-4 text-right">Eloy&nbsp;Alfaro&nbsp;2402&nbsp;y&nbsp;Bolivia</span></td>
                </table>
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span
                            class="fc1id3qyyfqfr4-4 text-right">Telf:&nbsp;(593)&nbsp;4&nbsp;2448955&nbsp;-&nbsp;2448313</span></td>
                </table>
                <table style="width: 100%" border="0" cellpadding="0" cellspacing="0">
                    <td align="right"><span class="fc1id3qyyfqfr4-4 text-right">Guayaquil-Ecuador</span></td>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


        {{-- <div style="position:relative">

            <div style="z-index:3;clip:rect(0px,771px,155px,0px);top:0px;left:0px;width:771px;height:155px;"></div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:27px;left:62px;width:232px;height:99px;">
                <img
                    src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{14632F67-9520-4ED4-8A68-2107324CDA62}.png"
                    border="0" width="232px" height="99px"></div>
            <div style="z-index:3;clip:rect(0px,771px,54px,0px);top:155px;left:0px;width:771px;height:54px;"></div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:169px;left:546px;width:200px;height:19px;"><span
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
                    <td align="center"><span class="fc1id3qyyfqfr4-1">PRÁCTICAS&nbsp;practica466&nbsp;</span></td>
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
                                Por medio del presente certifico que ggsjkd <span style="font-weight: 800">ddddddd ddddddd ddddddd ddddddd</span>, portador  de la Cédula de Identidad <span style="font-weight: 800">0000000000</span>, estudiante de la carrera de <span style="font-weight: 800">peeeer</span> de la <span style="font-weight: 800">peee2</span>, realizó PRACTICAS <span style="font-weight: 800">sdsssss</span> en lllllllll, institución regentada por la Benemérita Sociedad Protectora de la Infancia, en base al Convenio de Cooperación Interinstitucional entre la sssssss y la Benemérita Sociedad Protectora de la Infancia firmado el lkkkkkkk desde el ffffff al ttttt en el Departamento <span style="font-weight: 800">iiiiii</span>, completando un total de <span style="font-weight: 800">ppppppp horas</span>. 
                            </p>
                        </td>
                    </tr>
                </table>
                
                <table width="623px" border="0" cellpadding="0" cellspacing="0">
                    <td align="justify"><span
                            class="fc1id3qyyfqfr4-0">Lo&nbsp;que&nbsp;se&nbsp;certifica&nbsp;para&nbsp;fines&nbsp;académicos.</span>
                    </td>
                </table>
            </div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:50;top:702px;left:75px;width:125px;height:15px;">
                <table width="125px" border="0" cellpadding="0" cellspacing="0">
                    <td align="left"><span class="fc1id3qyyfqfr4-0">Atentamente,</span></td>
                </table>
            </div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:716px;left:62px;width:291px;height:166px;">
                <img
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
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:1044px;left:68px;width:300px;height:50px;">
                <img
                    src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{5E6B781A-68CD-44E0-854B-0E3923B35E67}.png"
                    border="0" width="300px" height="50px"></div>
        
            <div id="pageNavigator" style="top:1100px;left:0px;font-style:italic;font-weight:100;font-size:smaller">
            </div>

        </div>    

        <div style="position: relative">

            <div style="z-index:3;clip:rect(0px,771px,155px,0px);top:0px;left:0px;width:771px;height:155px;"></div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:27px;left:62px;width:232px;height:99px;">
                <img
                    src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{14632F67-9520-4ED4-8A68-2107324CDA62}.png"
                    border="0" width="232px" height="99px"></div>
            <div style="z-index:3;clip:rect(0px,771px,54px,0px);top:155px;left:0px;width:771px;height:54px;"></div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:169px;left:546px;width:200px;height:19px;"><span
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
                    <td align="center"><span class="fc1id3qyyfqfr4-1">PRÁCTICAS&nbsp;practica466&nbsp;</span></td>
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
                                Por medio del presente certifico que ggsjkd <span style="font-weight: 800">ddddddd ddddddd ddddddd ddddddd</span>, portador  de la Cédula de Identidad <span style="font-weight: 800">0000000000</span>, estudiante de la carrera de <span style="font-weight: 800">peeeer</span> de la <span style="font-weight: 800">peee2</span>, realizó PRACTICAS <span style="font-weight: 800">sdsssss</span> en lllllllll, institución regentada por la Benemérita Sociedad Protectora de la Infancia, en base al Convenio de Cooperación Interinstitucional entre la sssssss y la Benemérita Sociedad Protectora de la Infancia firmado el lkkkkkkk desde el ffffff al ttttt en el Departamento <span style="font-weight: 800">iiiiii</span>, completando un total de <span style="font-weight: 800">ppppppp horas</span>. 
                            </p>
                        </td>
                    </tr>
                </table>
                
                <table width="623px" border="0" cellpadding="0" cellspacing="0">
                    <td align="justify"><span
                            class="fc1id3qyyfqfr4-0">Lo&nbsp;que&nbsp;se&nbsp;certifica&nbsp;para&nbsp;fines&nbsp;académicos.</span>
                    </td>
                </table>
            </div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:50;top:702px;left:75px;width:125px;height:15px;">
                <table width="125px" border="0" cellpadding="0" cellspacing="0">
                    <td align="left"><span class="fc1id3qyyfqfr4-0">Atentamente,</span></td>
                </table>
            </div>
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:716px;left:62px;width:291px;height:166px;">
                <img
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
            <div class="ad1id3qyyfqfr4-0" nowrap="true" style="z-index:25;top:1044px;left:68px;width:300px;height:50px;">
                <img
                    src="{{ base_path() }}/public/img/reportes/certificado/rptReporteFinal{5E6B781A-68CD-44E0-854B-0E3923B35E67}.png"
                    border="0" width="300px" height="50px"></div>
        
            <div id="pageNavigator" style="top:1100px;left:0px;font-style:italic;font-weight:100;font-size:smaller">
            </div>
        </div> --}}
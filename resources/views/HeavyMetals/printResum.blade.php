<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <style type="text/css">
        .cabecera {
            background: #e0eff5; font-weight: 500; text-align: center;
        }
    </style> --}}
</head>
<body>
    <table>
        <thead>
            <tr><td colspan="12"></td></tr>
            <tr>
                <td colspan="12" style="font-size: 20px; border: 3px solid #807d7d; font-weight: 500; text-align: center;">DIRESA PASCO DEIT</td>
            </tr>
            <tr><td colspan="12"></td></tr>
            <tr>
                <td colspan="12" style="font-size: 18px; border: 3px solid #807d7d; font-weight: 500; text-align: center;">Atención Integral {{ $year }}</td>
            </tr>
            <tr><td colspan="12"></td></tr>
            <tr><td colspan="12"></td></tr>
        </thead>
        <thead>
            <tr>
                <th style="background: #c9d0e2; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">#</th>
                <th style="background: #c9d0e2; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Región</th>
                <th style="background: #c9d0e2; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Provincia</th>
                <th style="background: #c9d0e2; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Distrito</th>
                <th style="background: #F0B0AF; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Medicina</th>
                <th style="background: #CBF0BB; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Enfermería</th>
                <th style="background: #F0AFEC; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Obstetricia</th>
                <th style="background: #F0E5BB; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Psicología</th>
                <th style="background: #EDF8FF; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Cred</th>
                <th style="background: #b7d5f6; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Odontología</th>
                <th style="background: #dac5ff; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Telemonitoreo</th>
                <th style="background: #b7fffc; font-weight: 500; text-align: center; border: 3px solid #A6A6A6;">Vacuna</th>
            </tr>
        </thead>
        <tbody>
            {{-- <td><img src="{{URL::asset('/images/avartar.png')}}" /></td> --}}
            @foreach($list as $pr)
                <tr>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $loop->iteration }}</td>
                    <td style="border: 3px solid #A6A6A6;">{{ $pr->region_current }}</td>
                    <td style="border: 3px solid #A6A6A6;">{{ $pr->province_current }}</td>
                    <td style="border: 3px solid #A6A6A6;">{{ $pr->district_current }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->MEDICINE }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->NURSE }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->OBSTE }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->PSYCOLOGY }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->CRED }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->ODONTOLOGY }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->TELEMEDICINE }}</td>
                    <td style="text-align: center; border: 3px solid #A6A6A6;">{{ $pr->VACUNA }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
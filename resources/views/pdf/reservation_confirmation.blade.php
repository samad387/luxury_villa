<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            line-height: 1.5;
            font-size: 14px;
        }
        .header {
            width: 100%;
            margin-bottom: 40px;
        }
        .header td {
            vertical-align: top;
        }
        .text-blue {
            color: #3b82f6; /* Tailwind blue-500 equivalent approx */
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .font-bold {
            font-weight: bold;
        }
        .company-info {
            text-align: center;
            font-weight: bold;
            margin-bottom: 40px;
            font-size: 14px;
            line-height: 1.4;
        }
        .subject {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 40px;
        }
        .client-info {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 30px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 4px 0;
            font-size: 14px;
        }
        .details-table td:first-child {
            width: 40%;
        }
        .details-table td:last-child {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <table class="header">
        <tr>
            <td class="text-blue font-bold" style="font-size: 16px;">
                Service immo Morad
            </td>
            <td class="text-right font-bold" style="font-size: 14px;">
                Marrakech, le {{ now()->translatedFormat('d F Y') }}
            </td>
        </tr>
    </table>

    <div class="company-info">
        SERVICE IMMO MORAD SARL AU.<br>
        DOMIC. CHEZ RTE DE SAFI LOT AL<br>
        MASSAR N°801 , APPT N°3 MARRAKECH
    </div>

    <div class="subject">
        Objet :Lettre de Confirmation de reservation
    </div>

    <div class="client-info">
        Monsieur/Madame: {{ $reservation->name }}
    </div>

    <table class="details-table">
        <tr>
            <td>Référence</td>
            <td>{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
        <tr>
            <td>Nombres de personnes</td>
            <td>{{ $reservation->guests_count ?? '-' }}</td> 
        </tr>
        <tr>
            <td>Type de propriété</td>
            <td>{{ $reservation->reservation_type }} - {{ $reservation->item_name }}</td>
        </tr>
        <tr>
            <td>Adresse</td>
            <td>Marrakech</td>
        </tr>
        <tr>
            <td>Date d'arrivée</td>
            <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Date de départ</td>
            <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Montant avance</td>
            <td>{{ $reservation->advance_payment ? number_format($reservation->advance_payment, 2, ',', ' ') . ' €' : '-' }}</td>
        </tr>
        <tr>
            <td>Montant restant</td>
            <td>{{ ($reservation->total_payment && $reservation->advance_payment) ? number_format($reservation->total_payment - $reservation->advance_payment, 2, ',', ' ') . ' €' : '-' }}</td>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td>{{ $reservation->total_payment ? number_format($reservation->total_payment, 2, ',', ' ') . ' €' : '-' }}</td>
        </tr>
    </table>

</body>
</html>

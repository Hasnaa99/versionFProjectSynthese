<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* Styles for screen */
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid black;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    @media print {
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .header{
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .header .Titre2 {
            margin-top: 15px;

        }
        .header .textMs{
            text-align: center;
        }
        .info-section{
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
       
    }
  
    </style>
</head>
<body>
<div class="container vh-200">
    <div class="header">
        <img src="{{ asset('images/Logo_ofppt.png') }}" width="8%" alt="Logo OFPPT">
        <h2>Procès Verbal de Fin de Module</h2>
        <div class="Titre2">
            <strong style="font-size: 0.7rem">Direction Régionale</strong>
            <p class="textMs"><strong style="font-size: 0.7rem">Marrakech-Safi</strong></p>
        </div>
    </div>
    <div>
        <p><strong>Etablissement :</strong> INSTITUT SPECIALISE DE TECHNOLOGIE APPLIQUEE NTIC SAFI</p>
    </div>
    <div class="info-section">
        <div class="left-info">
            <p><strong>Filière :</strong> {{ $groupe->specialite }}</p>
            <p><strong>Groupe de formation :</strong> {{ $groupe->codeG }} ({{ $groupe->niveauF }} année)</p>
            <p><strong>Intitulé du module :</strong> {{ $module->intitule }} ({{ $module->codeM }})</p>
        </div>
        <div class="right-info">
            <p><strong>Année de formation :</strong> {{ $groupe->annee_scolaire }}</p>
            <p><strong>Niveau :</strong> {{ $groupe->niveau }}</p>
            <p><strong>Inscrits :</strong> {{ $groupe->stagiaires->count() }}</p>
        </div>
    </div>
    <hr />
    <table class="table">
        <thead>
            <tr class="text-center">
                <th>CEF</th>
                <th>Nom & Prénom</th>
                @foreach ($evaluations as $evaluation)
                    <th>{{ $evaluation->type == 'EFM' ? 'EFM' : 'CC' . $evaluation->numero_ctrl }}</th>
                @endforeach
                <th>Moy Module/20</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupe->stagiaires as $stagiaire)
                <tr class="text-center">
                    <td>{{ $stagiaire->cef }}</td>
                    <td>{{ $stagiaire->nom . ' ' . $stagiaire->prenom}}</td>
                    @foreach ($evaluations as $evaluation)
                        <td style="width:12%">
                            <?php
                            if (isset($stagiaire) && isset($evaluation)) {
                                $existingNote = App\Models\Notation::where('stagiaire_id', $stagiaire->id)
                                    ->where('evaluation_id', $evaluation->id)
                                    ->first();
                                echo $existingNote ? $existingNote->note : '';
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                    @endforeach
                    <td>{{ number_format($moyennes[$stagiaire->id], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
    <table class="table text-center">
        <tr class="text-center">
            <th>Formateur(s)</th>
            <th>Directeur Pédagogique <br> Déricteur d'EFP</th>
        </tr>
        <tr class="text-center">
            <td style="padding:50px 0"></td>
            <td style="padding:50px 0"></td>
        </tr>
    </table>
    <p>Fait à ..................................... le . . / . . / . . . .</p>
</div>
</body>
</html>
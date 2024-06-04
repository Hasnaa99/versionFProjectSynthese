<style>
    p {
        font-size: 0.9rem;
    }

    h1 {
        color: rgb(38, 78, 14);
    }

    .input_notes {
        /* Base styles */
        width: 40%;
        text-align: center;
        padding: 2px;
        border: 1px solid #ccc;
        border-radius: 4px;
        outline: none;
        font-size: 14px;

        /* Focus styles */
        &:focus {
            border-color: #4a7c59;
            /* Change border color on focus */
            box-shadow: 0 0 3px rgba(74, 124, 89, 0.5);
            /* Add a subtle shadow */
        }
    }

    table {

        width: 100%;
        margin: 20px auto;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

    }

    thead {
        background-color: #578d67;
        color: #fff;
        text-align: center;
        font-weight: bold;
    }

    th {
        padding: 15px;
        border: 1px solid #ddd;
    }

    tbody {
        background-color: #f8f9fa;
    }

    tr {
        border-bottom: 1px solid #ddd;
    }

    td {
        padding: 12px;
        border: 1px solid #ddd;
    }

    .d-flex .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .d-flex .btn1 {
        background-color: #23906b;
        color: #fff;
        transition: background-color 0.3s ease-in-out;
    }

    .d-flex .btn1:hover {
        background-color: #46a384;
    }

    .d-flex .btn2 {
        background-color: #23906b;
        color: #fff;
        transition: background-color 0.3s ease-in-out;
    }

    .d-flex .btn2:hover {
        background-color: #49b491;
    }

    .add-evaluation {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        background-color: #578d67;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .add-evaluation i {
        margin-right: 5px;
    }

    .add-evaluation:hover {
        background-color: #426b4f;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

<x-master title="Module Details">
    <div class="container vh-200">
        <form method="POST" action="{{ route('save_notes') }}" enctype="multipart/form-data">
            @csrf
            <div class="header d-flex justify-content-between mt-3">
                <img src="{{ asset('images/Logo_ofppt.png') }}" width="8%" alt="Logo OFPPT">
                <div class="mt-2">
                    <strong style="font-size: 0.9rem">Direction Régionale</strong>
                    <p class=" text-center"><strong style="font-size: 0.9rem">Marrakech-Safi</strong></p>
                </div>
            </div>

            <h1 style="font-size: 1.9rem" class="my-2 mb-4 text-center">Procès Verbal de Fin de Module</h1>

            <div>
                <p><strong>Etablissement :</strong> INSTITUT SPECIALISE DE TECHNOLOGIE APPLIQUEE NTIC SAFI</p>
            </div>
            <div class="info-section d-flex justify-content-between">
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


            <a class="add-evaluation text-white text-decoration-none"
                href="{{ route('create_evaluation', ['groupe_id' => $groupe, 'module_id' => $module]) }}">
                <i class="fas fa-plus-circle"></i> Ajouter évaluation
            </a>
            @if (session()->has('succcess'))
                <div class="alert alert-success my-2">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger my-3">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table ">
                <thead>
                    <tr class="text-center">
                        <th>CEF</th>
                        <th>Nom</th>
                        <th>Prénom</th>
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
                        <td>{{ $stagiaire->nom }}</td>
                        <td>{{ $stagiaire->prenom }}</td>
                        @foreach ($evaluations as $evaluation)
                            <td style="width:12%">
                                <?php
                                $existingNote = App\Models\Notation::where('stagiaire_id', $stagiaire->id)
                                    ->where('evaluation_id', $evaluation->id)
                                    ->first();
                                ?>
                                <input type="text"
                                    name="notes[{{ $stagiaire->id }}][evaluation_{{ $evaluation->id }}]"
                                    class="evaluationInput input_notes" data-row="{{ $loop->parent->index }}"
                                    data-column="{{ $loop->index }}"
                                    value="{{ $existingNote ? $existingNote->note : '' }}">
                            </td>
                        @endforeach
                        <td>{{ number_format($moyennes[$stagiaire->id], 2) }}</td>
                    </tr>
                    @endforeach
                    </tbody>

            </table>
            <div class="d-flex mt-4">
                <button type="submit" class="btn btn2 text-white mx-2">Sauvegarder les notes</button>
                <button type="reset" class="btn btn1 text-white  mx-2">Annuler</button>
                @if (session('notes_saved'))
                    <a class="btn btn1 text-white mx-2" href="{{ route('impression', ['groupe' => $groupe->id, 'module' => $module->id]) }}" target="_blank">Imprimer</a>
                @endif     
            </div>
            <h5 class="mt-4" style="color: rgb(38, 78, 14)">INJECTION DES NOTES</h5>
            <hr/>
        </form>
    </div>
</x-master>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.evaluationInput');
        inputs.forEach(input => {
            input.addEventListener('keydown', function(event) {
                const rowIndex = parseInt(input.dataset.row);
                const colIndex = parseInt(input.dataset.column);
                if (event.key === 'ArrowUp' || event.keyCode === 38) {
                    event.preventDefault();
                    const prevRowInput = document.querySelector(
                        `.evaluationInput[data-row="${rowIndex - 1}"][data-column="${colIndex}"]`
                    );
                    if (prevRowInput) {
                        prevRowInput.focus();
                    }
                } else if (event.key === 'ArrowDown' || event.keyCode === 40) {
                    event.preventDefault();
                    const nextRowInput = document.querySelector(
                        `.evaluationInput[data-row="${rowIndex + 1}"][data-column="${colIndex}"]`
                    );
                    if (nextRowInput) {
                        nextRowInput.focus();
                    }
                }
            });
        });
    });
    
</script>

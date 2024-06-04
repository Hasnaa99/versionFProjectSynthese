<style>
    .custom-button {
        background-color: #4a7c59;
        color: #fff;
        border: 0;
        border-radius: 5px;
        padding: 7px;
        cursor: pointer;
    }

    .custom-button:hover {
        background-color: #6e977a;
    }
</style>

<x-master title="Acceuil">
    <div class="container vh-100">
        <h2 class="text-center mt-4" style="color: #073515; font-weight: 600;">Bienvenue</h2>
        <p class="text-center m-4" style="color: #70c927; font-weight: 500;">
            {{ Auth::user()->prenom }} {{ Auth::user()->nom }} (Matricule : {{ Auth::user()->matricule }})
        </p>
        <h2 class="text-center mt-4" style="color: #073515; font-weight: 600;">Choix de groupe</h2>

        <div class="text-center mt-4">
            <form action="{{ route('acceuil') }}" method="GET">
                <select name="groupe" class="form-select form-select-lg mb-2 mx-auto" style="width: 600px;" aria-label=".form-select-lg example">
                    <option value="">Sélectionner un groupe</option>
                    @foreach ($groupes as $groupe)
                        <option value="{{ $groupe->codeG }}" {{ $selectedGroup && $selectedGroup->codeG == $groupe->codeG ? 'selected' : '' }}>
                            {{ $groupe->codeG }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="custom-button" style="margin-right: -430px;">Afficher les modules</button>
            </form>
        </div>

        @if ($selectedGroup)
            <h2 class="text-center mt-4 mb-4" style="color: #073515;">Modules associés au groupe {{ $selectedGroup->codeG }}</h2>
            <ul class="list-group w-50 mx-auto">
                @forelse ($modules as $module)
                    <li class="list-group-item">
                        <a href="{{ route('module.show', ['groupe' => $selectedGroup->id, 'module' => $module->id]) }}" class="d-block text-decoration-none text-dark module-link">
                            {{ $module->intitule }}
                        </a>
                    </li>
                @empty
                    <p class="text-center text-muted">Aucun module associé à ce groupe.</p>
                @endforelse
            </ul>
        @endif
    </div>
</x-master>






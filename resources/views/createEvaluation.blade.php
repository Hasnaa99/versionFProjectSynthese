<style>
    .form-label {
        color: #26580E;
        font-weight: 500;
    }

    .btn {
        background-color: #4a7c59;
        color: #fff;
    }

    .btn:hover {
        background-color: #6e977a;
    }

    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
    }

    .titre {
        color: #26580E;
        font-size:2rem;
    }

    .form-control,
    .form-select {
        border-radius: 5px;
        border: 1px solid #dcdcdc;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        border-color: #4a7c59;
    }
</style>

<x-master title="Ajouter Évaluation">
    <div class="container vh-125">
        <h1 class="text-center my-4 titre" style="color: #214411;">Ajouter une évaluation</h1>
        <form action="{{route('store_evaluation')}}" method="POST" class="p-4 w-50 mx-auto mb-5" style="border: 1px solid #dcdcdc; border-radius: 8px;">
            @csrf
            <input type="hidden" name="groupe_id" value="{{ $groupe->id }}">
            <input type="hidden" name="module_id" value="{{ $module->id }}">
            <div class="mb-3">
                <label for="numero_ctrl" class="form-label">Numéro de contrôle</label>
                <input type="text" name="numero_ctrl"  class="form-control" placeholder="Entrer le numéro de contrôle" value="{{old('numero_ctrl')}}"/>
                @if ($errors->has('numero_ctrl'))
                    <div class="text-danger my-2">
                        {{ $errors->first('numero_ctrl') }}
                    </div>
                @endif
  
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                @if ($errors->has('date'))
                    <div class="text-danger">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="duree" class="form-label">Durée</label>
                <input type="number" name="duree" id="duree" class="form-control" placeholder="Entrer la durée" value="{{ old('duree') }}" required>
                @if ($errors->has('duree'))
                    <div class="text-danger">
                        {{ $errors->first('duree') }}
                    </div>
                @endif
            </div>
            
            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            <div class="text-center">
                <button type="submit" class="btn" style="background-color: #4a7c59; color: #fff;">Ajouter Évaluation</button>
            </div>
        </form>
    </div>
</x-master>

<x-master title="Mon compte">
    <style>
        .card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin:30px;
        }
        .card-title {
            margin-bottom: 20px;
            color: #318d15;
        
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .form-label {
            color: #0d5218;
            font-weight: 500;
        }

        .btnV {
            background-color: #39a518;
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            font-size: 18px;
            margin-top: 20px;
        }

        .btnV:hover {
            background-color: #5bbb3d;
        }
   
    </style>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    
                        <h4 class="card-title text-center">Informations de compte</h4>
                        <p class="card-text">Matricule : {{ $formateur->matricule }}</p>
                        <p class="card-text">Nom : {{ $formateur->nom }}</p>
                        <p class="card-text">Prénom : {{ $formateur->prenom }}</p>
                        <p class="card-text">Email : {{ $formateur->email }}</p>
                        <hr class="mb-4 mt-3">
                        <h4 class="mt-3 mb-4 card-title text-center">Changement de mot de passe</h4>
                        <form method="POST" action="{{ route('formateur.update', $formateur->id) }}">
                            @csrf
                            @method('PATCH')
                            @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                        
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe actuel</label>
                                <input id="password" type="password" class="form-control" name="password"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Nouveau mot de passe</label>
                                <input id="new_password" type="password" class="form-control" name="new_password"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation"
                                    class="form-label">Confirmer le nouveau mot de passe</label>
                                <input id="new_password_confirmation" type="password" class="form-control"
                                    name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btnV text-white">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-master>

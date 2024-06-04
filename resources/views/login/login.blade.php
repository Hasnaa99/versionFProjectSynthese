<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login formateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            background-color: #e8ffe4;
            padding: 25px;
            width: 48%;
            margin: 50px;
            margin-top: 90px;
            border-radius: 15px;

        }

        .button {
            background-color: #23906b;
            color: white;

        }

        .button:hover {
            background-color: #1c644c;
            color: white;
        }

        .titre {
            color: #23906b;
            outline: none;
            font-size: 25px;
            margin-bottom: 20px;
        }

        .header,
        .footer {
            padding: 1rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>

<body>
    <header class="header bg-light">
        <img src="images/Logo_ofppt.png" alt="School Logo" class="img-fluid"
            style="width: 53px;border-radius: 50px; margin:0 30px">
        <img src="images/logo-enotes.png" alt="Platform Logo" class="img-fluid" style="width: 100px;">
    </header>
    <div class='d-flex justify-content-center align-items-center  '>
        <div class='container'>
            <form method="POST" action="{{ route('login') }}" class='w-50 mx-auto'>
                @csrf
                <H1 class='text-center titre'>Authentification</H1>
                <div class="mb-4">
                    <label htmlFor="matricule" class="form-label">Login</label>
                    <input type="text" class="form-control" id="matricule" name="matricule" value="{{ old('matricule') }}"
                        required autocomplete="matricule" autofocus />
                </div>

                <div class="mb-4">
                    <label htmlFor="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required
                        autocomplete="current-password" />

                </div>
                @error('error')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class='text-center mt-3'>
                    <button type="submit" class="btn mb-4 button">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer text-center  ">
        Copyright © OFPPT 2024 - www.ofppt.ma
    </footer>
</body>

</html>

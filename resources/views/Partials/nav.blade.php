<style>
    .nav-link{
        color:#70c927;
        margin: 5px 20px;
        font-weight: 600;
        font-size: 16px;
        display: inline-block;
        transition:0.5s ease;
        position: relative;
    }

    .nav-link::after{
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width:0;
    height: 3px;
    background-color: #23906b;
    transition: 0.5s ease;
    } 
    .nav-link:hover,
    .nav-link:focus {
        color: #23906b;
    }
    .nav-link:hover:after{width:100%;}
</style>
<nav class="navbar navbar-expand-lg" style="background-color: #e0e4cc ;" >
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img  src="{{ asset('images/logo-enotes.png') }}" height="75px"  alt="Votre Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-success"></span>
          </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page"  href="/">Acceuil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('formateur')}}">Mon compte</a>
          </li>
          <li class="nav-item">
            <a id="logout-link" class="nav-link "  href="/logout">Déconnexion</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault(); 
        
        if (confirm("Voulez-vous vraiment vous déconnecter?")) {
            window.location.href = this.getAttribute('href'); 
        }
    });
  </script>
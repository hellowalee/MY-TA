<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Informasi Geografis</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Sistem Informasi Geografis</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">

  <!-- Search Section -->
  <div class="row my-3">
    <div class="col-md-6 offset-md-3">
      <form enctype="multipart/form-data" class="ps-checkout__form" action="/asset/search" method="post">
        @csrf
        <div class="input-group w-100">
          <input id="search" name="search" type="text" class="form-control" placeholder="No Sertifikat / No Registrasi">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Cari Asset</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  @yield('main')
  
</div>

<!-- Footer Section -->
<footer class="footer mt-5 bg-dark text-light">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p>Sistem Informasi Geografis &copy; 2024</p>
      </div>
      <div class="col-md-6 text-right">
        <p>Contact: example@example.com</p>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

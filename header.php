<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
<link rel="stylesheet" href="./style.css">
<style>
     body {
    padding-top: 100px;
    background-color: #fff;
  }
    .navbar-light .navbar-nav .nav-link {
  color: black;
  padding: 8px 20px;
  font-weight: 600;
  transition: all 0.3s ease;
  position: relative;
}

.navbar-light .navbar-nav .nav-link::after {
  content: '';
  position: absolute;
  width: 0;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color:#CBA35C;
  transition: width 0.3s ease;
}

.navbar-light .navbar-nav .nav-link:hover {
  color:#;
  transform: scale(1.05);
}

.navbar-light .navbar-nav .nav-link:hover::after {
  width: 100%;
}

.navbar i {
  font-size: 1.2rem;
  cursor: pointer;
  color: black;
  transition: color 0.3s ease, transform 0.3s ease;
}

.navbar i:hover {
  color: #754E1A;
  transform: scale(1.2);
}

</style>
</head>

<body>
    <?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname='proget_pff';
    $conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo "<script>console.error('Base de données non connectée');</script>";
} else {
    echo "<script>console.log('Base de données contactée');</script>";
}
?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #fff; z-index: 1050; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
  <div class="container">
    <img src="img/logo.1.png" alt="logo" style="height:70px;margin-top:20px;">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i id="bar" class="fas fa-bars" style="color: #333;"></i></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto align-items-center" style="gap: 1rem;">
        <li class="nav-item"><a class="nav-link text-dark" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="boutique.php">Boutique</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="./pd_famme.php">femme</a></li>
        <li class="nav-item"><a class="nav-link text-dark" href="./pd_homme.php">homme</a></li>
       <li class="nav-item search-wrapper d-flex align-items-center" style="position: relative;">
  <i class="fal fa-search" id="search-icon" style="cursor:pointer; font-size: 20px; color: #333;"></i>
  <input type="text" id="search-input" placeholder="search.."
    style="width: 0; opacity: 0; padding: 5px 0; margin-left: 5px; border-radius: 4px; border: 1px solid #ccc; transition: width 0.3s ease, opacity 0.3s ease; text-align: center;">
  
<ul id="search-results" style="
  position: absolute;
  top: 35px;
  left: 0;
  background: white;
  width: 220px;
  border: 1px solid #ccc;
  border-radius: 4px;
  max-height: 250px;
  overflow-y: auto;
  display: none;
  z-index: 1051;
  padding-left: 0;
  list-style: none;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
"></ul>

</li>

        <li class="nav-item"><a href="cart.php"><i class="fal fa-shopping-bag" style="color: #333;"></i></a></li>
        <li class="nav-item"><a href="account.php"><i class="fas fa-user" style="color: #333;"></i></a></li>
      </ul>
    </div>
  </div>
</nav>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const searchIcon = document.getElementById('search-icon');
  const searchInput = document.getElementById('search-input');
  const searchResults = document.getElementById('search-results');

  
  searchIcon.addEventListener('click', () => {
    if (searchInput.style.width === '200px') {
      searchInput.style.width = '0';
      searchInput.style.opacity = '0';
      searchResults.style.display = 'none';
      searchInput.value = '';
    } else {
      searchInput.style.width = '200px';
      searchInput.style.opacity = '1';
      searchInput.focus();
    }
  });

  
  searchInput.addEventListener('input', () => {
    const query = searchInput.value.trim();

    if (query.length < 2) {
      searchResults.style.display = 'none';
      searchResults.innerHTML = '';
      return;
    }

    fetch(`search.php?q=${encodeURIComponent(query)}`)
      .then(response => response.json())
      .then(data => {
        if (data.length === 0) {
          searchResults.innerHTML = '<li style="padding:10px; color:#999;">Aucun résultat</li>';
        } else {
          searchResults.innerHTML = data.map(item => `
            <li style="padding:10px; border-bottom:1px solid #eee; cursor:pointer;">
              <strong>${item.product_name}</strong><br>
              <small>${item.product_description}</small><br>
              <span style="color:#CBA35C;">${item.product_price} €</span> - <em>${item.product_category}</em>
            </li>
          `).join('');
        }
        searchResults.style.display = 'block';
      })
      .catch(() => {
        searchResults.innerHTML = '<li style="padding:10px; color:red;">Erreur de connexion</li>';
        searchResults.style.display = 'block';
      });
  });

  
  document.addEventListener('click', (e) => {
    if (!searchInput.contains(e.target) && !searchIcon.contains(e.target) && !searchResults.contains(e.target)) {
      searchResults.style.display = 'none';
    }
  });
});

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<footer class="mt-5 py-5">
  <div class="row container mx-auto pt-5">
    <div class="footer-one col-lg-3 col-md-6 col-12">
      <p class="pt-3">fringilla urna pottitor rhoncus dolod purus luctus venenatis lectus mogna fringilla diam moecenas ultricies mi eget mauris.</p>
    </div>
    <div class="footer-one col-lg-3 col-md-6 col-12">
      <h5 class="pd-2">en vedette</h5>
      <ul class="text-uppercase list-unstyled">
        <li><a href="http://">hommes</a></li>
        <li><a href="http://">femmes</a></li>
        <li><a href="http://">garcons</a></li>
        <li><a href="http://">filles</a></li>
        <li><a href="http://">nouveaux arrivants</a></li>
        <li><a href="http://">chaussures</a></li>
        <li><a href="http://">chiffons</a></li>
      </ul>
    </div>
        <div class="footer-one col-lg-3 col-md-6 col-12">
      <h5 class="pd-2">contactez-nous</h5>
      <div>
        <h6 class="text-uppercase">address</h6>
        <p>ennasr 2</p>
      </div>
      <div>
        <h6 class="text-uppercase">
          <p>29550272-27120145</p>
        </h6>
      </div>
      <div>
        <h6 class="text-uppercase">Email</h6>
        <p>catchy99@gmail.com</p>
      </div>
  
    </div>
    <div class="footer-one col-lg-3 col-md-6 col-12">
      <h5 class="pd-2">Instagram</h5>
      <div class="row">
        <img class="img-fluid w-25 h-100 m-2 " src="img/insta/1.jpg" alt="">
        <img class="img-fluid w-25 h-100 m-2 " src="img/insta/2.jpg" alt="">
        <img class="img-fluid w-25 h-100 m-2 " src="img/insta/3.jpg" alt="">
        <img class="img-fluid w-25 h-100 m-2 " src="img/insta/4.jpg" alt="">
        <img class="img-fluid w-25 h-100 m-2 " src="img/insta/5.jpg" alt="">
      </div>
    </div>
  </div>
<div class="copyright mt-5">
  <div class="row container mx-auto">
    <div class="col-lg-3 col-md-6 col-12">
      <img src="img/payment.png" alt="">
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <p>catchy99 e-commerce 2016©.accrocheur tous droits réservés</p>
    </div>
    <div class="col-lg-3 col-md-6 col-12">
      <a href="http://"><i class="fab fa-facebook"></i></a>
        <a href="http://"><i class="fab fa-instagram"></i></a>
    </div>
  </div>
</div>
</footer>


<script>
const searchIcon = document.getElementById('search-icon');
const searchInput = document.getElementById('search-input');

searchIcon.addEventListener('click', (e) => {
  e.stopPropagation();
  if (searchInput.style.width === '0px' || searchInput.style.width === '') {
    searchInput.style.width = '180px';
    searchInput.style.opacity = '1';
    searchInput.focus();
  } else {
    searchInput.style.width = '0';
    searchInput.style.opacity = '0';
    searchInput.value = '';
  }
});

document.addEventListener('click', (e) => {
  if (!searchInput.contains(e.target) && !searchIcon.contains(e.target)) {
    searchInput.style.width = '0';
    searchInput.style.opacity = '0';
    searchInput.value = '';
  }
});

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
            integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
            integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
            crossorigin="anonymous"></script>
    </body>

</html>
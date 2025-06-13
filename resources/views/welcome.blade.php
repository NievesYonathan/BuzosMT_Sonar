<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>Buzos Mayte</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('Logo/logo.png') }}" alt="Buzo color negro">

  <link rel="stylesheet" href="{{ asset('css/css-welcome/style.css')}}">

</head>
<body>

<div class="header">
  <h2>Buzos Mayte</h2>
  
  <button class="mid-spot"
      type="button"
      onclick="document.body.classList.toggle('gold');"
      onkeydown="if(event.key === 'Enter' || event.key === ' ') { event.preventDefault(); this.click(); }"
      aria-pressed="false"
      aria-label="Cambiar tema dorado">
  </button>
  
  <button class="contact-btn" onclick="window.location.href='{{ route('register')}}'">
    <span class="glow"></span>
    <span class="contact-btn-content">Registrarme</span>
  </button>
  <button class="contact-btns" onclick="window.location.href='{{ route('login')}}'">
    <span class="glows"></span>
    <span class="contact-btn-contents">Iniciar Sesión</span>
  </button>
  
  <div class="spotlight">
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>

<canvas id="particleCanvas"></canvas>

<div class="accent-lines">
  <div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
  <div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<div class="heroSubP">
  <p>Introducción</p>
</div>
<div class="hero">
  <div class="heroT">
    <h2>Buzos Mayte</h2>
    <h2>Buzos Mayte</h2>
  </div>
</div>
<p class="heroP">La Mejor Calidad <br>
  En Tus Manos</p>
<div class="mountains">
  <div></div>
  <div></div>
  <div></div>
</div>
<div class="hero-spacer"></div>

<div class="content-section">
  <div class="content-acc">
    <div></div>
    <div></div>
  </div>
  <p class="subt">Innovación en cada prenda</p>
  <h3 class="title">Versatilidad sin igual.</h3>
  <p class="subp">
    En el corazón de nuestra empresa, nos dedicamos a la creación de Buzos de alta calidad, <br>
    combinando comodidad y estilo para nuestros clientes. Utilizamos materiales sostenibles y técnicas de confección avanzadas, <br>
    asegurando que cada prenda sea adaptable a cualquier ocasión.
  </p>
</div>

<div class="chuchu">
    <!-- Título principal en la parte superior -->
    <div class="header-title">
    <h2>Nuestro Top 4</h2>
  </div>
  <div class="cards-container">
    <div class="card blue">
      <div class="product">
          <span class="number" style="font-weight: bolder;">01</span>
          <span class="sneakers" style="font-weight: bolder;">BUZOS</span>
          <span class="price" style="font-weight: bolder;">$40.000</span>
          <img src="./Logo/BuzoNegro.png" alt="Buzo color negro">
      </div>
      <div class="title">
          <h2 style="font-weight: bolder;">Buzo Negro</h2>
      </div>
    </div>

    <div class="card purple">
      <div class="product">
          <span class="number" style="font-weight: bolder;">02</span>
          <span class="sneakers" style="font-weight: bolder;">BUZOS</span>
          <span class="price" style="font-weight: bolder;">$40.000</span>
          <img src="./Logo/BuzoRojo.png" alt="Buzo color rojo">
      </div>
      <div class="title">
          <h2 style="font-weight: bolder;">Buzo Rojo</h2>
      </div>
    </div>

    <div class="card white">
      <div class="product">
          <span class="number" style="font-weight: bolder;">03</span>
          <span class="sneakers" style="font-weight: bolder;">BUZOS</span>
          <span class="price" style="font-weight: bolder;">$40.000</span>
          <img src="./Logo/BuzoNaranja.png" alt="Buzo color naranja">
      </div>
      <div class="title">
          <h2 style="font-weight: bolder;">Buzo Naranja</h2>
      </div>
    </div>

    <div class="card green">
      <div class="product">
          <span class="number" style="font-weight: bolder;">04</span>
          <span class="sneakers" style="font-weight: bolder;">BUZOS</span>
          <span class="price" style="font-weight: bolder;">$40.000</span>
          <img src="./Logo/BuzoVerde.png" alt="Buzo color verde">
      </div>
      <div class="title">
          <h2 style="font-weight: bolder;">Buzo Verde</h2>
      </div>
    </div>
  </div>
</div>

<footer class="site-footer">
  <div class="footer-content">
      <div class="footer-section">
          <h4>Escríbenos</h4>
          <p>Mediante nuestras redes sociales, te atenderemos<br> con calidad y compromiso.</p>
      </div>
        <ul class="wrapper">
          <li class="icon facebook">
            <a href="https://facebook.com/tuperfil" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
              <span class="tooltip">Facebook</span>
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="icon whatsapp">
            <a href="https://wa.me/123456789" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
              <span class="tooltip">WhatsApp</span>
              <i class="fab fa-whatsapp"></i>
            </a>
          </li>
          <li class="icon instagram">
            <a href="https://instagram.com/tuperfil" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
              <span class="tooltip">Instagram</span>
              <i class="fab fa-instagram"></i>
            </a>
          </li>
        </ul>
  </div>
  <div class="footer-bottom">
      <p>&copy; 2024 Todos Los Derechos Reservados.</p>
  </div>
</footer>

<!-- partial -->
<script src="{{ asset('js/js-welcome/script.js') }}"></script>

</body>
</html>

<?php 
require('header.php');
?>	
	
<!-- nosso estilo -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--slider-->
<div class="container-fluid">
	<div class="row">
	<div class="col s10 offset-s1">
	<div class="slider">
    <ul class="slides">
      <li>
        <img src="img/Agathacristie.jpg"> <!-- random image -->
        <div class="caption center-align textslider">
          <h3>Agatha cristie</h3>
          <h5 class="light grey-text text-lighten-3">Coletânea Agatha Cristie</h5>
        </div>
      </li>
      <li>
        <img src="img/Desventuras.JPG"> <!-- random image -->
        <div class="caption left-align textslider text-center">
          <h3>Desventuras</h3>
          <h5 class="light grey-text text-lighten-3">Coletânea desventura em serie.</h5>
        </div>
      </li>
      <li>
        <img src="img/harry.jpg"> <!-- random image -->
        <div class="caption right-align textslider text-center">
          <h3>Harry Potter</h3>
          <h5 class="light grey-text text-lighten-3">Coletânea amazon Harry Potter.</h5>
        </div>
      </li>
    </ul>
    </div>
  </div>
  </div>	
	
	<!--carousel-->
	
	<div class="row">
		<div class="col s2 offset-s5">
			<h3>DESTAQUES</h3>
		</div>
	</div>
	<div class="row dekt">
	 <div class='col s12'>
		<div class="col s1" class="proximoCard">
			<a href="#1">
				<i class="material-icons" id="previous">keyboard_arrow_left</i>
			</a>
		</div>
		<div class="col s10" id="tudo">
			<div class="carousel desk">
			  <?php ProdutosCarousel();?>
		  	</div>
		  	
		  </div>
		  <div class="col s1" class="proximoCard">
		  	<a href="#2">
		  		<i class="material-icons" id="next">keyboard_arrow_right</i>
		  	</a>
		  </div>
	  </div>
  </div>
  <!-- carou sel mobile -->

  <div class="row">
		<div class="col s3 offset-s5">
			<h4>MENORES PREÇOS</h4>
		</div>
	</div>
  <div class="row">
  <div class='col s1'></div>
  <?php
  	menoresPrecos();
  ?>
  </div>
  <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">BookNow</h5>
                <p class="grey-text text-lighten-4">O universo de cada um se resume no tamanho de seu saber.<br><i>Albert Einstein</i></p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Siga-nos</h5>
                <ul>
                  <div class='col s1'><a class="grey-text text-lighten-3" href="#!">
                    <img src='img/face.png' class='iconSo'>
                  </a></div>
                  <div class='col s1 offset-s1'><a class="grey-text text-lighten-3" href="#!">
                    <img src='img/insta.png' class='iconSo'>
                  </a></div>
                  <div class='col s1 offset-s1'><a class="grey-text text-lighten-3" href="#!">
                    <img src='img/tt.png' class='iconSo'>
                  </a></div>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2018 BookNow
            <a class="grey-text text-lighten-4 right" href="#!">Entre em contato</a>
            </div>
          </div>
        </footer>
  	<!-- jquery -->
	<script src="js/jquery.min.js"></script>
	<!--jquery para busca-->
	<script src="js/jquery.autocomplete.js"></script>
	<script>
    		var data = [ <?php busca(); ?> ];
				$("#pesquisa").autocomplete(data, {
				  formatItem: function(item) {
				    return item.text;
				  }
				}).result(function(event, item) {
				  location.href = item.url;
			});
   
  </script>
	</script>
	<!--maaterialize js-->
	<script type="text/javascript" src="js/materialize.js"></script>
	<!--nosso script -->
  	<script src="js/script.js"></script>

	
	

</body>
</html>
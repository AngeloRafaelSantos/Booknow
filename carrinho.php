<?php 
require('save/header2.php');
carrinho(); ?>
  <!-- nosso estilo -->
	<link rel="stylesheet" type="text/css" href="css/style.css">	
	<!-- jquery -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
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
	<!-- pagseguro-->
	<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
	<!--maaterialize js-->
	<script type="text/javascript" src="js/materialize.js"></script>
	<!--nosso scriipt -->
  	<script src="js/script.js"></script>

</body>
</html>
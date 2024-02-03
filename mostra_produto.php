<?php 
require('header.php');
GerarPaginaProduto();
?>
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
	<!-- script materialize -->
	<script src="js/materialize.min.js"></script>
	<!-- nosso script -->
	<script src="js/script.js"> </script>
</body>
</html>
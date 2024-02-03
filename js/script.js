                                                          // script do carousel
                                                          
	$('.desk').ready(function(){
	        $('.desk').carousel({
	        	dist:0,
	        	shift:50,
	        	padding:100,
	        	});
	        $('#next').click(function(){
	        	$('.desk').carousel('next');
	        });
	        $('#previous').click(function(){
	        	$('.desk').carousel('prev');
	        });
    	});
    	
    	$('.carousel.carousel-slider').carousel({fullWidth: true});
    	
                                                        // efeito dropdown do menu
                                                        
    	$('.dropdown-button').dropdown({
		      hover: true, 
		      inDuration: 500,
		    }
		 );
                                                                
                                                                // slider
                                                                
    	 $(document).ready(function(){
      		$('.slider').slider();
    	});
    
                                                          // chamar menu lateral
                                                          
    	$(".button-collapse").sideNav();


                                                          // script pagina perfil

                                                      //gatilho para execução do modal
                                                      
$(document).ready(function(){
  $('.modal').modal();
});
                                                            //pre load imagens
                                                            
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(a) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
//foto livro
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#foto_livro').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp2").change(function() {
  readURL(this);
});

                                                // abilitar functin select no formulario

$(document).ready(function() {
    $('select').material_select();
  });

                                                    //função para validar senha

function validarSenha(){
        senha = document.signup.senha.value;
        c_senha = document.signup.c_senha.value;
        if (senha != c_senha){ 
             alert("SENHAS DIFERENTES!\nFAVOR DIGITAR SENHAS IGUAIS");
             return false;
       
       }else{
      document.signup.submit();
   }

}

                                                    //função aceitar numeros decimais

$("icon_telephone").on("change",function(){
   $(this).val(parseFloat($(this).val()).toFixed(2));
});

                               
                                                      // Mostra quantidade carrinho

setInterval(function(){
  let car = JSON.parse(localStorage.getItem('car')) || [];
  $('#carquant').text(car.length);
}, 100);

                                                    // Adiciona item para carrinho
                                                    
$('.addCart').on('click', function(){
  // Add na sessao do js
  // pega carrinho
  let car = JSON.parse(localStorage.getItem('car')) || [];
  // pega id e nome do livro
  let id = parseInt($(this).data('id'));
  let livro = $(this).data('livro');
  let valor = $(this).data('valor');
  
  // checa se tem no carrinho
  if($.inArray(id, car) != -1){
    Materialize.toast(`Produto '${livro}' ja esta no carrinho`, 4000, 'red');
    // para a execucao do metodo
    return false;
  }
  
  // joga id para vetor de ids
  car.push(id);
  
  localStorage.setItem('car', JSON.stringify(car));
  // Ajax
  $.ajax({
    url: 'autenticacao/functions.php?func=session',
    method: 'post',
    data: { sessaoCar: JSON.stringify(car) }
  }).done(function(resp){
    // NOTIFICA USUARIO
    Materialize.toast(`'${livro}' adicinado ao carrinho`, 4000);
  }).fail(function(){
    console.log('deu pau');
  });
  
});


                                                        // rmover intem do carrinho
                                                        
$('.removeCart').on('click', function(){
  // pega carrinho
  let car = JSON.parse(localStorage.getItem('car')) || [];
  // pega id e nome do livro
  let id = parseInt($(this).data('id'));
  let livro = $(this).data('livro');
  // pega pisição 
  let pr  = $.inArray(id, car);
  car.splice(pr,1);
  localStorage.setItem('car', JSON.stringify(car));
  // Ajax
  $.ajax({
    url: 'autenticacao/functions.php?func=session',
    method: 'post',
    data: { sessaoCar: JSON.stringify(car) }
  }).done(function(resp){
    // NOTIFICA USUARIO
    Materialize.toast(`Produto '${livro}' removido do carrinho`, 4000);
    $('#book'+id).slideUp(600).clear();
  }).fail(function(){
    console.log('deu pau');
  });
});
                          
                          // não é possivel adicionar no carrinho produto que é anunciado pelo proprio usuario 
                          
$('.seuProduto').on('click', function() {
    Materialize.toast('Não é possivel adicionar seu proprio produto ao carrinho', 5000, 'red')
})
                                                  
                                                  // fucao anota pedido
                                                  
$('.comprar').on('click', function(){
   var frete = $('#frete').val();
  $.post('autenticacao/salvarpedido.php?func=salvar','',function(idPedido, frete){
	     $('#loading').css("visibility","visible");
	      
	     $.post('autenticacao/pagseguro.php',{idPedido: idPedido, frete:frete},function(data){
	
	       $('#code').val(data);
	       $('#comprar').submit();
	
	       $('#loading').css("visibility","hidden");
	       
	     })
	   })
	   
})
                                
                                             // calculo do frete

$('.envia').on('click', function(){
      var destino = $('#destino').val();
      var origem = $('#origem').val();
      $('#carregando').css('visibility' , 'visible');
      $.post('autenticacao/functions.php?func=correios',{destino: destino, origem:origem},function(data){
       $('#carregando').css('visibility' , 'hidden');
       $('#conteudo').html(data);
       
         
      });
  });                                            

// collapse
var coll = document.getElementsByClassName("collasible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
<div class="grid-100" style="padding: 0px;" >
<?php  
		  foreach ($dadosQuiz as $quizzes) {	
		?>

		  <a style="text-decoration: none;" href="frmQuizId.php?id=<?=$quizzes["id"]?>">
		  	<div class="grid-20 people"  > 
				<p class="textoUpImagem" >
				  <?=$quizzes["titulo"]?>		
				</p>
			
				<div class="zoom">
				  <img class="imagemQuiz img-responsive" width="100%" height="100%" src="<?=$quizzes["foto"]?>">
				  </div>
				<!--  <p class="textoUpImagem"><?=$quizzes["categoria"]?></p>  -->
				</p>
		  </a>
		  </div>
		<?php
		  }
		?>
		</div>
		<?php }
		?>
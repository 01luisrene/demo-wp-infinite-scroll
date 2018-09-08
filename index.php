 <?php get_header( ); ?>
	<section class="container">
		<div id="articles" class="row">

				<?php
				//**********Comienza el bucle**********
				if ( have_posts() ) : while ( have_posts() ) : the_post();
				?>
				<article class="col-12 article-item">
					<h2><?php the_title( ); ?></h2>
					<p><?php the_excerpt(); ?></p>
				</article>
				<?php
					// Detiene el ciclo (pero ten en cuenta el "else:" - vea la siguiente linea).
			 		endwhile;
				else :
					echo '<h4 class="p-4 mt-4 mb-4 message-error">Lo sentimos, no hay publicaciones para mostrar.</h4>';
					//REALMENTE detén del ciclo.
				endif;
				 ?>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-8">
				<?php
					the_posts_pagination( array(
				 	 	'screen_reader_text' 					=> 'Navegación de entradas',
						'prev_text'										=> '&laquo;',
						'next_text'										=> '&raquo;',
				 	 ) );
				 ?>
				 <!--HTML Infinite Scroll-->
				 <div class="page-load-status" style="display: none;">
				  <div class="infinite-scroll-request loader-ellips">
				    <span class="loader-ellips__dot"></span>
				    <span class="loader-ellips__dot"></span>
				    <span class="loader-ellips__dot"></span>
				    <span class="loader-ellips__dot"></span>
				  </div>
				  <p class="infinite-scroll-last text-center">Fin del contenido</p>
				  <p class="infinite-scroll-error text-center">No hay más páginas para cargar</p>
				</div>
			</div>
		</div>
	</section>
<?php get_footer( ); ?>

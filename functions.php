<?php
//Cargamos nuestros archivos CSS y JS
function add_css_js(){
	//Librería CSS de Bootstrap
	wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
	//Cargo el fichero (style.css), que se encuentra alojado en la raíz del proyecto
	wp_enqueue_style('style', get_stylesheet_uri());

	//Quito la librería jQuery antigua que se agrega por defecto
	wp_deregister_script('jquery');
	//Librería JS jQuery
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', null, '3.3.1', false);

	//Librería JS Infinite Scroll
	wp_register_script(
	'infinite_scroll',
	get_template_directory_uri() . '/js/infinite-scroll.pkgd.min.js',
	array('jquery'),
	'3.0.5',
	true
	);

	//Validar para que cargue solo en el home
	/*
	Este código es solo de ejemplo puedes agregar
	las condiciones que quieras (is_author(), is_archive(), ...) o quitarla
	*/

	if ( is_home() ):
		wp_enqueue_script( 'infinite_scroll' );
	endif;
}
add_action('wp_enqueue_scripts', 'add_css_js');

//Agregamos el código JavaScript de Infinite Scroll en el wp_footer
function script_infinite_scroll() {
	//Validar para que el script cargue solo en el home
	/*
	Este código es solo de ejemplo puedes agregar
	las condiciones que quieras (is_author(), is_archive(), ...) o quitarla
	*/
	if ( is_home() ):
		echo '
			<script>
			//Contenedor de los ítems
			var $container = jQuery("#articles").infiniteScroll({
				append: "article", //ítems
				path: ".next", //Clase que envía a la siguiente página
				status: ".page-load-status", //Contenedor de los estados
				hideNav: ".pagination", //Contenedor de la paginación a ocultar
				//history: false //Habilita esta opción para no actualizar el historial y la URL utiliza
			});

			//Usar eventos de infinite scroll de v2
			$container.on( "load.infiniteScroll", function( event, response, path, items ) {
				console.log( "Cargando página: " + path );
			});
		</script>
		';
	endif;
}
add_action( 'wp_footer', 'script_infinite_scroll', 100 );
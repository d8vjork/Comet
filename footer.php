		</div><!-- /c2 -->
		
		<div id="c3">

			<?php get_sidebar('right'); ?>

		</div><!-- /c3 -->

		<div id="footer">
	
			<a href="https://unikia.es" target="_blank" rel="external" title="Diseño web por Unikia"><img src="https://unikia.es/images/unikia_alt.png" alt="Diseño web por Unikia" style="width:88px"></a>
	
			<?php
			$fp_options = get_option('fp_options');
			
			echo $fp_options['fp_footer'];
			?>
		
		</div><!-- /footer -->
		
	</div><!-- /content -->

</div><!-- /wrap -->

<?php wp_footer(); ?>

</body>
</html>
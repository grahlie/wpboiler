<?php
/**
 * Input creation for theme-settings
 *
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

/**
 * Creates different input types for page-settings
 *
 * @param array $item data.
 * @param array $parent parent.
 */
function grahlie_create_input( $item, $parent ) {
	$grahlie_values = get_option( 'grahlie_framework_values' );
	$name           = 'grahlie_framework_values[' . $item['id'] . ']';

	// Text input.
	if ( 'text' === $item['type'] ) {
		$output = '';
		if ( isset( $grahlie_values[ $item['id'] ] ) ) {
			$val = 'value="' . $grahlie_values[ $item['id'] ] . '"';
		}

		$output = '<input type="text" id="' . $item['id'] . '" name="' . $name . '" ' . $val . '/>';

		return $output;
	}

	// Textarea.
	if ( 'textarea' === $item['type'] ) {
		$val    = '';
		$output = '';

		if ( isset( $grahlie_values[ $item['id'] ] ) ) {
			$val = $grahlie_values[ $item['id'] ];
		}

		$output = '<textarea id="' . $item['id'] . '" name="' . $name . '">' . stripslashes( $val ) . '</textarea>';

		return $output;
	}

	// Checkbox.
	if ( 'checkbox' === $item['type'] ) {
		$val    = '';
		$output = '';

		if ( array_key_exists( $item['id'], $grahlie_values ) && 'on' === $grahlie_values[ $item['id'] ] ) {
			$val = ' checked="checked"';
		} else {
			$val = '';
		}

		$output .= '<input type="hidden" name="' . $name . '" value="off" />';
		$output .= '<input type="checkbox" id="' . $item['id'] . '" name="' . $name . '" value="on" ' . $val . ' /> ';

		return $output;
	}

	// Radio.
	if ( 'radio' === $item['type'] && array_key_exists( 'options', $item ) ) {
		$i      = 1;
		$output = '';

		$output .= '<input name="' . $name . '" type="hidden" value="0">';

		foreach ( $item['options'] as $key => $value ) {
			if ( array_key_exists( $item['id'], $grahlie_values ) && $key === $grahlie_values[ $item['id'] ] ) {
				$val = 'checked="checked"';
			} else {
				$val = '';
			}

			$output .= '<label class="input_radio" for="' . $item['id'] . '_' . $i . '"><input type="radio" id="' . $item['id'] . '_' . $i . '" name="' . $name . '" value="' . $key . '" ' . $val . '/>' . $value . '</label>';
			$i++;
		}

		return $output;
	}

	// Select.
	if ( 'select' === $item['type'] ) {
		$output = '';

		if ( array_key_exists( 'options', $item ) ) {

			$ouput .= '<select id="' . $item['id'] . '" name="' . $name . '">';
			foreach ( $item['options'] as $key => $value ) {
				$val = '';

				if ( isset( $item['id'] ) && $grahlie_values[ $item['id'] ] === $key ) {
					$val = 'selected="selected"';
				}

				$ouput .= '<option value="' . $key . '" ' . $val . '>' . $value . '</option>';
			}
			$ouput .= '</select>';

		} elseif ( array_key_exists( 'wppage', $item ) && '' !== $item['wppage'] ) {

			if ( '' !== $parent ) {
				$options = count( $parent['sync'][0]['options'] );
			} else {
				$options = 1;
			}

			for ( $i = 1; $i <= $options; $i++ ) {
				$val = '';

				$output .= '<select id="' . $item['id'] . '_' . $i . '" name="' . $name . '[' . $i . ']">';

				if ( isset( $item['id'] ) && $grahlie_values[ $item['id'] ] === $key ) {
					$val = 'selected="selected"';
				}

				$pages = get_pages();
				foreach ( $pages as $page ) {

					if ( $grahlie_values[ $item['id'] ][ $i ] === $page->ID ) {
						$output .= '<option value="' . $page->ID . '" selected>' . $page->post_title . '</option>';
					} else {
						$output .= '<option value="' . $page->ID . '">' . $page->post_title . '</option>';
					}
				}

				$output .= '</select>';

			}
		}

		return $output;
	}

	// File input.
	if ( 'file' === $item['type'] ) {
		$wp_upload_dir = wp_upload_dir();
		$output        = '';

		// Preview uploaded image.
		if ( isset( $grahlie_values[ $item['id'] ] ) && '' !== $grahlie_values[ $item['id'] ] ) {
			$type = substr( $grahlie_values[ $item['id'] ], strrpos( $grahlie_values[ $item['id'] ], '.' ) + 1 );

			if ( 'jpg' === $type || 'png' === $type || 'jpeg' === $type || 'gif' === $type ) {
				$image = '<img class="upload-img" src="' . $grahlie_values[ $item['id'] ] . '" />';
			} else {
				$image = $grahlie_values[ $item['id'] ];
			}
		} else {
			$display = 'style="display: none"';
		}

		$output .= '<div id="upload_' . $item['id'] . '_preview">' . $image . '</div>';

		$output .= '
        <input type="file" id="upload_' . $item['id'] . '" name="fileupload"  style="display: none;"/>
		<input id="upload_' . $item['id'] . '_button" type="button" class="grahlie-button-primary" value="' . $item['val'] . '" />
        <input id="delete_' . $item['id'] . '_button" type="button" class="grahlie-button" value="' . __( 'Remove', 'grahlie' ) . '" ' . $display . ' />';

		?>

		<script type='text/javascript'>
			jQuery(document).ready(function($){
				$("#grahlie-framework #upload_<?php echo esc_html( $item['id'] ); ?>_button").click(function(){
					$("#upload_<?php echo esc_html( $item['id'] ); ?>").trigger("click");

					var button = $(this);
					var buttonVal = button.val();

					$("#upload_<?php echo esc_html( $item['id'] ); ?>").change(function(event){
						var file = event.target.files[0];

						var data = new FormData();
						data.append("uploadedfile", file);
						data.append("action", "grahlie_upload_file");
						data.append("id", "<?php echo esc_html( $item['id'] ); ?>");
						data.append("grahlie_upload_nonce", "<?php echo esc_attr( wp_create_nonce( 'grahlie_framework_upload' ) ); ?>");

						$(button).val("<?php esc_html_e( 'Uploading file', 'grahlie' ); ?>");

						$.ajax({
							url: "<?php echo esc_url( site_url() ); ?>/wp-admin/admin-ajax.php", 
							type: "POST", 
							data: data,
							cache: false,
							processData: false, 
							contentType: false,
							dataType: "json",

							success: function(data){
								var name = file.name;
								var type = name.split('.').pop();

								$(button).val(buttonVal);

								$("#grahlie-messages #message p").html(data.message);
								$("#grahlie-messages").css("display", "block");

								if(type && type == 'jpg' || type == 'png' || type == 'jpeg' || type == 'gif' || type == 'svg') {
									$("#upload_<?php echo esc_html( $item['id'] ); ?>_preview").html('<img class="upload-img" src="<?php echo esc_url( $wp_upload_dir['url'] ); ?>/' + name + '" alt="' + name + '" />');
								} else {
									$("#upload_<?php echo esc_html( $item['id'] ); ?>_preview").text("<?php echo esc_url( $wp_upload_dir['url'] ); ?>/" + name);
								}
								$("#delete_<?php echo esc_html( $item['id'] ); ?>_button").css("display", "inline-block");
							},
							error: function(data){
								$("#grahlie-messages #message p").html(data.message);
								$("#grahlie-messages").css("display", "block");
							}
						});
					});
				});

				$("#grahlie-framework #delete_<?php echo esc_html( $item['id'] ); ?>_button").click(function(){
					var button = $(this);
					var buttonVal = button.val();

					$(button).val("<?php esc_html_e( 'Removing file', 'grahlie' ); ?>");
					$.ajax({
						url: "<?php echo esc_url( site_url() ); ?>/wp-admin/admin-ajax.php",
						type: "POST",
						data: {
							action: "grahlie_remove_file",
							id: "<?php echo esc_html( $item['id'] ); ?>",
							grahlie_upload_nonce: "<?php echo esc_attr( wp_create_nonce( 'grahlie_framework_upload' ) ); ?>"
						},
						dataType: "json",

						success: function(data){
							$(button).val(buttonVal);
							$("#grahlie-messages #message p").html(data.message);
							$("#grahlie-messages").css("display", "block");
							$("#delete_<?php echo esc_html( $item['id'] ); ?>_button").css("display", "none");
							$("#upload_<?php echo esc_html( $item['id'] ); ?>_preview").html("");
						}
					});
					return false;
				});
			});
		</script>

		<?php
		return $output;
	}
}

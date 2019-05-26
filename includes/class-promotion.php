<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class WPCP_Promotion {

	public function __construct() {
		add_action( 'admin_notices', array( $this, 'promotional_offer' ) );
		add_action( 'wp_ajax_wpcp-dismiss-promotional-offer-notice', array( $this, 'dismiss_promotional_offer' ) );
	}

	/**
	 *
	 * since 1.0.0
	 */
	public function promotional_offer() {
		// Show only to Admins
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// 2018-03-26 23:59:00
//		if ( time() > strtotime('30-4-2018') ) {
//			return;
//		}

		// check if it has already been dismissed
		$hide_notice = get_option( 'wpcp_pro_release_announcement', 'no' );

		if ( 'hide' == $hide_notice ) {
			return;
		}

		$offer_msg = __( 'Your most desired and long waited update for <strong>WP Content Pilot</strong> is finally here.<br> Now it will empower your auto blogging with <strong>5 free</strong> and <strong>16 premium</strong> campaigns that includes outstanding features. Learn more about the premium version.', 'wpcp' );

		?>
		<div class="notice notice-info is-dismissible" id="wpcp-promotional-offer-notice">
			<span class="wpcp-promotional-icon">
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="36px" height="36px" viewBox="0 0 430.117 430.118">
					<path id="Robo.to" d="M251.808,171.704c0-8.623,6.926-15.609,15.485-15.609c8.536,0,15.467,6.986,15.467,15.609   c0,8.62-6.931,15.611-15.467,15.611C258.733,187.311,251.808,180.32,251.808,171.704z M203.641,38.734h-0.128v21.396h19.639V39.36   c6.758-3.426,11.443-10.398,11.443-18.547C234.595,9.315,225.363,0,213.96,0c-11.399,0-20.641,9.315-20.641,20.813   C193.315,28.506,197.492,35.136,203.641,38.734z M160.668,187.311c8.539,0,15.469-6.991,15.469-15.614   c0-8.62-6.931-15.607-15.469-15.607c-8.559,0-15.485,6.987-15.485,15.607C145.183,180.32,152.109,187.311,160.668,187.311z    M213.96,430.118c23.296,0,43.098-14.943,50.616-35.843H163.34C170.861,415.174,190.657,430.118,213.96,430.118z M52.57,366.702   c0-8.261,4.807-15.336,11.724-18.696v-88.497c0-17.455,13.476-31.708,30.513-32.838v-42.825c0,0,4.145-78.05,68.534-102.328   c19.126-7.208,36.588-10.123,51.718-10.671c15.141,0.548,32.604,3.463,51.711,10.667c64.401,24.278,68.551,102.328,68.551,102.328   v42.821c17.025,1.134,30.504,15.392,30.504,32.842v88.502c6.916,3.36,11.724,10.44,11.724,18.696   c0,11.49-9.241,20.806-20.638,20.806c-11.397,0-20.638-9.315-20.638-20.806c0-8.261,4.812-15.336,11.714-18.696v-59.16   c-3.836,1.979-8.14,3.174-12.662,3.482v20.562c0.117,1.662,0.252,3.31,0.252,5.013c0,1.802-0.116,3.584-0.252,5.367v0.476h-0.022   c-2.749,34.257-29.328,61.699-63.016,65.442l0.028,0.467h-57.256h-57.263l0.038-0.467c-33.687-3.743-60.259-31.186-63.008-65.442   h-0.019v-0.476c-0.128-1.783-0.252-3.565-0.252-5.367c0-1.699,0.128-3.351,0.252-5.013v-20.559   c-4.539-0.312-8.842-1.498-12.678-3.486v59.17c6.914,3.36,11.724,10.436,11.724,18.687c0,11.5-9.239,20.811-20.643,20.811   C61.817,387.512,52.57,378.202,52.57,366.702z M249.502,257.856c0-5.525-4.443-10.016-9.932-10.016   c-5.498,0-9.941,4.485-9.941,10.016c0,5.535,4.443,10.025,9.941,10.025C245.059,267.881,249.502,263.391,249.502,257.856z    M273.957,257.856c0-5.525-4.443-10.016-9.932-10.016s-9.94,4.485-9.94,10.016c0,5.535,4.452,10.025,9.94,10.025   S273.957,263.391,273.957,257.856z M298.422,257.856c0-5.525-4.443-10.016-9.932-10.016c-5.498,0-9.94,4.485-9.94,10.016   c0,5.535,4.442,10.025,9.94,10.025C293.979,267.881,298.422,263.391,298.422,257.856z M131.425,174.595   c0,26.591,20.64,28.33,20.64,28.33c7.183,2.289,22.362,1.153,29.23,0c6.321-1.076,29.515-3.097,33.208-3.426   c0.141,0.014,0.364,0.038,0.551,0.046c0.196-0.009,0.416-0.032,0.546-0.046c3.697,0.324,26.883,2.35,33.211,3.426   c6.88,1.153,22.048,2.289,29.235,0c0,0,20.633-1.734,20.633-28.33c0,0,0-29.486-20.633-47.408   c-20.013-17.382-50.092-21.153-61.896-21.377v-0.019c-0.168,0-0.373,0.014-0.551,0.014c-0.172,0-0.387-0.014-0.546-0.014   c-0.168,0-0.378,0.014-0.551,0.014c-0.175,0-0.385-0.014-0.548-0.014v0.019c-11.792,0.224-41.88,3.995-61.89,21.377   C131.425,145.109,131.425,174.595,131.425,174.595z" fill="#0073aa"/>
				</svg>
			</span>
			<p>
				<?php echo $offer_msg; ?>
			</p>
			<a href="https://www.pluginever.com/plugins/wp-content-pilot-pro/?utm_source=wp-menu&utm_campaign=gopro&utm_medium=wp-dash" class="button button-pro promo-btn" target="_blank"><?php _e( 'Get Pro', 'wpcp' ); ?></a>
		</div><!-- #wpcp-promotional-offer-notice -->

		<style>
			#wpcp-promotional-offer-notice{
				display: flex;
				align-items: center;
				padding: 10px 12px;
				padding-right: 38px;
			}
			#wpcp-promotional-offer-notice p{
				color: #000;
				font-size: 14px;
				margin-bottom: 10px;
				-webkit-text-shadow: 0.1px 0.1px 0px rgba(250, 250, 250, 0.24);
				-moz-text-shadow: 0.1px 0.1px 0px rgba(250, 250, 250, 0.24);
				-o-text-shadow: 0.1px 0.1px 0px rgba(250, 250, 250, 0.24);
				text-shadow: 0.1px 0.1px 0px rgba(250, 250, 250, 0.24);
				padding: 0 10px;
			}
			#wpcp-promotional-offer-notice span.wpcp-promotional-icon svg{
				width: 40px;
				height: 40px;
			}
			#wpcp-promotional-offer-notice .button-pro{
                background-color: #ff7a03;
                color: #fff;
                border-color: #ca5f00;
                height: auto;
                padding: 5px 20px;
                font-size: 16px;
            }

            #wpcp-promotional-offer-notice .button-pro:hover{
                color: #fff;
                border-color: #ca5f00;
                background-color: #ff8518;
            }
		</style>

		<script type='text/javascript'>
			jQuery('body').on('click', '#wpcp-promotional-offer-notice .notice-dismiss', function(e) {
				e.preventDefault();

				wp.ajax.post('wpcp-dismiss-promotional-offer-notice', {
					dismissed: true
				});
			});
		</script>
		<?php
	}


	/**
	 * Dismiss promotion notice
	 *
	 * @since  2.5
	 *
	 * @return void
	 */
	public function dismiss_promotional_offer() {
		if ( ! empty( $_POST['dismissed'] ) ) {
			$offer_key = 'wpcp_pro_release_announcement';
			update_option( $offer_key, 'hide' );
		}
	}
}

new WPCP_Promotion();

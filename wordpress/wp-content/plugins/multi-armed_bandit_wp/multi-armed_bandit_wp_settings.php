<?php
    /* This is a PHP class for creating a settings page for the Multi-Armed Bandit plugin. */
    class MultiArmedBanditSettings {
        /* This variable is used to store the options for the Multi-Armed Bandit plugin. */
        private $multi_armed_bandit_options;

        /* This PHP function adds a plugin page and initializes it for a multi-armed bandit algorithm plugin. */
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'multi_armed_bandit_add_plugin_page' ) );
            add_action( 'admin_init', array( $this, 'multi_armed_bandit_page_init' ) );
        }

        /* Add the Top-level menu into the menu page. */
        public function multi_armed_bandit_add_plugin_page() {
            add_menu_page(
                'Multi-Armed Bandit', // page_title
                'Multi-Armed Bandit', // menu_title
                'manage_options', // capability
                'multi-armed-bandit', // menu_slug
                array( $this, 'multi_armed_bandit_create_admin_page' ), // function
                'dashicons-money', // icon_url
                20 // position
            );
        }

        /* This function creates the admin page for the Multi-Armed Bandit plugin and displays the settings form. */
        public function multi_armed_bandit_create_admin_page() {
            $this->multi_armed_bandit_options = get_option( 'multi_armed_bandit_option_name' ); ?>

            <div class="wrap">
                <h2>Multi-Armed Bandit</h2>
                <p>The settings page of the Multi-Armed Bandit Plugin</p>
                <?php settings_errors(); ?>

                <form method="post" action="options.php">
                    <?php
                        settings_fields( 'multi_armed_bandit_option_group' );
                        do_settings_sections( 'multi-armed-bandit-admin' );
                        submit_button();
                    ?>
                </form>
            </div>
        <?php }

        /* 
         * This function is initializing the settings page for the Multi-Armed Bandit plugin 
         * by registering the settings and adding the necessary sections and fields.
         * This function is also adding the settings section and fields.
         */
        public function multi_armed_bandit_page_init() {
            register_setting(
                'multi_armed_bandit_option_group', // option_group
                'multi_armed_bandit_option_name', // option_name
                array( $this, 'multi_armed_bandit_sanitize' ) // sanitize_callback
            );

            add_settings_section(
                'multi_armed_bandit_setting_section', // id
                'Settings', // title
                array( $this, 'multi_armed_bandit_section_info' ), // callback
                'multi-armed-bandit-admin' // page
            );

            add_settings_field(
                'exploration_tries_0', // id
                'Exploration tries', // title
                array( $this, 'exploration_tries_0_callback' ), // callback
                'multi-armed-bandit-admin', // page
                'multi_armed_bandit_setting_section' // section
            );

            add_settings_field(
                'list_of_templates_separated_by_comas_1', // id
                'List of templates (separated by comas)', // title
                array( $this, 'list_of_templates_separated_by_comas_1_callback' ), // callback
                'multi-armed-bandit-admin', // page
                'multi_armed_bandit_setting_section' // section
            );
        }

        /**
         * The function multi_armed_bandit_sanitize sanitizes input values for exploration tries and a list of
         * templates separated by commas in PHP.
         * 
         * @param input - An array of input values to be sanitized.
         * @returns an array of sanitized values for the input array.
         */
        public function multi_armed_bandit_sanitize($input) {
            $sanitary_values = array();
            if ( isset( $input['exploration_tries_0'] ) ) {
                $sanitary_values['exploration_tries_0'] = sanitize_text_field( $input['exploration_tries_0'] );
            }

            if ( isset( $input['list_of_templates_separated_by_comas_1'] ) ) {
                $sanitary_values['list_of_templates_separated_by_comas_1'] = sanitize_text_field( $input['list_of_templates_separated_by_comas_1'] );
            }

            return $sanitary_values;
        }

        /* Empty function because there is no need to add a callback in PHP. */
        public function multi_armed_bandit_section_info() {
            /* Empty function because no need to add a Callback. */
        }

        /* This function generates an HTML input field for the number of exploration tries. */
        public function exploration_tries_0_callback() {
            printf(
                '<input class="regular-text" type="text" name="multi_armed_bandit_option_name[exploration_tries_0]" id="exploration_tries_0" value="%s">',
                isset( $this->multi_armed_bandit_options['exploration_tries_0'] ) ? esc_attr( $this->multi_armed_bandit_options['exploration_tries_0']) : ''
            );
        }

        /* This function generates an HTML input field for a list of templates separated by commas. */
        public function list_of_templates_separated_by_comas_1_callback() {
            printf(
                '<input class="regular-text" type="text" name="multi_armed_bandit_option_name[list_of_templates_separated_by_comas_1]" id="list_of_templates_separated_by_comas_1" value="%s">',
                isset( $this->multi_armed_bandit_options['list_of_templates_separated_by_comas_1'] ) ? esc_attr( $this->multi_armed_bandit_options['list_of_templates_separated_by_comas_1']) : ''
            );
        }

    }

    /* If the current user is an administrator it adds a settings page for the Multi-Armed Bandit plugin to the WordPress admin menu. */
    if ( is_admin() )
        $multi_armed_bandit = new MultiArmedBanditSettings();

    /* 
     * Retrieve this value with:
     * $multi_armed_bandit_options = get_option( 'multi_armed_bandit_option_name' ); // Array of All Options
     * $exploration_tries_0 = $multi_armed_bandit_options['exploration_tries_0']; // Exploration tries
     * $list_of_templates_separated_by_comas_1 = $multi_armed_bandit_options['list_of_templates_separated_by_comas_1']; // List of templates (separated by comas)
     *
     * Or with defaults:
     * $defaults = array(
     *   'exploration_tries_0' => '50',
     *   'list_of_templates_separated_by_comas_1' => '',
     * );
     * $options = wp_parse_args(get_option('multi_armed_bandit_option_name'), $defaults);
     */
?>
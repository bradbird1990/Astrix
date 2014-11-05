<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Controller extends CI_Controller {

    /**
     * Talk about this controller
     */
    public function __construct(){

        parent::__construct();

        // Load jQuery
        $this->add_js_include('jquery-2.1.1.min.js');

        // Load Twitter Bootstrap
        $this->add_js_include('bootstrap.min.js');
        $this->add_css_include('bootstrap.min.css');
        $this->add_css_include('bootstrap-theme.min.css');

        // Load Font Awesome
        $this->add_css_include('font-awesome.min.css');

        // Load custom css into
        $this->add_css_include('app_base.css');

        // Add JS and CSS globals
        $this->add_js_include('global.js');

        $this->add_js_snippet('var base_url = "' . base_url() . '";');
        $this->add_js_snippet('var uri_controller = "' . $this->uri->segment(1) . '";');
        $this->add_js_snippet('var uri_action = "' . $this->uri->segment(2) . '";');
        $this->add_js_snippet('var uri_segments = [' . json_encode($this->uri->uri_to_assoc()) . '];');
        $this->add_js_snippet('var session_info = [' . json_encode($this->session->all_userdata()) . '];');
        $this->add_js_snippet('var data = [];');

    }

    public function add_js_include($js){

        $current_config = $this->config->item('js_includes');
        array_push($current_config, $js);

        $this->config->set_item('js_includes', $current_config);

    }

    public function add_js_snippet($js){

        $current_config = $this->config->item('js_snippets');
        array_push($current_config, $js);

        $this->config->set_item('js_snippets', $current_config);

    }

    public function add_css_include($css){

        $current_config = $this->config->item('css_includes');
        array_push($current_config, $css);

        $this->config->set_item('css_includes', $current_config);

    }

    public function add_css_snippet($css){

        $current_config = $this->config->item('css_snippets');
        array_push($current_config, $css);

        $this->config->set_item('css_snippets', $current_config);

    }

}

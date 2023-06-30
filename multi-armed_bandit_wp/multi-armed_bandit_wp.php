<?php
   /*
   Plugin Name: Multi Armed Bandit WordPress
   description: A Plugin that applies the Multi-Armed Bandit Algorithm to WordPress Templates
   Version: 1.0
   Author: LE ROY Andy & EZZAYER Aymen
   License: MIT
   */

   include "multi-armed_bandit_wp_settings.php";


   class BanditManchot
{
    public array $templatesValueList;
    public array $templatesNList;
    public string $type;
    public int $bestTemplate;

    public function calculValue (int $success, int $template) :int
    {
        $valn = $templatesValueList[$template];
        $n = $templatesNList[$template];
        $valn1 = $valn + ((1 / (n + 1)) * ($success - $valn));
        $templatesValueList[$template] = $valn1;
        $templatesNList[$template] += 1;
    }

    public function selectType ()
    {
        $nTotal = 0;
        foreach ($templatesNList as $key => $value) {
            $nTotal += $value;
        }

        if ($type == "exploration" && $value % 50 == 0) {
            $type = "exploitation";
        } else if ($type == "exploitation" && $value % 450 == 0) {
            $type = "exploration";
        }
    }

    public function selectBestTemplate ()
    {
        $previousVal = 0;
        foreach ($templatesNList as $key => $value) {
            if ($value > $previousVal) {
                $bestTemplate = $key;
                $previousVal = $value;
            }
        }
    }
}

/*add_action('template_redirect', 'wpsf_random_page_redirect');
function wpsf_random_page_redirect()
{
   echo("coucou");
    if (is_page('random-page')) {
        $excluded_pages = array(15, 9);
        $pages = get_pages(array('exclude' => $excluded_pages));
        $random_page = array_rand($pages);
        $page_url = get_page_link($random_page);
        wp_redirect($page_url);
        exit;
    }
}*/
add_action('template_redirect', 'load_our_custom_tax_template');
add_filter( "page_template", 'load_our_custom_tax_template');
function load_our_custom_tax_template ($tax_template) {
   echo(get_page_template());
   //echo esc_html( get_page_template_slug( $post->ID ) ); 
   //$tax_template = '11.php';
   //return $tax_template;
}
?>
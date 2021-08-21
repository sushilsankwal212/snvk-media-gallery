<?php 
/*
Plugin Name: Snvk Media Gallery 
Plugin URI: https://snayvik.com/snvk-plugins/
Description: Media Video gallery metabox for pages , custom post type with drag and drop feature.
Version: 1.0.0
Author: Sushil Sankwal
Author URI: https://sushilsankwal.wordpress.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: snvk-media-gallery
*/


require_once('config.php');


// register scripts
add_action('admin_enqueue_scripts', 'snvk_plugin_styles');

if (!function_exists('snvk_plugin_styles')) 
{
    function snvk_plugin_styles()
    {
        wp_enqueue_style('snvk-plugin-styles', SNVK_PLUGIN_CSS_DIR.'style.css', array(), '2.1', 'all');
    }
}


// admin menu 
add_action('admin_menu','snvk_admin_menu');

if (!function_exists('snvk_admin_menu')) 
{

    function snvk_admin_menu()
    {
       
        add_menu_page('SNV MEDIA', 'Snvk Media Gallery', 'manage_options','snv-media-gallery', 'snv_media_gallery',SNVK_PLUGIN_IMG_DIR.'snvk-gallery.png',20);
        
        add_submenu_page( 'snv-media-gallery','Snv Media Setting','Setting','manage_options','snv-media-setting','snv_media_gallery');

        //call to registe setting
        add_action('admin_init','snv_media_setting');
    }
}

function snv_media_setting()
{

    register_setting('media_gallery_settings','show_on');
}

function snv_media_gallery()
{
    

    echo $titlestart = '<div class="wrap">';
    echo $pagetitle  = '<h1>SNV MEDIA GALLERY</h1>';
     
    switch ($_GET['page']) {
        case 'snv-media-setting':
         
         echo "<h1>Use this code to Show media gallery</h1>";
         echo "<br>";
         
         echo "<div class='snv_code'>";
         highlight_file('snvk-media-setting.php',$return);
         echo "</div>"; 

            // code...
            break;
        
        default:
            // code...
        ?>
<form method="post" action="options.php">  
          <?php
                settings_fields('media_gallery_settings');
                do_settings_sections('media_gallery_settings');

                $postvalue = get_option('show_on');
                if(empty($postvalue)):
                    $postvalue = array();
                endif;
                        
                $posttypes = get_post_types();
             
            unset($posttypes['attachment'],$posttypes['revision'],
                $posttypes['nav_menu_item'],$posttypes['custom_css'],
                $posttypes['customize_changeset'],$posttypes['oembed_cache'],
                $posttypes['user_request'],$posttypes['wp_block'],
                $posttypes['wpcf7_contact_form']);
                

          ?>
          <table class="form-table">
                <tr valign="top">
                    <th scope="row"><h1>Show on</h1>(You can select one or more post type/custom post type where you want to use meta functionality meta box images)</th>
                    <td>
                        <select name="show_on[]" class="snv_post" multiple>
                          <?php 
                          foreach($posttypes as $type)
                          {
                            $result=array_intersect($posttypes,$postvalue);
                             
                             if(empty($result)):
                                    $result = array();
                             endif;   
                            ?>
                           <option value="<?php echo esc_html($type); ?>" 
                           <?php if(in_array($type,$result)): echo esc_html("selected"); endif;?> ><?php echo esc_html($type); ?></option>  
                          
                          <?php 

                           }

                          ?>  
                        </select>
                    </td>
                </tr>
            </table>
      <?php submit_button(); ?>
    </form>

<?php 

            break;
    }
?>
    
<?php 

    echo $titleend   = '</div>';

}


// media meta box 
add_action('add_meta_boxes','snv_metaboxes');
function snv_metaboxes()
{
     wp_enqueue_media();
     wp_enqueue_script('snv-media-js',SNVK_PLUGIN_JS_DIR.'snv-media.js');

     $posttypes = get_option('show_on');
     add_meta_box('snv-media-section', 'SNVK MEDIA GALLERY','snv_media_meta',$posttypes,'normal','default');
}    

require_once('snvk-media-meta.php');
<?php

function snv_media_meta()
{
      
  $snv_mediagallery = get_post_meta(get_the_ID(),'snv_mediagallery', TRUE);
  $snv_mediatitle =   get_post_meta(get_the_ID(),'snv_mediatitle',TRUE);
  $snv_mediaurl =  get_post_meta(get_the_ID(),'snv_mediaurl', TRUE);
  
?>    
<fieldset>
<div class="snv_galleryImages" id="sortable">  
<?php 

   
  if(empty($snv_mediagallery))
  {
      $snv_mediagallery = array();
  } 
  if(empty($snv_mediatitle))
  {  
      $snv_mediatitle = array(); 
  }
  if(empty($snv_mediaurl))
  {
      $snv_mediaurl =  array();
  }

$snv_arraycombine =  array_map(null,$snv_mediagallery,$snv_mediatitle,$snv_mediaurl);

if(is_array($snv_arraycombine)):

    foreach($snv_arraycombine as $snv_content):

$snv_filename = basename($snv_content[0]);
//check images getimagesize($gallery)

    ?> 

<div class="snv_gallery" class="sortable-item">
    <a href="<?php echo $snv_content[0]; ?>" target="_blank"><img src="<?php echo esc_html($snv_content[0]); ?>" alt="<?php echo esc_html($snv_content[0]); ?>"></a>
    <input type='hidden' name='snv_mediagallery[]' value='<?php echo esc_html($snv_content[0]); ?>'>
    <div class='snv_desc'>
    Title:<input type="text" name="snv_mediatitle[]" value="<?php echo esc_html($snv_content[1]); ?>" > 
    Video Url:<input type="url"  name="snv_mediaurl[]" value="<?php echo esc_html($snv_content[2]); ?>" >
    </div>
    <a href="javascript:void(0)" class="snv_removeImage">Remove</a>
</div>

<?php 
endforeach;
endif;
 ?>

</div>
</fieldset>

<fieldset id="snv_media_upload">
<a href="javascript:void(0)" class="snv_mediaUpload" >Upload</a>
<input  id="snv_images-input" type="hidden" >
</fieldset>    

<!---unique meta id---------->
<?php 
	
}


add_action('save_post','save_snv_media_gallery');

function save_snv_media_gallery()
{   

	$snv_media = array_map( 'sanitize_text_field', $_POST["snv_mediagallery"] );
	$snv_media_title = array_map( 'sanitize_text_field',$_POST["snv_mediatitle"] );
	$snv_media_url = array_map( 'sanitize_text_field',$_POST["snv_mediaurl"] );
	 	
    update_post_meta(get_the_ID(),"snv_mediagallery",$snv_media);

    update_post_meta(get_the_ID(),"snv_mediatitle",$snv_media_title);
    
    update_post_meta(get_the_ID(),"snv_mediaurl",$snv_media_url);

}
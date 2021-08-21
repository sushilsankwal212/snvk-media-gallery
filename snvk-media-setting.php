

 <?php 
            

        $snv_mediagallery = get_post_meta(get_the_ID(),'snv_mediagallery', TRUE);
        $snv_mediatitle   = get_post_meta(get_the_ID(),'snv_mediatitle',  TRUE);
        $snv_mediaurl     = get_post_meta(get_the_ID(),'snv_mediaurl',  TRUE);

        $snv_arraycombine =  array_map(null,$snv_mediagallery,$snv_mediatitle,$snv_mediaurl);

        if(is_array($snv_arraycombine))
        {
            
            foreach($snv_arraycombine as $snv_content)
            {
               
                //file url 
                echo esc_html($snv_content[0]);
                //file title
                echo esc_html($snv_content[1]);
                //media url for video
                echo esc_html($snv_content[2]);

            }

        }
        

 ?>


jQuery(document).ready(function($){
 
    
var max_fields = 10; //maximum input boxes allowed
var inc= 1;
//section 1 service repeater
// check if images type
function checkURL(url) {
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

// on click button media uploader select : 1            
            $(".snv_mediaUpload").click(function(){
              
// Media frames get               
                var snv_custom_uploader = wp.media.frames.file_frame = wp.media({
                    multiple: true,
                    library: {
                           type: ['image' ]
                             },
                });

// state how to get images and upload state=:select:post
                snv_custom_uploader.on('select', function() {
                    
                    var snv_selection = snv_custom_uploader.state().get('selection');
                    var snv_attachments = [];
                    snv_selection.map( function( snv_attachment ) {
                        snv_attachment = snv_attachment.toJSON();
                        var snv_filename = snv_attachment.url.split('/').pop().split('?')[0];
if(checkURL(snv_attachment.url))
{
    $(".snv_galleryImages").append( "<div class='snv_gallery'><a href='"+snv_attachment.url+"' target='_blank'><img src='"+snv_attachment.url+"' ></a><input type='hidden' name='snv_mediagallery[]' value='"+snv_attachment.url+"'><div class='snv_desc'>Title:<input type='text' name='snv_mediatitle[]' value=''  >Video Url:<input type='url'  name='snv_mediaurl[]' value='' ></div><a href='javascript:void(0)'  class='snv_removeImage'>Remove</a></div>" );
snv_attachments.push(snv_attachment.url);
}


});

});
                 snv_custom_uploader.open();
             });


$(".snv_galleryImages").on('click','.snv_removeImage',function(e){
e.preventDefault(); 
$(this).parent('div').remove();
 });
 
 
$('#sortable').sortable({
            curosr: 'move'
        }); 

});
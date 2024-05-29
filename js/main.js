
jQuery(document).ready(function($) {
    $('#success_message').hide();
    $('#enquiry').submit(function(e){
        
        e.preventDefault();

        var form = $('#enquiry').serialize();
        
        var formdata = new FormData;

        formdata.append('action','enquiry');
        formdata.append('nonce',ajax_nonce);
        formdata.append('enquiry',form);

        $.ajax({
            type:'POST',
            data:formdata,
            url:endpoint,
            processData: false,
            contentType: false,
            success:function(data){

            $('#enquiry').hide(250);
            $('#success_message').show(500).text('Thanks for your message');
            },
            error:function(err){
                alert(err.responseJSON.data);
            }
        })
        
    })
});


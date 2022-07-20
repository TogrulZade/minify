var csrf = document.querySelector('meta[name="csrf-token"]').content;
$(document).ready(function(){
    $('.tesdiqle').on('click', function(e){
        e.preventDefault();
        const that = $(this);
        const product_id = $(this).data('product_id');
        $.ajax({
            type: 'POST',
            url: '/admin/product/tesdiqle',
            data: {id: product_id, _token: csrf},
            success: function(res){
                if(res == 'updated'){
                    that.css({'background-color':'#fee500','color':'#494949'});
                }
            },
            error: function(error){
                alert(JSON.stringify(error));
            }
        })
    })
});

function isNum(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !=46)
	    return false;

	return true;
}
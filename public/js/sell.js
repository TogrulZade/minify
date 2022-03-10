$(function() {

    // Yeni elan sell
    var csrf = document.querySelector('meta[name="csrf-token"]').content;
	var category;

	// $('select[name="product_category"]').on('change',function(){
	// 	category = $(this).val();
    //     $.ajax({
    //         url: 'checkCategory',
    //         type: 'POST',
    //         data: {category: category, _token: csrf},

    //         success: function(res){
    //             if(res){
    //                 $('.update_detail').html(
    //                     `<select name='marka'>
    //                         <option value='0'>Marka</option>
    //                     `
    //                 );
    //                     res.map(item=>{
    //                         $('select[name="marka"]').append(`
    //                             <option value="`+item.id+`">`+item.name+`</option>
    //                         `);
    //                     });

    //                     $('.update_detail').append(`
    //                         </select>
    //                     `);
    //             }
    //         },
    //         error: function(error){
    //             alert(error.responseText);
    //         }
    //     })
	// });


    $('select[name="product_category"]').on('change',function(){
		category = $(this).val();
        // alert(category);
        $.ajax({
            url: 'checkCategory',
            type: 'POST',
            data: {category: category, _token: csrf},

            success: function(res){
                // alert("Res: "+typeof(res));
                if(res != 'no'){
                    console.log(JSON.stringify(res))
                    $('.update_detail').html(
                        `<select name='nov'>
                            <option value='0'>Növü</option>
                        `
                    );
                        res.map(item=>{
                            $('select[name="nov"]').append(`
                                <option value="`+item.id+`">`+item.name+`</option>
                            `);
                        });

                        $('.update_detail').append(`
                            </select>
                        `);
                }else{
                    $('.update_detail').html('');
                }
            },
            error: function(error){
                alert(error.responseText);
            }
        })
	});

    $('select[name="nov"]').on('change',function(){
		nov = $(this).val();
        $.ajax({
            url: 'checkSubCategory',
            type: 'POST',
            data: {category: nov, _token: csrf},

            success: function(res){
                if(res){
                    $('.update_detail').html(
                        `<select name='nov'>
                            <option value='0'>Növü</option>
                        `
                    );
                        res.map(item=>{
                            $('select[name="nov"]').append(`
                                <option value="`+item.id+`">`+item.name+`</option>
                            `);
                        });

                        $('.update_detail').append(`
                            </select>
                        `);
                }
            },

            error: function(error){
                alert(error.responseText);
            }
        });
	});

});
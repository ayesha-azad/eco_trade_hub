$(document).ready(function(){
    rating_value = 0;
    
    $(document).on('mouseenter','.submit_star',function(){
         rating = $(this).data('rating')
         resetStar()
         for(var i =0;i<=rating;i++){
             $('#submit_star_'+i).addClass('text-warning')
         }
    })



    function resetStar(){
        for(var i =0;i<=5;i++){
            $('#submit_star_'+i).addClass('star-light')
            $('#submit_star_'+i).removeClass('text-warning')
        }
       }


       
   
  

$(document).on('click','.submit_star',function(){
     rating_value = $(this).data('rating') 
     for(var i =0;i<=rating_value;i++){
        $('#submit_star_'+i).addClass('text-warning')
    }
})


$('#sendReview').click(function(){
    let userId = $('#userId').val();
    let productId = $('#productId').val();
    let userMessage = $('#userMessage').val();

    if(userMessage === ''){
        alert('Please, Fill both Fields');
        return false;
    } else {
        $.ajax({
            url: 'users/review_submit.php',
            method: 'POST',
            data: { rating_value: rating_value, productId: productId, userId: userId, userMessage: userMessage },
            success: function(data){
                $('#staticBackdrop').modal('hide');
            }
        });
    }
});

})
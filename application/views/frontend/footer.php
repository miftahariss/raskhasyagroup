<footer class="p15">
    <div class="text-center">
        <p class="m0">copyright by Raskhasya Group <?php echo date('Y'); ?></p>
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>assets/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/swiper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script>
    $(".container-navbar").mCustomScrollbar({
        axis:"x",
        theme:"dark-thin",
        autoExpandScrollbar:true,
        advanced:{autoExpandHorizontalScroll:true}
    });
            
          
    var swiper = new Swiper('.slider-banner', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        autoplay:4000,
        onInit:function(){
            var tinggislide = $('.section-banner').height()-60;
            $('.compo-text').css('max-height',tinggislide);
            $('.logo-banner').width(300);
            $('.kontak-banner').css('margin-top','20px');
        }
    });


    // $('.navbar-nav .dropdown').on('click',function(){
    //     var marlef = $(this).siblings('.first-child').position().left;

    //     if($(this).hasClass('open')){
    //         $('.navbar-nav').removeAttr('style');
    //     }
    //     else{
    //         $('.navbar-nav').height(300);
    //     }
    // });

    // var marlef = $('.navbar-nav .first-child').position().left;
    // $('.right-nav').on('click',function(e){

    //     $('.navbar-nav ').animate({
    //         scrollLeft:600 
    //     },500);
        
    // });
    // $('.left-nav').on('click',function(){
    //     $('.navbar-nav ').animate({
    //         scrollLeft:-400
    //     },500);
    // });

    
    $(document).ready(function(){

        myFunction();
        center_menu();
        function myFunction() {
            setTimeout(function(){ 
                smallwindow();
            }, 500);
        }
        
        $(window).resize(function(){
            smallwindow();
        });

        function smallwindow(){
            if($(document).width() > 980){
                $('.logo-banner').width(500);
            }
            else{
                var tinggislide = $('.section-banner').height()-60;
                $('.compo-text').css('max-height',tinggislide);
                $('.logo-banner').width(300);
                $('.kontak-banner').css('margin-top','20px');
            }
        }

        
        function center_menu(){
            var wid = $('.navbar-nav').width();
            var wid_con = $('.container-navbar').width();
            if(wid < wid_con){
                $('.navbar-nav').width(wid+5);
                $('.navbar-nav').css('float','none');
            }
        }
    });

</script>
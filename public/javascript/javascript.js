function changeLayout(){
    let width = $(window).width();
    console.log(width);
    if (width<1200){
        $('.lado-esquerdo').width('8%')
        console.log(-1)
        $('#explorar').remove()
        $('#configuracao').remove()
        $('.lado-principal').css('left','10%')
        
        document.getElementById('nav').style.left='40%'
    }
}
$(function (){
    $('.btn-entrar').on('click',()=>{
        $(".pop-overlay, .pop-content").addClass("active");
        $('.pop-content').addClass('rounded-5')
        $('footer').removeClass('fixed-bottom')
        $('footer').css('position', 'absolute');
        $('footer').css('bottom','0');
        $('body').css('overflow','hidden');
    })
    $(".close").on('click', ()=>{
        $(".pop-overlay, .pop-content").removeClass("active");
        $('footer').addClass('fixed-bottom')
        $('footer').css('position', 'fixed');
        $('footer').css('padding', '0 12px');
        $('body').css('overflow','auto');
    });
    $('.btn-inscrever').on('click',()=>{
        $(".pop2-overlay, .pop2-content").addClass("active");
        $('.pop2-content').addClass('rounded-5')
        $('footer').removeClass('fixed-bottom')
        $('footer').css('position', 'absolute');
        $('footer').css('bottom','0');
        $('body').css('overflow','hidden');
    })
    $(".close2").on('click', ()=>{
        $(".pop2-overlay, .pop2-content").removeClass("active");
        $('footer').addClass('fixed-bottom')
        $('footer').css('position', 'fixed');
        $('footer').css('padding', '0 12px');
        $('body').css('overflow','auto');
    });
});
function hrefUser(id){
    console.log(-1)
    window.location.href='../user?id='+id
}
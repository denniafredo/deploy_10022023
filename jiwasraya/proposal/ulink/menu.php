
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen"/>
        <div class="menu">
           <div class="item">
                <a class="link icon_back" href="./menu.php"></a>
                <div class="item_content">
                      <a href="http://www.tympanus.net/"><h2>Back</h2></a>
                </div>
            </div>
            <div class="item">
                <a class="link icon_cetak" href="./menu.php"></a>
                <div class="item_content">
                      <a href="http://www.tympanus.net/"><h2>Cetak Konfirmasi Proposal</h2></a>
                </div>
            </div>
            <div class="item">
                <a class="link icon_topup" href="./menu.php"></a>
                <div class="item_content">
                      <a href="http://www.tympanus.net/"><h2>Entry Top Up</h2></a>
                </div>
            </div>
            <div class="item">
                <a class="link icon_rider" href="./menu.php"></a>
                <div class="item_content">
                      <a href="./entryrider.php"><h2>Entry Rider</h2></a>
                </div>
            </div>
            <div class="item">
                <a class="link icon_porsi" href="./menu.php"></a>
                <div class="item_content">
                      <a href="./porsifund.php"><h2>Entry Porsi Fund</h2></a>
                </div>
            </div>
            <div class="item">
                <a class="link icon_proposal" href="./menu.php"></a>
                <div class="item_content">
                      <a href="./ntryprop_ulink.php"><h2>Entry Proposal Link</h2></a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="jquery-1.5.2.min.js"></script>
        <script src="jquery-css-transform.js" type="text/javascript"></script>
        <script src="jquery-animate-css-rotate-scale.js" type="text/javascript"></script>
        <script>
            $('.item').hover(
                function(){
                    var $this = $(this);
                    expand($this);
                },
                function(){
                    var $this = $(this);
                    collapse($this);
                }
            );
            function expand($elem){
                var angle = 0;
                var t = setInterval(function () {
                    if(angle == 1440){
                        clearInterval(t);
                        return;
                    }
                    angle += 40;
                    $('.link',$elem).stop().animate({rotate: '+=-40deg'}, 0);
                },10);
                $elem.stop().animate({width:'268px'}, 1000)
                .find('.item_content').fadeIn(400,function(){
                    $(this).find('p').stop(true,true).fadeIn(600);
                });
            }
            function collapse($elem){
                var angle = 1440;
                var t = setInterval(function () {
                    if(angle == 0){
                        clearInterval(t);
                        return;
                    }
                    angle -= 40;
                    $('.link',$elem).stop().animate({rotate: '+=40deg'}, 0);
                },10);
                $elem.stop().animate({width:'52px'}, 1000)
                .find('.item_content').stop(true,true).fadeOut().find('p').stop(true,true).fadeOut();
            }
        </script>

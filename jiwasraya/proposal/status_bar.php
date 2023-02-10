<!--link href="status_bar.css" rel="stylesheet" type="text/css">-->
<head>
<style type="text/css">
#myProgress {
    position: relative;
    width: 100%;
    height: 30px;
    background-color: grey;
}
#myBar {
    position: absolute;
    width: 20%;
    height: 100%;
    background-color: green;
}
#label {
    text-align: center; 
    line-height: 30px; 
    color: white;
}
</style>
<script language="JavaScript" type="text/javascript">
function move() {
    var elem = document.getElementById("myBar"); 
    var width = 20;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++; 
            elem.style.width = width + '%'; 
            document.getElementById("label").innerHTML = width * 1 + '%';
        }
    }
}




//http://sofcase.net/post/make-a-progressbar-how-in-ubuntu-on-css3-and-jquery/
</script>
</head>
<body>
<div id="myProgress">
  <div id="myBar">
    <div id="label">10%</div>
  </div>
</div>
  <button onclick="move()">Click Me</button> 
  </body>
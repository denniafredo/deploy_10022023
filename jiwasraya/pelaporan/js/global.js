// Begin Function Block of Iie's Cross-Browser Hierarchical Auto Expandable Menu

var isNav4, isIE4, isNav6;

if (parseInt(navigator.appVersion.charAt(0)) >= 4) {
  isNav6 = navigator.userAgent.indexOf("Gecko")!=-1?true:false;
  isNav4 = (navigator.appName == "Netscape") ? true && !isNav6: false;
  isIE4 = (navigator.appName.indexOf("Microsoft") != -1) ? true : false;
}

if(isNav4) alert("Your Browser Doesn't Support This Application, Please Upgrade Your Browser First !\nMinimum Browser Requirement : Netscape Navigator or it's variant > 4.0, Internet Explorer > 5.0");

var host_ = window.location.hostname;

var plusImg = new Image();
        plusImg.src = "http://"+host_+"/img/test_false.gif"
var minusImg = new Image();
        minusImg.src = "http://"+host_+"/img/test_true.gif"

// Version 1 : Original
function hideLevel(_levelId,_imgId) {
        if(isNav6){
		var thisLevel = document.getElementById(_levelId);
        var thisImg = document.getElementById(_imgId);
		}else if(isNav4){
		var thisLevel = document.layers(_levelId);
        var thisImg = document.layers(_imgId);
		}else if(isIE4){
		var thisLevel = document.all(_levelId);
        var thisImg = document.all(_imgId);
		}else{
		var thisLevel = document.getElementById(_levelId);
        var thisImg = document.getElementById(_imgId);
		}
			if(thisLevel){
				//thisLevel.filter.alpha.opacity = "0";
				thisLevel.style.display = "none";
			}
			if(thisImg){
				thisImg.src = plusImg.src;
			}
}

function showLevel_(_levelId,_imgId) {
        if(isNav6){
		var thisLevel = document.getElementById(_levelId);
        var thisImg = document.getElementById(_imgId);
		}else if(isNav4){
		var thisLevel = document.layers(_levelId);
        var thisImg = document.layers(_imgId);
		}else if(isIE4){
		var thisLevel = document.all(_levelId);
        var thisImg = document.all(_imgId);
		}else{
		var thisLevel = document.getElementById(_levelId);
        var thisImg = document.getElementById(_imgId);
		}
		if(thisLevel){
				//thisLevel.filter.alpha.opacity = "0";
				thisLevel.style.display = "block";
			}
			if(thisImg){
				thisImg.src = minusImg.src;
			}
}

function hideAll(_menu_Id,_menu_Num) {
		for(var i = 1; i <= _menu_Num; i++){
				hideLevel(_menu_Id+i,_menu_Id+i+'Img');
			}
        }

function showAll(_menu_Id,_menu_Num) {

		for(var i = 1; i <= _menu_Num; i++){
				showLevel_(_menu_Id+i,_menu_Id+i+'Img');
			}
        }

function showLevel(_menu_Id,_sub_menu_Id,_menu_Num) {
        if(isNav6){
		var thisLevel = document.getElementById(_menu_Id+_sub_menu_Id);
        var thisImg = document.getElementById(_menu_Id+_sub_menu_Id+'Img');
		}else if(isNav4){
		var thisLevel = document.layers(_menu_Id+_sub_menu_Id);
        var thisImg = document.layers(_menu_Id+_sub_menu_Id+'Img');
		}else if(isIE4){
		var thisLevel = document.all(_menu_Id+_sub_menu_Id);
        var thisImg = document.all(_menu_Id+_sub_menu_Id+'Img');
		}else{
		var thisLevel = document.getElementById(_menu_Id+_sub_menu_Id);
        var thisImg = document.getElementById(_menu_Id+_sub_menu_Id+'Img');
		}
        if (thisLevel){
		if (thisLevel.style.display == "none") {
                //thisLevel.filter.alpha.opacity="100";
				thisLevel.style.display = "block";
				if(thisImg){
				thisImg.src = minusImg.src;
				}
					for(var i = 1; i <= _menu_Num; i++){
						if(i != _sub_menu_Id) hideLevel(_menu_Id+i,_menu_Id+i+'Img');
					}
        } else hideLevel(_menu_Id+_sub_menu_Id,_menu_Id+_sub_menu_Id+'Img');
	}
}
// End Version 1

// Version 2 : Enhanced DIV
function newHideLevel(_levelId,_imgId) {
        var thisLevel = document.getElementById(_levelId);
        var thisSrc = document.getElementById(_imgId);
			if(thisLevel){
				//thisLevel.filter.alpha.opacity = "0";
				thisLevel.style.display = "none";
			}
			if(thisSrc){
				thisSrc.innerHTML = plusSrc;
			}
}

function newShowLevel_(_levelId,_imgId) {
        var thisLevel = document.getElementById(_levelId);
        var thisSrc = document.getElementById(_imgId);
		
		if(thisLevel){
				//thisLevel.filter.alpha.opacity = "0";
				thisLevel.style.display = "block";
			}
			if(thisSrc){
				thisSrc.innerHTML = minusSrc;
			}
}

function newHideAll(_menu_Id,_menu_Num) {

		for(var i = 1; i <= _menu_Num; i++){
				newHideLevel(_menu_Id+i,_menu_Id+i+'Img');
			}
        }

function newShowAll(_menu_Id,_menu_Num) {

		for(var i = 1; i <= _menu_Num; i++){
				newShowLevel_(_menu_Id+i,_menu_Id+i+'Img');
			}
        }

function newShowLevel(_menu_Id,_sub_menu_Id,_menu_Num) {
        
		var thisLevel = document.getElementById(_menu_Id+_sub_menu_Id);
        var thisSrc = document.getElementById(_menu_Id+_sub_menu_Id+'Img');
		
        if (thisLevel){
		if (thisLevel.style.display == "none") {
                //thisLevel.filter.alpha.opacity="100";
				thisLevel.style.display = "block";
				if(thisSrc){
				thisSrc.innerHTML = minusSrc;
				}
					for(var i = 1; i <= _menu_Num; i++){
						if(i != _sub_menu_Id) newHideLevel(_menu_Id+i,_menu_Id+i+'Img');
					}
        } else newHideLevel(_menu_Id+_sub_menu_Id,_menu_Id+_sub_menu_Id+'Img');
	}
}

// End Version 2

// End Function Block of Iie's Cross-Browser Hierarchical Auto Expandable Menu

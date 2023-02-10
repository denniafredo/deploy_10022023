var getQueryParam = function(param) {
	location.search.substr(1)
	.split("&")
	.some(function(item) { // returns first occurence and stops
		return item.split("=")[0] == param && (param = item.split("=")[1])
	})
	return param;
}

if (!Date.nowtime) {
    Date.nowtime = function now() {
        return new Date().getTime();
    };
}

String.prototype.splice = function(idx, rem, s) {
    return (this.slice(0, idx) + s + this.slice(idx + Math.abs(rem)));
};
angular.module('app', ['ionic', 'app.controllers', 'app.routes', 'app.directives','app.services',])

.run(function($ionicPlatform) {

  $ionicPlatform.ready(function() {

  });
})


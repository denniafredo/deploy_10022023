angular.module('app.directives', [])

.directive('mdToggle', function($ionicGesture, $timeout) {
	return {
		restrict: 'E',
    replace: 'true',
    require: '?ngModel',
    transclude: true,
		template: '<div class="flip-toggle" style="display:inline-block;">' +
			'<div ng-transclude></div>' +
			'<label class="toggle">' +
			'<input type="checkbox">' +
			'<div class="track">' +
			'<div class="handle"><span class="handle-label handle-label-a">YA</span>'+
			'<span class="handle-label handle-label-b">&nbsp;Tidak</span></div>' +
			'</div>' +
			'</label>' +
			'</div>',
		compile: function(element, attr) {
      var input = element.find('input');
      angular.forEach({
        'name': attr.name,
        'ng-value': attr.ngValue,
        'ng-model': attr.ngModel,
        'ng-checked': attr.ngChecked,
        'ng-disabled': attr.ngDisabled,
        'ng-true-value': attr.ngTrueValue,
        'ng-false-value': attr.ngFalseValue,
        'ng-change': attr.ngChange
      }, function(value, name) {
        if (angular.isDefined(value)) {
          input.attr(name, value);
        }
      });

      
      if(attr.toggleClass) {
        element[0].getElementsByTagName('label')[0].classList.add(attr.toggleClass);
      }

      return function($scope, $element, $attr) {
        var el, checkbox, track, handle;

        el = $element[0].getElementsByTagName('label')[0];
        checkbox = el.children[0];
        track = el.children[1];
        handle = track.children[0];

        var ngModelController = angular.element(checkbox).controller('ngModel');

        $scope.toggle = new ionic.views.Toggle({
          el: el,
          track: track,
          checkbox: checkbox,
          handle: handle,
          onChange: function() {
            if(checkbox.checked) {
              ngModelController.$setViewValue(true);
            } else {
              ngModelController.$setViewValue(false);
            }
            $scope.$apply();
          }
        });

        $scope.$on('$destroy', function() {
          $scope.toggle.destroy();
        });
      };
    }
	}
})
/*.directive('currencyInput', function() {
    return {
        restrict: 'A',
        scope: {
            field: '='
        },
        replace: true,
        template: '<span><input type="text" ng-model="field"></input>{{field}}</span>',
        link: function(scope, element, attrs) {
            $(element).bind('keyup', function(e) {
                var input = element.find('input');
                var inputVal = input.val();

                //clearing left side zeros
                while (scope.field.charAt(0) == '0') {
                    scope.field = scope.field.substr(1);
                }

                scope.field = scope.field.replace(/[^\d.\',']/g, '');

                var point = scope.field.indexOf(".");
                if (point >= 0) {
                    scope.field = scope.field.slice(0, point + 3);
                }

                var decimalSplit = scope.field.split(".");
                var intPart = decimalSplit[0];
                var decPart = decimalSplit[1];

                intPart = intPart.replace(/[^\d]/g, '');
                if (intPart.length > 3) {
                    var intDiv = Math.floor(intPart.length / 3);
                    while (intDiv > 0) {
                        var lastComma = intPart.indexOf(",");
                        if (lastComma < 0) {
                            lastComma = intPart.length;
                        }

                        if (lastComma - 3 > 0) {
                            intPart = intPart.splice(lastComma - 3, 0, ",");
                        }
                        intDiv--;
                    }
                }

                if (decPart === undefined) {
                    decPart = "";
                }
                else {
                    decPart = "." + decPart;
                }
                var res = intPart + decPart;

                scope.$apply(function() {scope.field = res});

            });

        }
    };
})
*/
  .directive('tnfSignaturePad', function ($ionicModal) {
    var canvas = null,
      ratio = 1.0;

    return {
      scope: {
        signature: '=ngModel'
      },
      link: function ($scope, $element, $attrs, $controller) {
        $scope.signaturePadModel = {};

        $ionicModal.fromTemplateUrl('templates/signaturePad.html', {
          animation: 'slide-in-up',
          scope: $scope,
        }).then(function(modal) {
          $scope.signatureModal = modal;
        });

        $scope.$on('$destroy', function () {
          $scope.signatureModal.remove();
        });

        $scope.openSignatureModal = function () {
          $scope.signatureModal.show();
          canvas = angular.element($scope.signatureModal.modalEl).find('canvas')[0];

          $scope.signaturePad = new SignaturePad(canvas, {
            backgroundColor: '#FFF',
            minWidth: 1,
            maxWidth: 1.5,
            dotSize: 3,
            penColor: 'rgb(66, 133, 244)',
            onEnd: function () {
              $scope.signature = $scope.signaturePad.toDataURL();
            }
          });

          if ($scope.signature) {
            $scope.signaturePad.fromDataURL($scope.signature);
          }
          $scope.resizeCanvas();
        };

        $scope.resizeCanvas = function () {
          var ratio = 1.0;
          canvas.width = canvas.offsetWidth * ratio;
          canvas.height = canvas.offsetHeight * ratio;
          canvas.getContext('2d').scale(ratio, ratio);          
        };

        $scope.clear = function () {
          $scope.signaturePadModel.signatureConfirm = false;
          $scope.signaturePad.clear();
          $scope.signature = null;
        };

        $scope.save = function () {
          $scope.signaturePadModel = {};
          $scope.signatureModal.hide();
        };
      },
      require: 'ngModel',
      replace: true,
      restrict: 'EA',
      templateUrl: 'templates/signaturePadButton.html'
    };
  })
.directive('customOnChange', function() {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      var onChangeFunc = scope.$eval(attrs.customOnChange);
      element.bind('change', onChangeFunc);
    }
  };
})
.directive('uiMultiRange', function ($compile){
	    var directive = {
        restrict: 'E',
        scope: {
            ngModelMin: '=',
            ngModelMax: '=',
            ngMin: '=',
            ngMax: '=',
            ngStep: '=',
            ngChangeMin: '&',
            ngChangeMax: '&'
        },
        link: link
    };

    return directive;

    ////////////////////
	
	   function link ($scope, $element, $attrs) {
        var min, max, step, $inputMin = angular.element('<input type="range">'), $inputMax;
        $scope.ngChangeMin = $scope.ngChangeMin || angular.noop;
        $scope.ngChangeMax = $scope.ngChangeMax || angular.noop;

        if (typeof $scope.ngMin == 'undefined') {
            min = 0;
        } else {
            min = $scope.ngMin;
            $inputMin.attr('min', min);
        }
        if (typeof $scope.ngMax == 'undefined') {
            max = 0;
        } else {
            max = $scope.ngMax;
            $inputMin.attr('max', max);
        }
        if (typeof $scope.ngStep == 'undefined') {
            step = 0;
        } else {
            step = $scope.ngStep;
            $inputMin.attr('step', step);
        }
        $inputMax = $inputMin.clone();
        $inputMin.attr('ng-model', 'ngModelMin');
        $inputMax.attr('ng-model', 'ngModelMax');
        $compile($inputMin)($scope);
        $compile($inputMax)($scope);
        $element.append($inputMin).append($inputMax);
        $scope.ngModelMin = $scope.ngModelMin || min;
        $scope.ngModelMax = $scope.ngModelMax || max;

        $scope.$watch('ngModelMin', function (newVal, oldVal) {
            if (newVal > $scope.ngModelMax) {
                $scope.ngModelMin = oldVal;
            } else {
                $scope.ngChangeMin();
            }
        });

        $scope.$watch('ngModelMax', function (newVal, oldVal) {
            if (newVal < $scope.ngModelMin) {
                $scope.ngModelMax = oldVal;
            } else {
                $scope.ngChangeMax();
            }
        });
    }
})
.directive('drawing', function() {
  return {

    restrict: "A",
    link: function(scope, element){
      var ctx = element[0].getContext('2d');

      // variable that decides if something should be drawn on mousemove
      var drawing = false;

      // the last coordinates before the current move
      var lastX;
      var lastY;

      element.bind('mousedown touchstart', function(event){
		  
        if(event.offsetX!==undefined){
          lastX = event.offsetX;
          lastY = event.offsetY;
        } else { // Firefox compatibility
          lastX = event.layerX - event.currentTarget.offsetLeft;
          lastY = event.layerY - event.currentTarget.offsetTop;
        }

        // begins new line
        ctx.beginPath();

        drawing = true;
      });
      element.bind('mousemove touchmove', function(event){

        if(drawing){
          // get current mouse position
          if(event.offsetX!==undefined){
            currentX = event.offsetX;
            currentY = event.offsetY;
          } else {
            currentX = event.layerX - event.currentTarget.offsetLeft;
            currentY = event.layerY - event.currentTarget.offsetTop;
          }

          draw(lastX, lastY, currentX, currentY);

          // set current coordinates to last one
          lastX = currentX;
          lastY = currentY;
        }

      });
      element.bind('mouseup touchend', function(event){
        // stop drawing
        drawing = false;
      });

      // canvas reset
      function reset(){
       element[0].width = element[0].width; 
      }

      function draw(lX, lY, cX, cY){
        // line from
        ctx.moveTo(lX,lY);
        // to
        ctx.lineTo(cX,cY);
        // color
        ctx.strokeStyle = "#4bf";
        // draw it
        ctx.stroke();
      }
    }
  };
})

.directive('boundModel', function() {
  return {
    require: 'ngModel',
    link: function(scope, elem, attrs, ngModel) {
      scope.$watch(attrs.boundModel, function(newValue, oldValue) {
        if(newValue != oldValue) {
          ngModel.$setViewValue(newValue);
          ngModel.$render();
        }
      });
    }
  };
})
.directive('customOnChange', function() {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      var onChangeHandler = scope.$eval(attrs.customOnChange);
      element.bind('change', onChangeHandler);
    }
  };
})
.directive('input', [function() {
    return {
        restrict: 'E',
        require: '?ngModel',
        link: function(scope, element, attrs, ngModel) {
            if (
                   'undefined' !== typeof attrs.type
                && 'number' === attrs.type
                && ngModel
            ) {
                ngModel.$formatters.push(function(modelValue) {
                    return Number(modelValue);
                });

                ngModel.$parsers.push(function(viewValue) {
                    return Number(viewValue);
                });
            }
        }
    }
}])
;
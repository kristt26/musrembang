angular.module('directives', [])
.directive('fileModel', function ($parse) {
    return {
       restrict: 'A',
       link: function(scope, element, attrs) {
          element.bind('change', function(){
          $parse(attrs.fileModel).assign(scope,element[0].files)
             scope.$apply();
          });
       }
    };
})
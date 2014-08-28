var app = angular.module('myApp', ['ui.codemirror', 'ngAnimate']);

app.controller('EditorController', ['$scope', '$window', function($scope, $window) {
    $scope.editorOptions = {
        lineWrapping : true,
        indentUnit : 4,
    };

    $scope.countOf = function(text) {
        if(!text) {
            return 0;
        }
        // search for matches and count them
        else {
            var matches = text.match(/[^\s\n\r]+/g);
            return matches ? matches.length : 0;
        }
    };
}]);


app.controller('FooterController', ['$scope', function($scope) {
    $scope.submitText = 'Save Draft';
    $scope.submitStatus = false;

    $scope.updateSubmit = function(value) {
        $scope.submitText = value;
    };
}]);


app.directive('markdown', function () {
    var converter = new Showdown.converter();
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var htmlText = converter.makeHtml(element.text());
            element.html(htmlText);
        }
    };

});


app.filter('markdown', function ($sce) {
    var converter = new Showdown.converter();
    return function (value) {
        var html = converter.makeHtml(value || '');
        return $sce.trustAsHtml(html);
    };
});

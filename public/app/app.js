var app = angular.module('app', []);

var myApp = angular.module('myApp', ['ui.codemirror', 'ngAnimate']);

myApp.controller('EditorController', ['$scope', '$window', function($scope, $window) {
    //codemirror editor settings
    $scope.editorOptions = {
        lineWrapping : true,
        indentUnit : 4,
    };

    //get word count of text
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


myApp.controller('FooterController', ['$scope', function($scope) {
    //set defaults for publish status
    $scope.submitText = 'Save Draft';
    $scope.submitStatus = false;
    //toggle the publish status value
    $scope.updateSubmit = function(value) {
        $scope.submitText = value;
    };
}]);

//markdown directive used to render saved markdown from database
myApp.directive('markdown', function () {
    var converter = new Showdown.converter();
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var htmlText = converter.makeHtml(element.text());
            element.html(htmlText);
        }
    };
});

//markdown filter used with codemirror to show live preview
myApp.filter('markdown', function ($sce) {
    var converter = new Showdown.converter();
    var markdownNoImageRegex = /!\[.*\S.*]/;
    var markdownImageRegex = /!\[.*\S.*]\((http|https):.*\S.*(\))/;
    
    return function (value) {
        // I need to break apart the string into an array
        var processTemplate = function(text) {
            var lines = text.split('\n' );
            for (i = lines.length - 1; i >= 0; i--) {
                line = lines[i];
                if (line.match(markdownNoImageRegex) && ! line.match(markdownImageRegex)) {
                    lines[i] = 'no image<br>';
                }
            }
            return lines.join('\n');
        };
        var process = processTemplate(value || '');
        var html = converter.makeHtml(process);
        return $sce.trustAsHtml(html);
    };
});


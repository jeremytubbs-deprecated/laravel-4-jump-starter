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


app.filter('markdown', function ($sce) {
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


var app = angular.module('myApp', []);

// app.directive('markdown', function () {
//     var converter = new Showdown.converter();
//     return {
//         restrict: 'A',
//         link: function (scope, element, attrs) {
//             var htmlText = converter.makeHtml(element.text());
//             element.html(htmlText);
//         }
//     };

// });

app.filter('markdown', function ($sce) {
    var converter = new Showdown.converter();
    return function (value) {
		var html = converter.makeHtml(value || '');
        return $sce.trustAsHtml(html);
    };
});

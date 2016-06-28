var myApp = angular.module('myApp', []);

myApp.controller('MainCtrl', ['$scope', function ($scope) {
    // Magie du contrôleur
    $scope.news = {};
    $scope.news.details = {
        "id": "2454664",
        "title": "Titre",
        "description": "Description",
        "source_link": "http://www.google.fr/",
        "published_date": "21/06/2016"
    };
}]);

myApp.directive('customButton', function () {
    return {
        link: function (scope, element, attrs) {
            // manipulation du DOM et événements
        }
    };
});
myApp.directive('customButton', function () {
    return {
        restrict: 'A',
        replace: true,
        transclude: true,
        template: '<a href="" class="myawesomebutton" ng-transclude>' +
        '<i class="icon-ok-sign"></i>' +
        '</a>',
        link: function (scope, element, attrs) {
            // DOM manipulation/events here!
        }
    };
});



var _url_DB="./DB/DB.php";

var adnNews = angular.module('adnNews', []);

adnNews.controller('displayAllNewsController', function($scope,$http){
    var urlGetAllNews  = "./DB/DB.php?action=getNews";
        $http.get(urlGetAllNews)
            .then(function (response) {
                $scope.newsList = response.data;
            });
});

adnNews.controller('displayASpecificNewsController', function($scope,$http){
    var _news_id = getParameterByName('news_id');
    var urlGetASpecificNews = './DB/DB.php?action=getNewsById&news_id=' + _news_id;
    var urlAddALike = './DB/DB.php?action=updateNbLikes&news_id=' + _news_id;

    $http.get(urlGetASpecificNews)
        .then(function (response) {
            $scope.newsDisplay = response.data;
        });

    $scope.likeArticle = function() {
        $http.get(urlAddALike)
            .then(
                function(response){
                    // success callback
                    console.log("Like added");
                    $scope.newsDisplay[0].Nb_Likes++;
                }
            );
    }
});

adnNews.controller('postANewsController', function($scope,$http){
    var urlGetAllNews  = "./DB/DB.php?action=getNews";
    $http.get(urlGetAllNews)
        .then(function (response) {
            $scope.newsList = response.data;
        });
});

adnNews.controller('postANewsController', function ($scope, $http) {
    var urlAddANews = "./DB/DB.php?action=addNewNews";

    // calling our submit function.
    $scope.submitForm = function() {
        // Posting data to php file
        if( ($scope.title != undefined && $scope.description != undefined  && $scope.imagelink != undefined && $scope.link != undefined) ) {
            urlAddANews += "&Title=" + $scope.title + "&ImageLink=" + $scope.imagelink + "&Description=" + $scope.description + "&Link=" + $scope.link;

            $http({
                method: 'GET',
                url: urlAddANews,
                data: null, //forms user object
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .success(function (data) {
                    console.log(data);
                    alert("The news has been added.");

                    $(location).attr('href', './index.html');
                });
        } else {
        alert ("Please fill all the fields");
        }
    }
});

adnNews.controller('postACommentController', function ($scope,$http) {
    var urlAddANews = "./DB/DB.php?action=addNewComment";
    var _news_id = getParameterByName('news_id');

    // calling our submit function.
    $scope.submitComment = function() {
        // Posting data to php file
        if( ($scope.username != undefined && $scope.commentMessage != undefined) ) {
            urlAddANews += "&Username=" + $scope.username + "&CommentMessage=" + $scope.commentMessage + "&NewsId=" + _news_id;

            $http({
                method: 'POST',
                url: urlAddANews,
                data: null, //forms user object
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                .success(function (data) {
                    alert("The comment has been added.");
                    location.reload();
                });
        } else {
            alert ("Please fill all the fields");
        }
    }
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
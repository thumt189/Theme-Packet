'use strict';

/**
 * Config for the router
 */
app.config(['$stateProvider', '$urlRouterProvider', '$controllerProvider', '$compileProvider', '$filterProvider', '$provide', '$ocLazyLoadProvider', 'JS_REQUIRES',
function ($stateProvider, $urlRouterProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $ocLazyLoadProvider, jsRequires) {

    app.controller = $controllerProvider.register;
    app.directive = $compileProvider.directive;
    app.filter = $filterProvider.register;
    app.factory = $provide.factory;
    app.service = $provide.service;
    app.constant = $provide.constant;
    app.value = $provide.value;

    // LAZY MODULES

    $ocLazyLoadProvider.config({
        debug: false,
        events: true,
        modules: jsRequires.modules
    });

    // APPLICATION ROUTES
    // -----------------------------------
    // For any unmatched url, redirect to /app/dashboard
    $urlRouterProvider.otherwise("/app/dashboard");
    //
    // Set up the states
    $stateProvider.state('app', {
        url: "/app",
        templateUrl: "include/views/app.html",
        resolve: loadSequence('chartjs', 'chart.js', 'chatCtrl'),
        abstract: true
    }).state('app.dashboard', {
        url: "/dashboard",
        templateUrl: "include/views/dashboard.html",
        resolve: loadSequence('d3', 'ui.knob', 'countTo', 'dashboardCtrl'),
        title: 'Dashboard',
        ncyBreadcrumb: {
            label: 'Trang chủ'
        }
    }).state('app.admin', {
        url: '/admin',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'Page Layouts',
        ncyBreadcrumb: {
            label: 'Quản lý'
        }
    }).state('app.admin.room', {
        url: "/room-manage",
        templateUrl: "include/labs/room.html",
        resolve: loadSequence('d3', 'ui.knob', 'countTo', 'dashboardCtrl'),
        title: 'Room Manage ',
        ncyBreadcrumb: {
            label: 'Room'
        },
        controller: function ($scope) {
            $scope.setLayout();
            $scope.app.layout.isNavbarFixed = true;
        }
    }).state('app.admin.soft', {
        url: "/soft-manage",
        templateUrl: "include/labs/soft.html",
        resolve: loadSequence('d3', 'ui.knob', 'countTo', 'dashboardCtrl'),
        title: 'Soft manage',
        ncyBreadcrumb: {
            label: 'Soft'
        },
        controller: function ($scope) {
            $scope.setLayout();
            $scope.app.layout.isSidebarFixed = true;
        }
    }).state('app.admin.computer', {
        url: "/computer-manage",
        templateUrl: "include/labs/computer.html",
        resolve: loadSequence('d3', 'ui.knob', 'countTo', 'dashboardCtrl'),
        title: 'Computer manage',
        ncyBreadcrumb: {
            label: 'Computer'
        },
        controller: function ($scope) {
            $scope.setLayout();
            $scope.app.layout.isSidebarFixed = true;
            $scope.app.layout.isNavbarFixed = true;
        }
    }).state('app.admin.teacher', {
        url: "/teacher-manage",
        templateUrl: "include/labs/teacher.html",
        resolve: loadSequence('teacherCtrl', 'ngTable', 'toaster'),
        ncyBreadcrumb: {
            label: 'Teacher'
        },
        controller: function ($scope) {
            $scope.setLayout();
            $scope.app.layout.isFooterFixed = true;
        }
    }).state('app.admin.subject', {
        url: "/subject-manage",
        templateUrl: "include/labs/subject.html",
        resolve: loadSequence('subjectCtrl', 'ngTable', 'toaster'),
        title: 'Subject Manage',
        ncyBreadcrumb: {
            label: 'Subject'
        }
    }).state('app.admin.class', {
        url: "/class-manage",
        templateUrl: "include/labs/class.html",
        resolve: loadSequence('classCtrl', 'ngTable', 'toaster'),
        title: 'Class Manage',
        ncyBreadcrumb: {
            label: 'Class'
        }
    }).state('app.user', {
        url: '/admin',
        template: '<div ui-view class="fade-in-up"></div>',
        title: 'Trang người dùng',
        ncyBreadcrumb: {
            label: 'Người dùng'
        }
    }).state('app.user.class', {
        url: "/class-manage",
        templateUrl: "include/labs/class.html",
        resolve: loadSequence('classCtrl', 'ngTable', 'toaster'),
        title: 'Class Manage',
        ncyBreadcrumb: {
            label: 'Class'
        }
    });
    // Generates a resolve object previously configured in constant.JS_REQUIRES (config.constant.js)
    function loadSequence() {
        var _args = arguments;
        return {
            deps: ['$ocLazyLoad', '$q',
			function ($ocLL, $q) {
			    var promise = $q.when(1);
			    for (var i = 0, len = _args.length; i < len; i++) {
			        promise = promiseThen(_args[i]);
			    }
			    return promise;

			    function promiseThen(_arg) {
			        if (typeof _arg == 'function')
			            return promise.then(_arg);
			        else
			            return promise.then(function () {
			                var nowLoad = requiredData(_arg);
			                if (!nowLoad)
			                    return $.error('Route resolve: Bad resource name [' + _arg + ']');
			                return $ocLL.load(nowLoad);
			            });
			    }

			    function requiredData(name) {
			        if (jsRequires.modules)
			            for (var m in jsRequires.modules)
			                if (jsRequires.modules[m].name && jsRequires.modules[m].name === name)
			                    return jsRequires.modules[m];
			        return jsRequires.scripts && jsRequires.scripts[name];
			    }
			}]
        };
    }
}]);
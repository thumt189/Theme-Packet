'use strict';

/**
 * Config constant
 */
app.constant('APP_MEDIAQUERY', {
    'desktopXL': 1200,
    'desktop': 992,
    'tablet': 768,
    'mobile': 480
});
app.constant('JS_REQUIRES', {
    //*** Scripts
    scripts: {
        //*** Javascript Plugins
        'd3': 'include/theme/bower_components/d3/d3.min.js',

        //*** jQuery Plugins
        'chartjs': 'include/theme/bower_components/chartjs/Chart.min.js',
        'ckeditor-plugin': 'include/theme/bower_components/ckeditor/ckeditor.js',
        'jquery-nestable-plugin': ['include/theme/bower_components/jquery-nestable/jquery.nestable.js'],
        'touchspin-plugin': ['include/theme/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js', 'include/theme/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css'],
        'jquery-appear-plugin': ['include/theme/bower_components/jquery-appear/build/jquery.appear.min.js'],
        'spectrum-plugin': ['include/theme/bower_components/spectrum/spectrum.js', 'include/theme/bower_components/spectrum/spectrum.css'],

        //*** Controllers
        'dashboardCtrl': 'include/theme/assets/js/controllers/dashboardCtrl.js',
        'iconsCtrl': 'include/theme/assets/js/controllers/iconsCtrl.js',
        'vAccordionCtrl': 'include/theme/assets/js/controllers/vAccordionCtrl.js',
        'ckeditorCtrl': 'include/theme/assets/js/controllers/ckeditorCtrl.js',
        'laddaCtrl': 'include/theme/assets/js/controllers/laddaCtrl.js',
        'ngTableCtrl': 'include/theme/assets/js/controllers/ngTableCtrl.js',
        'cropCtrl': 'include/theme/assets/js/controllers/cropCtrl.js',
        'asideCtrl': 'include/theme/assets/js/controllers/asideCtrl.js',
        'toasterCtrl': 'include/theme/assets/js/controllers/toasterCtrl.js',
        'sweetAlertCtrl': 'include/theme/assets/js/controllers/sweetAlertCtrl.js',
        'mapsCtrl': 'include/theme/assets/js/controllers/mapsCtrl.js',
        'chartsCtrl': 'include/theme/assets/js/controllers/chartsCtrl.js',
        'calendarCtrl': 'include/theme/assets/js/controllers/calendarCtrl.js',
        'nestableCtrl': 'include/theme/assets/js/controllers/nestableCtrl.js',
        'validationCtrl': ['include/theme/assets/js/controllers/validationCtrl.js'],
        'userCtrl': ['include/theme/assets/js/controllers/userCtrl.js'],
        'selectCtrl': 'include/theme/assets/js/controllers/selectCtrl.js',
        'wizardCtrl': 'include/theme/assets/js/controllers/wizardCtrl.js',
        'uploadCtrl': 'include/theme/assets/js/controllers/uploadCtrl.js',
        'treeCtrl': 'include/theme/assets/js/controllers/treeCtrl.js',
        'inboxCtrl': 'include/theme/assets/js/controllers/inboxCtrl.js',
        'xeditableCtrl': 'include/theme/assets/js/controllers/xeditableCtrl.js',
        'chatCtrl': 'include/theme/assets/js/controllers/chatCtrl.js',
        'dynamicTableCtrl': 'include/theme/assets/js/controllers/dynamicTableCtrl.js',
        'notificationIconsCtrl': 'include/theme/assets/js/controllers/notificationIconsCtrl.js',
        'dateRangeCtrl': 'include/theme/assets/js/controllers/daterangeCtrl.js',
        'notifyCtrl': 'include/theme/assets/js/controllers/notifyCtrl.js',
        'sliderCtrl': 'include/theme/assets/js/controllers/sliderCtrl.js',
        'knobCtrl': 'include/theme/assets/js/controllers/knobCtrl.js',
        
        
    },
    //*** angularJS Modules
    modules: [{
        name: 'toaster',
        files: ['include/theme/bower_components/AngularJS-Toaster/toaster.js', 'include/theme/bower_components/AngularJS-Toaster/toaster.css']
    }, {
        name: 'angularBootstrapNavTree',
        files: ['include/theme/bower_components/angular-bootstrap-nav-tree/dist/abn_tree_directive.js', 'include/theme/bower_components/angular-bootstrap-nav-tree/dist/abn_tree.css']
    }, {
        name: 'ngTable',
        files: ['include/theme/bower_components/ng-table/dist/ng-table.min.js', 'include/theme/bower_components/ng-table/dist/ng-table.min.css']
    }, {
        name: 'ui.mask',
        files: ['include/theme/bower_components/angular-ui-utils/mask.min.js']
    }, {
        name: 'ngImgCrop',
        files: ['include/theme/bower_components/ngImgCrop/compile/minified/ng-img-crop.js', 'include/theme/bower_components/ngImgCrop/compile/minified/ng-img-crop.css']
    }, {
        name: 'angularFileUpload',
        files: ['include/theme/bower_components/angular-file-upload/angular-file-upload.min.js']
    }, {
        name: 'monospaced.elastic',
        files: ['include/theme/bower_components/angular-elastic/elastic.js']
    }, {
        name: 'ngMap',
        files: ['include/theme/bower_components/ngmap/build/scripts/ng-map.min.js']
    }, {
        name: 'chart.js',
        files: ['include/theme//bower_components/angular-chart.js/dist/angular-chart.min.js', 'include/theme//bower_components/angular-chart.js/dist/angular-chart.min.css']
    }, {
        name: 'flow',
        files: ['include/theme/bower_components/ng-flow/dist/ng-flow-standalone.min.js']
    }, {
        name: 'ckeditor',
        files: ['include/theme/bower_components/angular-ckeditor/angular-ckeditor.min.js']
    }, {
        name: 'mwl.calendar',
        files: ['include/theme/bower_components/angular-bootstrap-calendar/dist/js/angular-bootstrap-calendar-tpls.js', 'include/theme/bower_components/angular-bootstrap-calendar/dist/css/angular-bootstrap-calendar.min.css', 'include/theme/assets/js/config/config-calendar.js']
    }, {
        name: 'ng-nestable',
        files: ['include/theme/bower_components/ng-nestable/src/angular-nestable.js']
    }, {
        name: 'ngNotify',
        files: ['include/theme/bower_components/ng-notify/dist/ng-notify.min.js', 'include/theme/bower_components/ng-notify/dist/ng-notify.min.css']
    }, {
        name: 'xeditable',
        files: ['include/theme/bower_components/angular-xeditable/dist/js/xeditable.min.js', 'include/theme/bower_components/angular-xeditable/dist/css/xeditable.css', 'include/theme/assets/js/config/config-xeditable.js']
    }, {
        name: 'checklist-model',
        files: ['include/theme/bower_components/checklist-model/checklist-model.js']
    }, {
        name: 'ui.knob',
        files: ['include/theme/bower_components/ng-knob/dist/ng-knob.min.js']
    }, {
        name: 'ngAppear',
        files: ['include/theme/bower_components/angular-appear/build/angular-appear.min.js']
    }, {
        name: 'countTo',
        files: ['include/theme/bower_components/angular-count-to-0.1.1/dist/angular-filter-count-to.min.js']
    }, {
        name: 'angularSpectrumColorpicker',
        files: ['include/theme/bower_components/angular-spectrum-colorpicker/dist/angular-spectrum-colorpicker.min.js']
    }]
});
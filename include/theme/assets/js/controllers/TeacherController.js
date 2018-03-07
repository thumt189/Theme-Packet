app.controller('teacherCtrl', ["$scope", "$filter", "ngTableParams", "mainService", "toaster", function ($scope, $filter, ngTableParams, mainService, toaster) {
        var uri = "teacher.php";
        $scope.data = [];
        $scope.role = [];
        $scope.selected_role;
        $scope.isAdding = false;
        $scope.editId = -1;
        $scope.removeId = -1;

        $scope.getData = function () {

            var data = getMode('get_data');
            mainService.doAction(uri, data).then(function (response) {
                $scope.data = response.data.teacher;
                $scope.role = response.data.role;
                $scope.init();
            });
        };

        $scope.addData = function (p) {
            var data = getMode("add_data");
            data['name'] = p.name;
            data['account'] = p.account;
            data['password'] = p.password;
            data['role_id'] = p.role.id;
            data['note'] = p.note;
            mainService.doAction(uri, data).then(function (response) {
                var status = response.status;
                if (status == 'success') {
                    toaster.pop('success', 'Thông báo', 'Thêm mới thành công')
                    $scope.getData();
                    p.name = '';
                    p.account = '';
                    p.password = '';
                    p.note = '';
                    $scope.isAdding = false;
                } else {
                    toaster.pop('danger', 'Thông báo', 'Có lỗi xảy ra')
                }


            });
        };

        $scope.editData = function (p) {
            var data = getMode('edit_data');
            data['id'] = p.id;
            data['name'] = p.name;
            data['account'] = p.account;
            data['password'] = p.password;
            data['role_id'] = p.role_id;
            data['note'] = p.note;
            mainService.doAction(uri, data).then(function (response) {
                var status = response.status;
                if (status == 'success') {
                    toaster.pop('success', 'Thông báo', 'Sửa thành công');
                    $scope.setEditId(-1);
                    $scope.getData();
                } else {
                    toaster.pop('danger', 'Thông báo', 'Có lỗi xảy ra');
                }

            });
        };

        $scope.removeData = function (p) {
            var data = getMode("remove_data");
            data['id'] = p.id;
            mainService.doAction(uri, data).then(function (response) {
                var status = response.status;
                toaster.clear();
                if (status == 'success') {
                    toaster.pop('success', 'Thông báo', 'Xóa thành công');
                    $scope.getData();
                } else {
                    toaster.pop('danger', 'Thông báo', 'Có lỗi xảy ra');
                }

            });
        };

        $scope.init = function () {
            $scope.tableDisplay = new ngTableParams({
                page: 1,
                count: 10
            }, {
                total: $scope.data.length,
                getData: function ($defer, params) {
                    var orderedData = params.sorting() ? $filter('orderBy')($scope.data, params.orderBy()) : $scope.data;
                    $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
                }
            });
        };

        $scope.setAddData = function (p) {
            if (p == false) {
                $scope.isAdding = false;
            }
            if (p == true) {
                $scope.isAdding = true;
            }
        };

        $scope.setEditId = function (p) {
            $scope.editId = p.id;
            var loop_item;
            for (var i = 0; i < $scope.role.length; i++) {
                loop_item = $scope.role[i];
                if (loop_item.id == p.role_id) {
                    $scope.selected_role = loop_item;
                    break;
                }
            }

        };

        $scope.setRemoveId = function (p) {
            $scope.removeId = p.id;
            var loop_item;
            for (var i = 0; i < $scope.role.length; i++) {
                loop_item = $scope.role[i];
                if (loop_item.id == p.role_id) {
                    $scope.selected_role = loop_item;
                    break;
                }
            }
        }

        $scope.getData();
    }]);
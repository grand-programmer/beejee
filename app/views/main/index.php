<?php
$message=new \App\core\components\Alert();
$alert=$message->get();
if($alert['code'] == 20000) {  ?>
    <div class="alert alert-success text-center" role="alert" >
        Успешно авторизовался!
    </div>
    <?php
} ?>
<?php if($alert['code'] == 50000) {  ?>
    <div class="alert alert-danger text-center" role="alert">
        <?php if(isset($alert['message']))  echo $alert['message']; else echo 'Выведнные данные не верно!';?>
    </div>
    <?php } ?>
<div class="container">
    <div class="row">
        <br><br>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-xs-6">
                            <h3 class="panel-title">Tasks  <a target="_blank" style="margin-left: 100px;" href="https://github.com/grand-programmer/beejee.git"><em class="fa fa-github"></em> Github repository</a></h3>
                        </div>
                        <div class="col col-xs-6 text-right">
                            <button type="button" data-toggle="modal" data-target="#squarespaceModal" class="btn btn-sm btn-primary btn-create">Create New Task</button>
                            <?php
                            if  (\App\Controllers\UserController::isAuthorized()) { ?>
                                <a type="button" href="/user/logout"><em class="fa fa-user"></em> Logout</a>
                            <?php  } else { ?>
                                <button class="btn btn-success" data-toggle="modal" data-target="#loginModal">Login</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-sortable" >
                        <thead>
                        <tr>
                            <?php
                            if  (\App\Controllers\UserController::isAuthorized()) { ?>
                                <th class=" table-header col-md-1"><em class="fa fa-cog"></em></th>
                            <?php }?>
                            <th class="table-header col-md-1 nosortable " >ID</th>
                            <?php if($data['options']['column']=='username'):?>
                                <th  class="table-header col-md-3 <?= $data['options']['sort']; ?>"><a href="<?=change_params_url(['sort'=>($data['options']['sort']=='asc')?'desc':'asc','column'=>'username'])?>">User name</a></th>
                            <?php else: ?>
                                <th  class="table-header col-md-3 asc"><a href="<?=change_params_url(['sort'=>'desc','column'=>'username'])?>">User name</a></th>
                            <?php endif;?>
                            <?php if($data['options']['column']=='email'):?>
                                <th class="table-header col-md-3 <?= $data['options']['sort']; ?>"><a href="<?=change_params_url(['sort'=>($data['options']['sort']=='asc')?'desc':'asc','column'=>'email'])?>">Email</a></th>
                            <?php else: ?>
                                <th  class="table-header col-md-3 asc"><a href="<?=change_params_url(['sort'=>'desc','column'=>'email'])?>">Email</a></th>
                            <?php endif;?>
                            <th  class="table-header col-md-3 nosortable" style="width: 20%" data-sort="asc" data-column="task">Task</th>
                            <?php if($data['options']['column']=='status'):?>
                                <th class="table-header <?= $data['options']['sort']; ?>"><a href="<?=change_params_url(['sort'=>($data['options']['sort']=='asc')?'desc':'asc','column'=>'status'])?>">Status</a></th>
                            <?php else: ?>
                                <th  class="table-header asc" ><a href="<?=change_params_url(['sort'=>'desc','column'=>'status'])?>">Status</a></th>
                            <?php endif;?>
                        </tr>
                        </thead>
                        <tbody>
                        <div id="content">
                            <?php foreach ($data['tasks'] as $val): ?>
                                <tr>
                                    <?php
                                    if  (\App\Controllers\UserController::isAuthorized()) { ?>
                                        <td align="center">
                                            <a class="btn btn-default edit-button" data-toggle="modal" data-target="#squarespaceModal2" id="<?php echo $val['id']; ?>"><em class="fa fa-pencil"></em></a>
                                        </td>
                                    <?php } ?>
                                    <td class="hidden-xs"><div><?php echo $val['id']; ?></div></td>
                                    <td><div><?php echo $val['username']; ?></div></td>
                                    <td><div><?php echo $val['email']; ?></div></td>
                                    <td><div><?php echo $val['task']; ?></div><?php if($val['editedbyadmin']):?><span class="glyphicon glyphicon-certificate" data-toggle="tooltip" data-placement="right" title="Отредактировано администратором"></span><?php endif;?></td>
                                    <td><div><?php echo status_name($val['status']); ?></div></td>
                                </tr>
                            <?php endforeach; ?>
                        </div>
                        </tbody>
                    </table>

                </div>
                <div class="panel-footer">
                    <?php if($count>2):?>
                    <div class="row">
                        <div class="col col-xs-4">Page <span id="active-page"><?php echo $data['options']['page']; ?></span> of <?php echo ceil($count/$data['options']['perPage']); ?>
                        </div>
                        <div class="col col-xs-8">
                            <div id="page-selection"
                            <ul class="pagination hidden-xs pull-right">
                                <?php for ($i = 1; $i <= ceil($count/$data['options']['perPage']); $i++) { ?>
                                    <li class="pagination-item<?php echo $i == $data['options']['page'] ? " active" : ""; ?>" id="<?php echo $i; ?>"><a href="<?=change_params_url(['page'=>$i,'limit'=>$data['options']['perPage']])?>"><?php echo $i; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <ul class="pagination visible-xs pull-right">
                            <li><a href="#">«</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>

    </div>
</div>
</div>
<!-- line modal -->
<div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="loginModalLabel">Login</h3>
                <p>Admin: <i>username: admin, password: 123</i></p>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <form action="/user/login" method="POST">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Login</label>
                        <input name="username" type="text" required class="form-control" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="password" required type="password" class="form-control" placeholder="Password">
                    </div>
                    <br>
                    <button type="submit" id="login-button" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="squarespaceModal2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Update a new task</h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <form id="task-update-form" action="#">
                    <div class="form-group">
                        <input name="id" type="hidden" class="form-control" id="update-task-id" placeholder="id">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Task text</label>
                        <input name="task" type="text" class="form-control" id="update-task-text" placeholder="Task info">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="checkbox-update" name="status">
                            Task finished?
                        </label>
                    </div>
                    <br>
                    <button type="button" id="update-task" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- line modal -->
<div class="modal fade" id="squarespaceModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Create a new task</h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <form id="task-form" action="#">
                    <div class="form-group">
                        <label for="exampleInputPassword1">User name</label>
                        <input name="username" type="text"  required class="form-control" id="exampleInputUsername1" placeholder="User name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Task text</label>
                        <input name="task" type="text" required class="form-control" id="exampleInputTask1" placeholder="Task info">
                    </div>
                    <button type="submit" id="create-task" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
$(document).ready(function() {
    $(".glyphicon-certificate").tooltip();

    // Edit task
    $(".edit-button").click(function(e) {
        var id = $(this).attr('id');
        var formData = { id };
        $.ajax({
            cache: false,
            type: "POST",
            data: formData,
            url: "/task/show",
            success: function(result) {
                var { data } = JSON.parse(result);
                $('#update-task-id').attr('value', data.id);
                $('#update-task-text').attr('value', data.task);
                if (data.status == 1) {
                    $('#checkbox-update').attr('checked', true);
                } else {
                    $('#checkbox-update').attr('checked', false);
                }
            }})
    });

    // Create task
    $("#task-form").submit(function(e) {
        var formData = $('#task-form').serialize();
        $.ajax({
            cache: false,
            type: "POST",
            data: formData,
            url: "/task/create",
            success: function(result) {
                var data = JSON.parse(result);
                alert(data.message);
                if(data.message=='Task created')
                    window.location.href = '/';
            },
            error:function(result){
                alert(data.message);
            }
        });
        e.preventDefault(false);
    });

    // Update task
    $("#update-task").click(function(e) {
        var formData = $('#task-update-form').serialize();
        console.log(formData);
        formData.status = formData.status && formData.status === 'on' ? 1 : 0;
        $.ajax({
            cache: false,
            type: "POST",
            data: formData,
            url: "/task/update",
            success: function(result) {
                var data = JSON.parse(result);
                alert(data.message);
                if(data.code == 20000)
                {
                    window.location.href = '/';
                }


            },
            error:function(){
                alert(data.message);
            }
        })
    });
});
function statusName(status) {
    switch(status) {
        case 0:
            return "Draft";
            break;
        case 1:
            return "Completed";
            break;
        default:
            return "Draft";
    }
}
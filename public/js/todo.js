jQuery(document).ready(function($){

    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModal').modal('show');
    });

    ////----- Open the modal to UPDATE a link -----////
    jQuery('body').on('click', '.open-modal', function () {
        var todo_id = $(this).val();
        $.get('todo/' + todo_id + '/edit', function (data) {
            jQuery('#todo_id').val(data.id);
            jQuery('#title').val(data.title);
            jQuery('#description').val(data.description);
            jQuery('#btn-save').val("update");
            jQuery('#formModal').modal('show');
        })
    });

    // CREATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            title: jQuery('#title').val(),
            description: jQuery('#description').val(),
        };
        var state = jQuery('#btn-save').val();
        var type = "POST";
        var todo_id = jQuery('#todo_id').val();
        var ajaxurl = 'todo';

        $( '#title-error' ).html( "" );
        $( '#description-error' ).html( "" );

        if (state == "update") {
            type = "PUT";
            ajaxurl = 'todo/' + todo_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                if(data.errors) {
                    if(data.errors.title){
                        $( '#title-error' ).html( data.errors.title[0] );
                    }
                    if(data.errors.description){
                        $( '#description-error' ).html( data.errors.description[0] );
                    }
                }
                else{
                        var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                        todo += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>&nbsp;';
                        todo += '<button class="btn btn-danger delete-link" value="' + data.id + '">Delete</button></td></tr>';
                        if (state == "add") {
                            jQuery('#todo-list').append(todo);
                        } else {
                            jQuery("#todo" + todo_id).replaceWith(todo);
                        }
                        jQuery('#myForm').trigger("reset");
                        jQuery('#formModal').modal('hide')
                      }
            }
        });
    });
    ////----- DELETE a link and remove from the page -----////
    jQuery('.delete-link').click(function () {
        var link_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: 'todo/' + link_id,
            success: function (data) {
                console.log(data);
                $("#todo" + link_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //SEARCH

    $('#title1').on('keyup',function() {
        var query = $(this).val();
        $.ajax({

            url:"search",

            type:"GET",

            data:{'title1':query},

            success:function (data) {
                $('#title_list').html(data);
            }
        })
        // end of ajax call
    });


    $(document).on('click', 'li', function(){

        var value = $(this).text();
        $('#title1').val(value);
        $('#title_list').html("");
    });
});

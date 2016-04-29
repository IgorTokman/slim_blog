$(document).ready(function () {

    $.get('http://slim_blog.local/api/posts', function (data) {

        var output = '<ul>';
        $.each(JSON.parse(data), function (index, post) {
            output += '<li>' + post.title + '</li>'
        });

        output += '</ul>';

        $('#posts').html(output);
    });

    $.get('http://slim_blog.local/api/categories', function (data) {

        var output = '<ul>';
        $.each(JSON.parse(data), function (index, post) {
            output += '<li>' + post.name + '</li>'
        });

        output += '</ul>';

        $('#categories').html(output);
    });

    $.get('http://slim_blog.local/api/categories', function (data) {

        var output = '<ul>';
        $.each(JSON.parse(data), function (index, category) {
            output += '<li>' + category.name + '</li>'
        });

        output += '</ul>';

        $('#categories').html(output);
    });

    $.get('http://slim_blog.local/api/categories', function (data) {

        var output = '<select id="category_id">';
        $.each(JSON.parse(data), function (index, category) {
            output += '<option value="' + category.id + '">' + category.name + '</option>'
        });

        output += '</<select>';

        $('#category_list').html(output);
    });

    $('#myForm').submit(function (e) {
        e.preventDefault();

        var title = $('#title').val();
        var body = $('#body').val();
        var category_id = $('#category_id').val();

        $.post('http://slim_blog.local/api/post/add', {
            title: title,
            body: body,
            category_id: category_id
        }).done(function (data) {
            alert("Data Loaded : " + data);
        })
    });

});
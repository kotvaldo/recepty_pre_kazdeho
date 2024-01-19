// ajaxLoad.js

function loadRecipes() {
    console.log('Kód sa spúšťa');
    var page = $('#currentPage').val();
    var search = $('#myInput').val();

    $.ajax({
        url: '/video-recipes',
        method: 'GET',
        data: {page: page, search: search},
        success: function (response) {
            console.log('Kód sa spúšťa');
            console.log(response);
            $('#recipes-container .row').empty();
            // Spracovanie JSON odpovede a pridanie nových receptov na stránku
            if (response.recipes.data.length > 0) {
                $.each(response.recipes.data, function (index, recipe) {
                    console.log('Kód sa spúšťa');
                    var imagePath = '/images/' + recipe.image;
                    var html = '<div class="col-md-4 mb-4">';
                    html += '<a href="/recipes/' + recipe.id + '" class="link">';
                    html += '<div class="card">';
                    html += '<img class="card-img-top" src="' + imagePath + '" alt="Recipe Image">';
                    html += '<div class="card-body">';
                    html += '<h5 class="card-title">' + recipe.name + '</h5>';
                    html += '<i class="bi bi-file-play-fill">' + '</i>';
                    html += '<i class="bi bi-film">' + '</i>';

                    html += '<p class="card-text">' + recipe.description + '</p>';
                    html += '</div></div></a></div>';
                    $('#recipes-container .row').append(html);
                });
            } else {

            }
        },
        error: function (error) {
            console.error('Chyba pri načítavaní receptov:', error);
        }
    });
}

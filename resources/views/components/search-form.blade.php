<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form style="position: relative; left: 19%; top: 13px;" method="GET" action="{{ route('search') }}" id="searchForm">
    <input  type="text" id="searchInput" name="text" placeholder="Search...">
    <div class="search-results" id="searchResults"></div>
</form>

<script>
document.getElementById('searchInput').addEventListener('input', function(event) {
    var searchText = event.target.value;

    var modal = new XMLHttpRequest();
    modal.open('GET', '{{ route('search') }}?text=' + encodeURIComponent(searchText), true);
    modal.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    modal.onload = function() {
        if (modal.status === 200) {
            var results = JSON.parse(modal.responseText);
            var resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = '';

            if (results.length > 0) {
                var ul = document.createElement('ul');

                // Limit the number of displayed results to 5
                var displayedResults = results.slice(0, 5);

                displayedResults.forEach(function(result) {
                    var li = document.createElement('li');

                    // Create link for the user
                    var userLink = document.createElement('a');
                    userLink.href = '{{ route("user.usershow", ":id") }}'.replace(':id', result.id);
                    userLink.style.cursor = 'pointer';
                    userLink.addEventListener('click', function(e) {
                        e.preventDefault();
                        window.location.href = userLink.href;
                    });

                    // Add image if available
                    if (result.image_url) {
                        var img = document.createElement('img');
                        img.src = result.image_url;
                        img.alt = result.name;
                        img.style.width = '50px';
                        img.style.height = '50px';
                        img.style.borderRadius = '50%';
                        img.style.marginRight = '10px';
                        userLink.appendChild(img);
                    }

                    // Add user name
                    var userName = document.createElement('span');
                    userName.textContent = result.name;
                    userLink.appendChild(userName);

                    // Append link to list item
                    li.appendChild(userLink);

                    ul.appendChild(li);
                });

                // Add scrollbar if there are more than 5 users
                if (results.length > 5) {
                    resultsContainer.style.overflowY = 'auto';
                    resultsContainer.style.maxHeight = '200px'; 
                }

                resultsContainer.appendChild(ul);
            } else {
                resultsContainer.textContent = 'No results found';
            }
        }
    };

    modal.send();
});
</script>

</body>
</html>

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
                        results.forEach(function(result) {
                            var li = document.createElement('li');
                            li.textContent = result.name;
                            if (result.image_url) {
                                var img = document.createElement('img');
                                img.src = result.image_url;
                                img.alt = result.name;
                                img.style.width = '50px';
                                img.style.height = '50px';
                                img.style.borderRadius = '50%';
                                img.style.marginRight = '10px';
                                li.prepend(img);
                            }
                            ul.appendChild(li);
                        });
                        resultsContainer.appendChild(ul);
                    } else {
                        resultsContainer.textContent = 'No results found';
                    }
                }
            };

            modal.send();
        });
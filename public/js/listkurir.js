document.addEventListener('DOMContentLoaded', async () => {
    const apiKey = '185c6fa0fc2320874b416289e60209d6beb2513606ad1cb72e1839ef2392f9e4';
    const apiUrl = `https://api.binderbyte.com/v1/list_courier?api_key=${apiKey}`;

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const selectElement = document.getElementById('courier');
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.code;
                option.textContent = item.description;
                selectElement.appendChild(option);
            });
        })
        .then(data => console.log(data))
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});

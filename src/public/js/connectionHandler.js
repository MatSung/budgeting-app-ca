const apiUrl = 'api/v1/';

export default async function fetchData(target, method = 'GET') {
    const url = apiUrl + target;
    const formData = new FormData();

    //append shit here

    const response = await fetch(url, {
        method: method,
        cache: 'no-cache',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        // body: formData
    });

    const responseData = await response.json()

    return(responseData);
}
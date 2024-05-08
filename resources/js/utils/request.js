export function searchRequest(query) {

    var searchParams = new URLSearchParams(window.location.search);
    searchParams.set("q", query);

    let url = `${document.location.origin}${document.location.pathname}?${searchParams.toString()}`;

    $.ajax({
        url: url,
        beforeSend: window.Loading.showLoading,
        success: function(res) {
            let parser = new DOMParser();
            let doc = parser.parseFromString(res, 'text/html');
            $('body').html(doc.body.innerHTML)
            window.history.pushState({}, "", url);
        },
    })
}

export function filterRequest(filters) {

    var searchParams = new URLSearchParams(window.location.search);

    for (const [key, value] of Object.entries(filters)) {
        searchParams.set(`filters[${key}]`, value);
    }

    let url = `${document.location.origin}${document.location.pathname}?${searchParams.toString()}`;

    $.ajax({
        url: url,
        beforeSend: window.Loading.showLoading,
        success: function(res) {
            let parser = new DOMParser();
            let doc = parser.parseFromString(res, 'text/html');
            $('body').html(doc.body.innerHTML)
            window.history.pushState({}, "", url);
        },
    })
}
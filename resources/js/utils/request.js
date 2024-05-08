export function searchRequest(query) {

    var searchParams = new URLSearchParams(window.location.search);
    searchParams.set("q", query);
    window.location.search = searchParams.toString();

    let url = document.location

    $.ajax({
        url: url,
        beforeSend: window.Loading.showLoading,
        success: function(res) {
            let parser = new DOMParser();
            let doc = parser.parseFromString(res, 'text/html');
            $('body').html(doc.body.innerHTML);
            window.history.pushState({}, "", url);
        },
    })
}
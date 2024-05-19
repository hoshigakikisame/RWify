
export function actionRequest(url, selectorParent, selectorForm, isMultipart = false) {
    function showError(errors, e) {
        $.each(errors, (key, value) => {
            value.forEach(element => {
                $(e.currentTarget).find('#' + key).siblings(
                    '#error').fadeIn("fast", () => {
                        $(e.currentTarget).find('#' + key).siblings(
                            '#error').append(
                                `<li>${element}</li>`)
                    })

                setTimeout(() => {
                    $(e.currentTarget).find('#' + key).siblings(
                        '#error').fadeOut("slow", () => {
                            $(e.currentTarget).find('#' +
                                key).siblings('#error')
                                .empty()
                        })
                }, 5000)
            });
        })
    }

    function replacedContent(response) {
        let parser = new DOMParser();
        let doc = parser.parseFromString(response,
            'text/html');
        $('body').html(doc.body.innerHTML)
        setTimeout(function () {
            $(".flash-message").remove()
        }, 5000)
    }

    $(selectorParent).ready((e) => {
        $(selectorForm).on('submit', function (e) {
            e.preventDefault()
            if (isMultipart) {
                $.ajax({
                    url: url,
                    beforeSend: window.Loading.showLoading,
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        $.ajax({
                            url: document.location,
                            type: "GET",
                            success: function (response) {
                                replacedContent(response)
                            }
                        })
                    },
                    error: function (res) {
                        window.Loading.shutLoading()
                        showError(res.responseJSON.errors)
                    }
                })
            } else {
                $.ajax({
                    url: url,
                    beforeSend: window.Loading.showLoading,
                    type: "POST",
                    data: $(selectorForm).serialize(),
                    success: function (res) {
                        $.ajax({
                            url: document.location,
                            type: "GET",
                            success: function (response) {
                                replacedContent(response)
                            }
                        })
                    },
                    error: function (res) {
                        window.Loading.shutLoading()
                        showError(res.responseJSON.errors, e)
                    }
                })
            }
        })
    })
}


export function searchRequest(query) {

    var searchParams = new URLSearchParams(window.location.search);
    searchParams.set("q", query);

    let url = `${document.location.origin}${document.location.pathname}?${searchParams.toString()}`;

    $.ajax({
        url: url,
        beforeSend: window.Loading.showLoading,
        success: function (res) {
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
        success: function (res) {
            let parser = new DOMParser();
            let doc = parser.parseFromString(res, 'text/html');
            $('body').html(doc.body.innerHTML)
            window.history.pushState({}, "", url);
        },
    })
}
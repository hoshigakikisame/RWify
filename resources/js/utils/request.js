export function actionRequest(url, selectorParent, selectorForm, isMultipart = false) {
    function showError(errors) {
        $.each(errors, (key, value) => {
            value.forEach((element) => {
                $(selectorForm)
                    .find('#' + key)
                    .siblings('#error')
                    .fadeIn('fast', () => {
                        $(selectorForm)
                            .find('#' + key)
                            .siblings('#error')
                            .append(`<li>${element}</li>`);
                    });

                setTimeout(() => {
                    $(selectorForm)
                        .find('#' + key)
                        .siblings('#error')
                        .fadeOut('slow', () => {
                            $(selectorForm)
                                .find('#' + key)
                                .siblings('#error')
                                .empty();
                        });
                }, 2000);
            });
        });
    }

    function replacedContent(response) {
        let parser = new DOMParser();
        let doc = parser.parseFromString(response, 'text/html');
        $('body').html(doc.body.innerHTML);
        setTimeout(function () {
            $('.flash-message').remove();
        }, 5000);
    }

    function defaultRequest() {
        $.ajax({
            url: url,
            beforeSend: window.Loading.showLoading,
            type: 'POST',
            data: $(selectorForm).serialize(),
            success: function (res) {
                $.ajax({
                    url: document.location,
                    type: 'GET',
                    success: function (response) {
                        replacedContent(response);
                    },
                });
            },
            error: function (res, e) {
                window.Loading.shutLoading();
                showError(res.responseJSON.errors);
            },
        });
    }

    function multipartRequest(target) {
        $.ajax({
            url: url,
            beforeSend: window.Loading.showLoading,
            type: 'POST',
            data: new FormData(target),
            contentType: false,
            processData: false,
            success: function (res) {
                $.ajax({
                    url: document.location,
                    type: 'GET',
                    success: function (response) {
                        replacedContent(response);
                    },
                });
            },
            error: function (res, e) {
                window.Loading.shutLoading();
                showError(res.responseJSON.errors);
            },
        });
    }

    $(selectorParent).ready((e) => {
        if ($(selectorForm).find('[aria-current="submitButton"]').length == 1) {
            $(selectorForm).on('change', function (element) {
                isMultipart ? multipartRequest(this) : defaultRequest();
            });
        } else if ($(selectorForm).find('[aria-current="directSubmitButton"]').length == 1) {
            isMultipart ? multipartRequest(this) : defaultRequest();
        } else {
            $(selectorForm).on('submit', function (e) {
                e.preventDefault();
                isMultipart ? multipartRequest(this) : defaultRequest();
            });
        }
    });
}

export function searchRequest(query) {
    var searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('page')) searchParams.set('page', 1);
    searchParams.set('q', query);

    let url = `${document.location.origin}${document.location.pathname}?${searchParams.toString()}`;

    $.ajax({
        url: url,
        beforeSend: window.Loading.showLoading,
        success: function (res) {
            let parser = new DOMParser();
            let doc = parser.parseFromString(res, 'text/html');
            $('body').html(doc.body.innerHTML);
            window.history.pushState({}, '', url);
        },
    });
}

export function filterRequest(filters) {
    var searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('page')) searchParams.set('page', 1);

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
            $('body').html(doc.body.innerHTML);
            window.history.pushState({}, '', url);
        },
    });
}

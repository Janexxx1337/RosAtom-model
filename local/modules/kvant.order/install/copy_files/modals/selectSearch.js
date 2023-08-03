function callback(mutationsList, observer) {
    for (let mutation of mutationsList) {
        if (mutation.type === 'childList') {
            let customSelects = document.querySelectorAll('.custom-select');
            customSelects.forEach(customSelect => setupCustomSelect(customSelect));
            let productSelect = document.querySelector('#productSelect');
            if (productSelect) setupCustomSelect(productSelect);
        }
    }
};

let observer = new MutationObserver(callback);
observer.observe(document.body, {childList: true, subtree: true});

function setupCustomSelect(customSelect) {
    let input = customSelect.querySelector('input[type="text"]');
    let selectItems = customSelect.querySelector('.select-items');

    if (!input || !selectItems) {
        return;
    }

    if (customSelect.dataset.setupDone) {
        return;
    }
    customSelect.dataset.setupDone = 'true';

    let divs = selectItems.getElementsByTagName('div');

    input.addEventListener('keyup', function () {
        let filter = this.value.toUpperCase();
        for (let div of divs) {
            let txtValue = div.textContent || div.innerText;
            let orgID = div.dataset.id ? div.dataset.id.toUpperCase() : ''; // получаем orgID

            if (txtValue.toUpperCase().indexOf(filter) > -1 || orgID.indexOf(filter) > -1) { // добавляем поиск по orgID
                div.style.display = "block";
                // Если фильтр не пустой, подсвечиваем совпадения
                if (filter !== '') {
                    let regex = new RegExp('(' + filter + ')', 'gi');
                    div.innerHTML = txtValue.replace(regex, '<span style="background-color: yellow;">$1</span>');
                }
            } else {
                div.style.display = "none";
            }
        }
    });

    input.addEventListener('focus', function () {
        selectItems.classList.remove('select-hide');
    });

    input.addEventListener('blur', function () {
        setTimeout(function () {
            selectItems.classList.add('select-hide');
        }, 200);
    });

    for (let div of divs) {
        div.addEventListener('click', function () {
            input.value = this.textContent || this.innerText;
            let orgID = this.dataset.id;
            let hiddenInput = document.querySelector('#hidden-input[data-id]');
            if (hiddenInput) {
                hiddenInput.dataset.id = orgID;
                hiddenInput.value = orgID;
            }
            input.setAttribute('data-ID', orgID);
            selectItems.classList.add('select-hide');
        });
    }
}

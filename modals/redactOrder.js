

document.addEventListener('popupCreated_redact_btn', () => {


    const container = document.getElementById("popup-window-content-popupId");
    const id = container.dataset.id;
    console.log(id)
    const mySelect = document.getElementById("mySelect");
    console.log( mySelect.querySelector("div[data-id]"))

    BX.rest.callMethod('crm.item.get',
        {"entityTypeId": 157, "id": id},
        res => {
            console.log(res.answer.result.item)

        })
    debugger
    const timerId = setTimeout(() => {
        mySelect.querySelector("div[data-id]").click()
    }, 10)


})


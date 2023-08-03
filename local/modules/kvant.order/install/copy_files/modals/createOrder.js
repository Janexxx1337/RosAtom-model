document.addEventListener('popupCreated_add-btn', () => {
    document.getElementById("createOrder").addEventListener("click", e => {
        const regEx = /[^\d\+]/g;
        const org = document.getElementById("org"),
            kontOrg = document.getElementById("kontOrg"),
            kontOrg2 = document.getElementById("kontOrg2"),
            ord = document.getElementById("ord"),
            ship = document.getElementById("ship"),
            pay = document.getElementById("pay"),
            dateShip = document.getElementById("dateShip"),
            dateDelivery = document.getElementById("dateDelivery"),
            reg = document.getElementById("reg"),
            comment = document.getElementById("comment"),
            products = document.getElementById("products"),
            total = document.querySelector(".total").outerText.replace(regEx, '');

            const arrProd = Array.from(products.getElementsByTagName("option"));
            const arrProdId = {};

            arrProd.forEach(el => {
                if (el.dataset.chosen) {
                    arrProdId[el.dataset.id] = el.dataset.price
                    return arrProdId;
                }
            })

        BX.rest.callMethod('crm.item.add',
            {
                "entityTypeId": 157,
                "fields": {
                    "ufCrm2_organisation": org.dataset.id,
                    "ufCrm2_delivery": ship.dataset.id,
                    "ufCrm2_customers": kontOrg.dataset.id,
                    "ufCrm2_order": ord.dataset.id,
                    "ufCrm2_type_of_payment": pay.dataset.id,
                    "ufCrm2_dateofshipment": dateShip.value,
                    "ufCrm2_date_of_delivery": dateDelivery.value,
                    "ufCrm2_1690378150134": reg.dataset.id,
                    "ufCrm2_comment": comment.value,
                    "ufCrm2_totalprice": total,
                }
            },
            res => {
                const data = res.data().item;


                Object.entries(arrProdId).forEach(el => {
                    const [key, value] = el;
                    BX.rest.callMethod('crm.item.productrow.add',
                        {
                            "fields": {
                                "ownerId": data.id,
                                "ownerType":"T9d",
                                "productId": key,
                                "price": value,
                                "quantity": 1
                            }
                        })
                })




                const $tr = document.createElement("tr");
                $tr.dataset.elementId = data.id;
                $tr.style.display = 'none';
                const title = data.title;
                const $tdTitle = document.createElement("td");
                $tdTitle.textContent = title;

                const org = data.ufCrm2_organisation;
                const $tdOrg = document.createElement("td");
                $tdOrg.textContent = arrOrganization[org];

                const order = data.ufCrm2_order;
                const $tdOrder = document.createElement("td");
                $tdOrder.textContent = orderTypes[order];

                const deliveryType = data.ufCrm2_delivery;
                const $tdDeliveryType = document.createElement("td");
                $tdDeliveryType.textContent = typesShipment[deliveryType];

                const createdTime = data.createdTime;
                const $tdCreatedTime = document.createElement("td");
                $tdCreatedTime.textContent = formatDateUS(createdTime)+` ${new Date(createdTime).getHours()}:${new Date(createdTime).getMinutes()}`;

                const dateDelivery = data.ufCrm2_date_of_delivery;
                const $tdDateDelivery = document.createElement("td");
                $tdDateDelivery.textContent = formatDateUS(dateDelivery);


                const formatDate = (dateString) => {
                    const date = new Date(dateString);
                    const day = String(date.getDate()).padStart(2, '0');
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const year = date.getFullYear().toString().slice(2);
                    return `${day}.${month}.${year}`;
                };

                const ship = data.ufCrm2_dateofshipment;
                const $tdShip = document.createElement("td");
                $tdShip.textContent = formatDateUS(ship);


                const pay = data.ufCrm2_type_of_payment;
                const $tdPay = document.createElement("td");
                $tdPay.textContent = paymentTypes[pay];

                const reg = data.ufCrm2_1690378150134;
                const $tdReg= document.createElement("td");
                $tdReg.textContent = regions[reg];

                const stage = data.stageId;
                const $tdStage = document.createElement("td");
                $tdStage.innerText = arrStages[stage];

                const $tdAction = document.createElement("td");
                $tdAction.innerHTML = '                    <div style="display: flex; align-items: center;justify-content: center; gap: 10px;">\n' +
                    '                        <div class="redact_btn" id="redact_btn">\n' +
                    '                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"\n' +
                    '                                 xmlns="http://www.w3.org/2000/svg">\n' +
                    '                                <path d="M15 8.33334L11.6667 5M2.08331 17.9167L4.90362 17.6033C5.24819 17.565 5.42048 17.5459 5.58152 17.4937C5.72439 17.4475 5.86035 17.3821 5.98572 17.2995C6.12702 17.2063 6.2496 17.0837 6.49475 16.8386L17.5 5.83334C18.4205 4.91286 18.4205 3.42048 17.5 2.5C16.5795 1.57953 15.0871 1.57953 14.1667 2.5L3.16142 13.5052C2.91627 13.7504 2.79369 13.873 2.70051 14.0143C2.61784 14.1396 2.55249 14.2756 2.50624 14.4185C2.45411 14.5795 2.43497 14.7518 2.39668 15.0964L2.08331 17.9167Z"\n' +
                    '                                      stroke="#4C6EF5" stroke-width="1.3" stroke-linecap="round"\n' +
                    '                                      stroke-linejoin="round"/>\n' +
                    '                            </svg>\n' +
                    '                        </div>\n' +
                    '\n' +
                    '\n' +
                    '                        <div  class="del_btn">\n' +
                    '                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"\n' +
                    '                                 xmlns="http://www.w3.org/2000/svg">\n' +
                    '                                <path d="M15 5L5 15M5 5L15 15" stroke="#4C6EF5" stroke-width="1.3"\n' +
                    '                                      stroke-linecap="round"\n' +
                    '                                      stroke-linejoin="round"/>\n' +
                    '                            </svg>\n' +
                    '                        </div>\n' +
                    '                    </div>';

                $tr.append($tdTitle, $tdOrg, $tdOrder,$tdCreatedTime, $tdDeliveryType,$tdReg, $tdDateDelivery,$tdShip, $tdPay, $tdStage,$tdAction);
                $tr.querySelector('.redact_btn').dataset.redactbtnid = data.id;
                $tr.querySelector('.del_btn').dataset.delbtnid = data.id;
                document.getElementById('tableBody').append($tr)

                const fadeIn = (el, timeout, display) => {
                    el.style.opacity = 0;
                    el.style.display = display || 'block';
                    el.style.transition = `opacity ${timeout}ms`;
                    setTimeout(() => {
                        el.style.opacity = 1;
                    }, 10);
                };

                fadeIn($tr, 1000, 'table-row');


            });
document.getElementById("popupId").remove()

    })
})
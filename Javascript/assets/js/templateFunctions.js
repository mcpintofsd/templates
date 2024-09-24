//Check duplicate ID
function duplicateCheck(id, arr){
    let flag = true;

    for (let i = 0; i < arr.length; i++){
        if (id == arr[i].id){
            flag = false;
            break;
        }
    }

    return flag;
}

//Register Object
function registerClient(){
    if (duplicateCheck($('#idInstance').val(), client)) {
        arr1.push(new Client(
            $('#idInstance').val(),
            $('#name').val(),
            $('#address').val(),
            $('#email').val(),
            $('#phone').val(),
            $('#type').val()
        ));
        alert("Cliente", "Registado com Sucesso", "success");
        console.log(arr1);

        let outArray = JSON.stringify(arr1);
        sessionStorage.setItem('key1', arr1);

    } else {
        alert("Cliente", "Erro no Registo", "error");
    }
}

//Get Table (for)
function getTable(){
    //Destroy DataTable
    if ( $.fn.DataTable.isDataTable('#table') ) {
        $('#table').DataTable().destroy();
    }
    
    let txt = "";
    
    let filterSelect = $('#filterSelect').val();

    for (let i = 0; i < arr1[filterSelect].attr4.length; i++){
        if (filterSelect == -1){
            txt += "<tr>";
            txt += "<td>" + i + "</td>";
            txt += "<td>" + arr2[arr1[filterSelect].attr4[i]].name + "</td>";
            txt += "<td>" + arr2[arr1[filterSelect].attr4[i]].id + "</td>";
            txt += "<td>" + arr2[arr1[filterSelect].attr4[i]].email + "</td>";
            txt += "<td>" + arr2[sale[filterSelect].attr4[i]].phone + "</td>";
            txt += "<td>" + arr2[sale[filterSelect].attr4[i]].address + "</td>";
            txt += "<td>" + arr2[sale[filterSelect].attr4[i]].type + "</td>";
            txt += "<td>" + arr1[filterSelect].attr4[i] + "</td>";
            txt += "<td><button type='button' onclick='getSomeDetail(" + i + ")'></button></td>";
            txt += "</tr>";
        } else if (filterSelect == arr1[filterSelect].attr6){
            txt += "<tr>";
            txt += "<td>" + i + "</td>";
            txt += "<td>" + arr2[arr1[filterSelect].attr4[i]].name + "</td>";
            txt += "<td>" + arr2[arr1[filterSelect].attr4[i]].id + "</td>";
            txt += "<td>" + arr2[arr1[filterSelect].attr4[i]].email + "</td>";
            txt += "<td>" + arr2[sale[filterSelect].attr4[i]].phone + "</td>";
            txt += "<td>" + arr2[sale[filterSelect].attr4[i]].address + "</td>";
            txt += "<td>" + arr2[sale[filterSelect].attr4[i]].type + "</td>";
            txt += "<td>" + arr1[filterSelect].attr4[i] + "</td>";
            txt += "<td><button type='button' onclick='getSomeDetail(" + i + ")'></button></td>";
            txt += "</tr>";
        }
    }

    $('#tableBody').html(txt);

    //Reconstruct DataTable
    $('#saleWineInfoTable').DataTable();
}

//Get Table (forEach)
function getTable(){
    //Destroy DataTable
    if ( $.fn.DataTable.isDataTable('#table') ) {
        $('#table').DataTable().destroy();
    }
    
    let txt = "";
    
    let filterSelect = $('#filterSelect').val();

    arr1.forEach((element, index) => {
        if (filterSelect == -1){
            txt += "<tr>";
            txt += "<td>" + index + "</td>";
            txt += "<td>" + arr1.attr1 + "</td>";
            txt += "<td>" + arr1.attr2 + "</td>";
            txt += "<td>" + arr1.attr3 + "</td>";
            txt += "<td>" + arr1.attr4 + "</td>";
            txt += "<td>" + arr1.attr5 + "</td>";
            txt += "<td>" + arr1.attr6 + "</td>";
            txt += "<td>" + arr2[arr1.attr7].attr3 + "</td>";
            txt += "<td><button type='button' onclick='getSomeDetail(" + index + ")'></button></td>";
            txt += "</tr>";
        } else if (filterSelect == arr1.attr4){
            txt += "<tr>";
            txt += "<td>" + index + "</td>";
            txt += "<td>" + arr1.attr1 + "</td>";
            txt += "<td>" + arr1.attr2 + "</td>";
            txt += "<td>" + arr1.attr3 + "</td>";
            txt += "<td>" + arr1.attr4 + "</td>";
            txt += "<td>" + arr1.attr5 + "</td>";
            txt += "<td>" + arr1.attr6 + "</td>";
            txt += "<td>" + arr2[arr1.attr7].attr3 + "</td>";
            txt += "<td><button type='button' onclick='getSomeDetail(" + index + ")'></button></td>";
            txt += "</tr>";
        }
    });

    $('#tableBody').html(txt);

    //Reconstruct DataTable
    $('#saleWineInfoTable').DataTable();
}

//Table Utilities (for)
    //Input Checkbox
    txt += "<td><input type='checkbox' id='check" + i + "' value='" + i + "'></td>";
        
    //Input Field
    txt += "<td><input type='number' id='quant" + i + "'></td>";

    //Button
    txt += "<td><button type='button' onclick='getSomeDetail(" + i + ")'></button></td>";

//Table Utilities (forEach)
    //Input Checkbox
    txt += "<td><input type='checkbox' id='check" + index + "' value='" + index + "'></td>";
    
    //Input Field
    txt += "<td><input type='number' id='quant" + index + "'></td>";

    //Button
    txt += "<td><button type='button' onclick='getSomeDetail(" + index + ")'></button></td>";


//Register Info Based on Checknboxes
function registerBasket(){
    let tempSelection = [[], []];

    for (let i = 0; i < arr3.length; i++){
        if ($('#check' + i).is(':checked')){
            tempSelection[0].push($('#check' + i).val());
            tempSelection[1].push($('#quant' + i).val());
        }
    }

    arr2.push(new Class6(
        $('#id').val(),
        $('#name').val(),
        $('#date').val(),
        tempSelection
    ));

    console.log(arr2);
}



//Get Details Modal for Editing
function getInfo(selectedClient){
    $('#nameClientInfo').val(client[selectedClient].name);
    $('#addressClientInfo').val(client[selectedClient].address);
    $('#idClientInfo').val(client[selectedClient].id);
    $('#phoneClientInfo').val(client[selectedClient].phone);
    $('#emailClientInfo').val(client[selectedClient].email);
    $('#typeClientInfo').val(client[selectedClient].type);

    $('#selectedClientKey').html(selectedClient);
    $('#clientInfoModal').modal('show');
}

//Confirm Editing
function editClient(){
    let selectedClient = $('#selectedClientKey').html();

    client[selectedClient].name = $('#nameClientInfo').val();
    client[selectedClient].address = $('#addressClientInfo').val();
    client[selectedClient].id = $('#idClientInfo').val();
    client[selectedClient].phone = $('#phoneClientInfo').val();
    client[selectedClient].email = $('#emailClientInfo').val();
    client[selectedClient].type = $('#typeClientInfo').val();

    console.log(client);

    $('#clientSaleSelect').html(getSelect(client));
    $('#clientSelectFilter').html(getSelect(client));

    let clientList = JSON.stringify(client);
    sessionStorage.setItem('client', clientList);
}


$(function() {
    //Transfer Arrays
    let incArray1 = JSON.parse(sessionStorage.getItem('key1'));
    let incArray2 = JSON.parse(sessionStorage.getItem('key2'));
    let incArray3 = JSON.parse(sessionStorage.getItem('key3'));

    if (incArray1 != null) {
        incArray1.forEach(element => {
            let obj = Object.assign(new Class1, element);
            arr1.push(obj);
            console.log(arr1);
        });
    }

    if (incArray2 != null) {
        incArray2.forEach(element => {
            let obj = Object.assign(new Class2, element);
            arr2.push(obj);
            console.log(arr2);
        });
    }

    if (incArray3 != null) {
        incArray3.forEach(element => {
            let obj = Object.assign(new Class3, element);
            arr3.push(obj);
            console.log(arr3);
        });
    }

    //Select2
    $('#select1').select2();
    $('#select2').select2();

    //DataTable
    $('#table1').DataTable();
    $('#table2').DataTable();
});

//SweetAlert2
function alert(object, message, icon){
    Swal.fire({
        title: object,
        text: message,
        icon: icon,
        timer: 2000
    });
}

//getSelectArray
function getSelect(arr){
    let txt = "<option value='-1'>Escolha uma opção</option>";

    for (let i = 0; arr.length; i++){
        txt += "<option value='" + i +"'>" + arr[i] + "</option>";
    }

    return txt;
}

//getSelect Object
function getSelect(arr){
    let txt = "<option value='-1'>Escolha uma opção</option>";

    arr.forEach((element, index) => {
        txt += "<option value='" + index + "'>" + element.id + " - " + element.name + "</option>";
    });

    return txt;
}
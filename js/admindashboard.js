function hideAllDivs() {
    document.getElementById("addCarDiv").classList.add("hidden");
    document.getElementById("editCarDiv").classList.add("hidden");
    document.getElementById("addLocationAndBranchDiv").classList.add("hidden");
    document.getElementById("addAdminDiv").classList.add("hidden");
    document.getElementById("viewReservationsDiv").classList.add("hidden");
}



function showAddCarDiv() {
    hideAllDivs();
    document.getElementById("addCarDiv").classList.remove("hidden");
  }


function showEditCarDiv() {
    hideAllDivs();
    document.getElementById("editCarDiv").classList.remove("hidden");
}


function showaddLocationAndBranchDiv() {
    hideAllDivs();
    document.getElementById("addLocationAndBranchDiv").classList.remove("hidden");
}


function showAddAdminDiv() {
    hideAllDivs();
    document.getElementById("addAdminDiv").classList.remove("hidden");
}


function showViewReservationsDiv() {
    hideAllDivs();
    document.getElementById("viewReservationsDiv").classList.remove("hidden");
}
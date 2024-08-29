function searchTable() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("search-input02");
  filter = input.value.toLowerCase();
  table = document.getElementById("modal-table02");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) { // Skip the header row
    tr[i].style.display = "none";
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      if (td[j]) {
        txtValue = td[j].textContent || td[j].innerText;
        if (txtValue.toLowerCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        }
      }
    }
  }
}
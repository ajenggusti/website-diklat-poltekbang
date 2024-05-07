// Function untuk Entries Bar
function changeEntries() {
    var table = document.getElementById("myTable");
    var select = document.getElementById("entries");
    var selectedValue = parseInt(select.value);
    for (var i = 1; i < table.rows.length; i++) {
        if (i <= selectedValue) {
        table.rows[i].style.display = "";
        } else {
        table.rows[i].style.display = "none";
        }
    }
    }


// Script untuk search bar
function myFunction() {
  var input, filter, table, tr, th, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");
  for (i = 0; i < tr.length; i++) {
      let rowDisplayed = false;
      if (tr[i].classList.contains('header')) {
          tr[i].style.display = "";
      } else {
          td = tr[i].getElementsByTagName("td");
          for (j = 0; j < td.length; j++) {
              if (td[j]) {
                  txtValue = td[j].textContent || td[j].innerText;
                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                      rowDisplayed = true;
                      break;
                  }
              }
          }
          if (rowDisplayed) {
              tr[i].style.display = "";
          } else {
              tr[i].style.display = "none";
          }
      }
  }
}

 

// Function untuk Sort Columns
function sortTable(n, dir) {
  var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  while (switching) {
      switching = false;
      rows = table.rows;
      for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          x = rows[i].getElementsByTagName("TD")[n];
          y = rows[i + 1].getElementsByTagName("TD")[n];
          if (dir == "asc") {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  shouldSwitch = true;
                  break;
              }
          } else if (dir == "desc") {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                  shouldSwitch = true;
                  break;
              }
          }
      }
      if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount++;
      } else {
          if (switchcount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
          }
      }
  }
  var arrows = table.querySelectorAll('th i');
  arrows.forEach(arrow => arrow.style.color = 'black');
  var arrowUp = table.querySelectorAll('th i.bi-arrow-up');
  var arrowDown = table.querySelectorAll('th i.bi-arrow-down');
  arrowUp.forEach(arrow => arrow.style.color = 'black');
  arrowDown.forEach(arrow => arrow.style.color = 'black');
  if (dir == 'asc') {
      arrowUp[n].style.color = 'black';
      arrowDown[n].style.color = 'lightgrey';
  } else if (dir == 'desc') {
      arrowUp[n].style.color = 'lightgrey';
      arrowDown[n].style.color = 'black';
  }
}



// PAGINATION
document.addEventListener('DOMContentLoaded', function() {
  var table = document.getElementById("myTable");
  var rowsPerPage = 5;
  var totalRows = table.rows.length - 1;
  var numPages = Math.ceil(totalRows / rowsPerPage);
  var currentPage = 1;

  showPage(currentPage);
  updatePagination();

  function updatePagination() {
      var paginationContainer = document.querySelector('.ul-pagination');
      paginationContainer.innerHTML = '';

      var previousButton = document.createElement('li');
      previousButton.classList.add('page-item');
      previousButton.innerHTML = '<a class="page-link" href="#" tabindex="-1">Previous</a>';
      previousButton.addEventListener('click', function(event) {
          event.preventDefault();
          if (currentPage > 1) {
              currentPage--;
              showPage(currentPage);
              updatePagination();
          }
      });
      paginationContainer.appendChild(previousButton);

      // Tambah hal pertama
      var firstPageButton = document.createElement('li');
      firstPageButton.classList.add('page-item');
      firstPageButton.innerHTML = '<a class="page-link" href="#">1..</a>';
      firstPageButton.addEventListener('click', function(event) {
          event.preventDefault();
          currentPage = 1;
          showPage(currentPage);
          updatePagination();
      });
      paginationContainer.appendChild(firstPageButton);

      // Tambah hal tengah
      var middleStart = Math.max(2, currentPage - 1);
      var middleEnd = Math.min(currentPage + 1, numPages - 1);
      for (var i = middleStart; i <= middleEnd; i++) {
          var pageButton = document.createElement('li');
          pageButton.classList.add('page-item');
          if (i === currentPage) {
              pageButton.classList.add('active');
          }
          pageButton.innerHTML = '<a class="page-link" href="#">' + i + '</a>';
          pageButton.addEventListener('click', (function(page) {
              return function(event) {
                  event.preventDefault();
                  currentPage = page;
                  showPage(currentPage);
                  updatePagination();
              };
          })(i));
          paginationContainer.appendChild(pageButton);
      }

      // Tambah hal terakhir
      var lastPageButton = document.createElement('li');
      lastPageButton.classList.add('page-item');
      lastPageButton.innerHTML = '<a class="page-link" href="#">..' + numPages + '</a>';
      lastPageButton.addEventListener('click', function(event) {
          event.preventDefault();
          currentPage = numPages;
          showPage(currentPage);
          updatePagination();
      });
      paginationContainer.appendChild(lastPageButton);

      // Tambah button next
      var nextButton = document.createElement('li');
      nextButton.classList.add('page-item');
      nextButton.innerHTML = '<a class="page-link" href="#">Next</a>';
      nextButton.addEventListener('click', function(event) {
          event.preventDefault();
          if (currentPage < numPages) {
              currentPage++;
              showPage(currentPage);
              updatePagination();
          }
      });
      paginationContainer.appendChild(nextButton);
  }

  function showPage(page) {
      var startIndex = (page - 1) * rowsPerPage + 1;
      var endIndex = Math.min(startIndex + rowsPerPage - 1, totalRows);
      for (var i = 1; i <= totalRows; i++) {
          if (i >= startIndex && i <= endIndex) {
              table.rows[i].style.display = "table-row";
          } else {
              table.rows[i].style.display = "none";
          }
      }

      // Tambah header
      if (!table.querySelector("thead")) {
          var thead = document.createElement("thead");
          thead.innerHTML = `
              <tr class="header">
                  <th style="width: 90px;">No 
                      <i class="bi bi-arrow-up" onclick="sortTable(0, 'asc')"></i>
                      <i class="bi bi-arrow-down" onclick="sortTable(0, 'desc')"></i>
                  </th>
                  <th>Gambar</th>
                  <th style="width: 400px;">Gambar tampil di 
                      <i class="bi bi-arrow-up" onclick="sortTable(1, 'asc')" style="font-size: 15px;"></i>
                      <i class="bi bi-arrow-down" onclick="sortTable(1, 'desc')" style="font-size: 15px;"></i>    
                  </th>
                  <th style="width: 200px;">Action</th>
              </tr>
          `;
          table.insertBefore(thead, table.firstChild);
      }
  }
});
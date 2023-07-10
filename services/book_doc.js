function bookdoc(x){
  clickedIndex = x.rowIndex;
  var table = document.getElementById('targetTable');

  // giving the id of doctor input area to default value insertion of that row
  document.getElementById('docname').value = table.rows[clickedIndex].cells[0].innerHTML;
  document.getElementById('departmentname').value = table.rows[clickedIndex].cells[2].innerHTML;

  /* getting the name of the doctor, row index from above, cells[0] because name is the first cell in every row
  console.log(table.rows[clickedIndex].cells[0].innerHTML);
  console.log("Index: "+clickedIndex);*/
}

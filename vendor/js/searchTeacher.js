let dataTeacher = document.getElementById("dataTeacher");
dataTeacher.style.display = "none";
function searchTeacher() {
  let inputName = document.getElementById("inputName").value;
  let selectResult = document.getElementById("result");

  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../../vendor/php/searchTeacher.php?nombre=" + inputName, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      while (selectResult.firstChild) {
        selectResult.removeChild(selectResult.firstChild);
      }

      let data = JSON.parse(xhr.responseText);
      let option = document.createElement("option");
      option.value = null;
      option.text = "Selecciona";
      selectResult.appendChild(option);
      data.forEach(function (Teacher) {
        let option = document.createElement("option");
        option.value = Teacher.U_id;
        option.text = Teacher.U_name;
        selectResult.appendChild(option);
      });

      if (data.length > 0) {
        selectResult.style.display = "block";
      } else {
        selectResult.style.display = "none";
      }
    }
  };

  xhr.send();
}

function selectionTeacher() {
  let inputName = document.getElementById("inputName");
  let selectResult = document.getElementById("result");
  let selectedOption = selectResult.options[selectResult.selectedIndex];

  inputName.value = selectedOption.value;

  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../../vendor/php/searchT.php?idT=" + inputName.value, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let enrollment;
      let data = JSON.parse(xhr.responseText);
      data.forEach(function (Teacher) {
        document.getElementById("nameT").innerHTML = Teacher.U_name;
        document.getElementById("mailT").innerHTML = Teacher.U_mail;
        document.getElementById("phoneT").innerHTML = Teacher.U_phone;
        document.getElementById("enrollmentT").innerHTML = Teacher.U_enrollment;
        enrollment = Teacher.U_enrollment;
      });
      groupsTeacher(enrollment);
    }
  };

  xhr.send();

  dataTeacher.hidden = "block";
}

function clearSelection() {
  let inputName = document.getElementById("inputName");
  let selectResult = document.getElementById("result");

  selectResult.selectedIndex = -1;
  inputName.value = "";
}

function groupsTeacher(enrollment) {
  let listGroup = document.getElementById("listGroup");
  listGroup.innerHTML = '';
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "../../vendor/php/searchGroupsT.php?enrollment=" + enrollment, true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let data = JSON.parse(xhr.responseText);
      data.forEach(function (Teacher) {
        let item = document.createElement("p");
        item.classList.add("lead");
        item.classList.add("ps-lg-2");
        item.innerHTML = Teacher.gT_group;
        listGroup.appendChild(item);
      });

    }
  };

  xhr.send();
}
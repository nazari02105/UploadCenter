function upload() {
  let myArray = [];
  myArray.push("#sortpicture");
  myArray.push("#sortpicture2");
  myArray.push("#sortpicture3");
  for (let i = 0; i < myArray.length; i++) {
    var file_data = $(myArray[i]).prop("files")[0];
    if (file_data != null) {
      var form_data = new FormData();
      form_data.append("file", file_data);
      $.ajax({
        url: "upload.php",
        dataType: "text",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "post"
      });
    }
    else{
      if (myArray[i] == "#sortpicture" && document.getElementById("sortpicture").style.display != "none") alert("first input is empty");
      if (myArray[i] == "#sortpicture2" && document.getElementById("div2").style.display != "none") alert("second input is empty");
      if (myArray[i] == "#sortpicture3" && document.getElementById("div3").style.display != "none") alert("third input is empty");
    }
  }
}

function addInput() {
  let x2 = document.getElementById("div2").style.display;
  let x3 = document.getElementById("div3").style.display;

  if (x2 == "none") {
    document.getElementById("div2").style.display = "block";
  } else {
    if (x3 == "none") {
      document.getElementById("div3").style.display = "block";
    } else {
      alert("You can not upload more than 3 files at the same time.");
    }
  }
}

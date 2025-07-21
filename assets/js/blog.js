const tagInput = document.getElementById("tagInput");
const tagsInput = document.getElementById("tagsInput");
const tagsHidden = document.getElementById("tagsHidden");

let tags = [];

tagInput.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    e.preventDefault();
    const tag = tagInput.value.trim();
    if (tag !== "" && !tags.includes(tag)) {
      tags.push(tag);
      updateTags();
      tagInput.value = "";
    }
  }
});

function updateTags() {
  tagsInput.innerHTML = "";
  tags.forEach((t) => {
    const span = document.createElement("span");
    span.className = "tag";
    span.innerHTML = `
                <span class="tag-text">${t}</span>
                <span class="tag-remove" onclick="removeTag('${t}')">×</span>
            `;
    tagsInput.appendChild(span);
  });

  tagsInput.appendChild(tagInput);
  tagsHidden.value = tags.join(",");
}

function removeTag(tag) {
  tags = tags.filter((t) => t !== tag);
  updateTags();
}

$(document).ready(function () {
  // $("#description").summernote({
  //   placeholder: "Write something here...",
  //   height: 300,
  //   toolbar: [
  //     ["style", ["style"]],
  //     ["font", ["bold", "italic", "underline", "clear"]],
  //     ["fontname", ["fontname"]],
  //     ["fontsize", ["fontsize"]],
  //     ["color", ["color"]],
  //     ["para", ["ul", "ol", "paragraph"]],
  //     ["height", ["height"]],
  //     ["insert", ["link", "picture", "video", "table"]],
  //     ["view", ["fullscreen", "codeview", "help"]],
  //   ],
  //   fontNames: [
  //     "Arial",
  //     "Arial Black",
  //     "Comic Sans MS",
  //     "Courier New",
  //     "Georgia",
  //     "Impact",
  //     "Lucida Sans",
  //     "Tahoma",
  //     "Times New Roman",
  //     "Verdana",
  //   ],
  // });

  $(".statusToggle").on("click", function () {
    var id = $(this).data("id");
    Swal.fire({
      title: "Are you sure?",
      text: "Do you really want to change the status?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, change it!",
      cancelButtonText: "No, cancel",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        // User confirmed — send AJAX
        $.ajax({
          url: "code/save_blog.php",
          type: "POST",
          data: {
            id: id,
            flag: "changeStatus",
          },
          success: function (response) {
            if (response.status == "success") {
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              });
              Toast.fire({
                icon: "success",
                title: response.message,
              });
              setTimeout(() => {
                location.reload();
              }, 3000);
            } else {
              Swal.fire({
                icon: "error",
                title: "Error!",
                text: response.message,
                confirmButtonText: "OK",
              });
            }
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: "Cancelled",
          text: "No changes were made.",
          icon: "info",
          timer: 2000,
          showConfirmButton: false,
        });
      }
    });
  });

  $(".deleteStatus").on("click", function () {
    var id = $(this).data("id");
    console.log(id);
    Swal.fire({
      title: "Are you sure?",
      text: "Do you really want to delete the blog?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, change it!",
      cancelButtonText: "No, cancel",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        // User confirmed — send AJAX
        $.ajax({
          url: "code/save_blog.php",
          type: "POST",
          data: {
            id: id,
            flag: "deleteBlog",
          },
          success: function (response) {
            if (response.status == "success") {
              const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
              });
              Toast.fire({
                icon: "success",
                title: response.message,
              });
              setTimeout(() => {
                location.reload();
              }, 3000);
            } else {
              Swal.fire({
                icon: "error",
                title: "Error!",
                text: response.message,
                confirmButtonText: "OK",
              });
            }
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: "Cancelled",
          text: "No changes were made.",
          icon: "info",
          timer: 2000,
          showConfirmButton: false,
        });
      }
    });
  });
});

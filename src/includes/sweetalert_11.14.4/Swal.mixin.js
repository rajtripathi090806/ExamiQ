
let swalWidth;
const screenIsLarge = window.innerWidth <= 768;
if (screenIsLarge) { swalWidth = "100%"; }



const errorSwal = Swal.mixin({
    toast: true,
    position: "top-end",
    width: swalWidth,
    icon: "error",
    color: "#f00",
    showConfirmButton: false,
    showCloseButton: true,
    timerProgressBar: true,
    timer: 6000,
    customClass: {
        timerProgressBar: "bg-danger",
        closeButton: "bg-danger text-white"
    },
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

const successSwal = Swal.mixin({
    toast: true,
    position: "top-end",
    width: swalWidth,
    icon: "success",
    color: "#198754",
    showConfirmButton: false,
    showCloseButton: true,
    timer: 6000,
    timerProgressBar: true,
    customClass: {
        timerProgressBar: "bg-success",
        closeButton: "bg-success text-white"
    },
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

const questionSwal = Swal.mixin({
    toast: true,
    width: swalWidth,
    didOpen: () => {
        document.querySelector("#overlay").style.visibility = "visible";
        document.querySelector("#overlay").style.opacity = "1";
    },
    willClose: () => {
        document.querySelector("#overlay").style.visibility = "hidden";
        document.querySelector("#overlay").style.opacity = "0";
    }
});

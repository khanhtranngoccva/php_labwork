async function insert_students(form) {
    const formData = new FormData(form);
    const requestBody = {
        name: formData.get("name"),
        class: formData.get("class"),
        mark: +formData.get("mark") || 0,
        sex: formData.get("sex"),
    }
    try {
        const res = await fetch("/exercise8/create.php", {
            method: "POST",
            body: JSON.stringify(requestBody),
            headers: {
                "Content-Type": "application/json",
            }
        });
        return res.ok;
    } catch (e) {
        return false;
    }
}

async function get_students() {
    const json = await (await fetch("/exercise8/get.php")).json();
    return json.data;
}

function create_table_cell(data) {
    const element = document.createElement("td");
    element.innerText = data;
    return element;
}

async function refresh_students_list() {
    const students = await get_students();
    const student_table_body = document.querySelector("#students_list");
    student_table_body.innerHTML = "";
    for (let student of students) {
        const row = document.createElement("tr");
        row.append(create_table_cell(student.id));
        row.append(create_table_cell(student.name));
        row.append(create_table_cell(student.class));
        row.append(create_table_cell(student.mark));
        row.append(create_table_cell(student.sex));
        student_table_body.append(row);
    }
}

window.addEventListener("load", function () {
    refresh_students_list();
})
document.querySelector("#insert_student_form").addEventListener("submit", async function (e) {
    e.preventDefault();
    const result = await insert_students(e.currentTarget);
    if (result) {
        document.querySelector("#insert_student_toast").innerText = "Success!";
    } else {
        document.querySelector("#insert_student_toast").innerText = "Failed!";
    }
    refresh_students_list();
});

document.querySelector("#reassign_class").addEventListener("click", async function (e ) {
    e.preventDefault();
    await fetch("/exercise8/automatic_reassign.php", {
        method: "POST",
    })
    refresh_students_list();
})
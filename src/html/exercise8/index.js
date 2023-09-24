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

async function get_student_buckets() {
    const json = await (await fetch("/exercise8/get_buckets.php")).json();
    return json.data;
}

function create_table_cell(data) {
    const element = document.createElement("td");
    element.innerText = data;
    return element;
}

function insert_table(table_body, students) {
    table_body.innerHTML = "";
    for (let student of students) {
        const row = document.createElement("tr");
        row.append(create_table_cell(student.id));
        row.append(create_table_cell(student.name));
        row.append(create_table_cell(student.class));
        row.append(create_table_cell(student.mark));
        row.append(create_table_cell(student.sex));
        table_body.append(row);
    }
}

async function refresh_students_list() {
    const students = await get_students();
    const students_buckets = await get_student_buckets();
    console.log(students_buckets)
    const table_body = document.querySelector("#students_list");
    insert_table(table_body, students);

    const group1 = document.querySelector("#group1");
    const group2 = document.querySelector("#group2");
    const group3 = document.querySelector("#group3");
    insert_table(group1, students_buckets[2]);
    insert_table(group2, students_buckets[1]);
    insert_table(group3, students_buckets[0]);
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
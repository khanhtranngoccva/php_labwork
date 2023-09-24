<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/exercise8/styles.css">
    <title>Document</title>
</head>
<body>
<form action="/exercise8/create.php" method="POST" class="form" id="insert_student_form">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>
    <label for="class">Class</label>
    <input type="text" id="class" name="class" required>
    <label for="mark">Mark</label>
    <input type="number" id="mark" name="mark" required>
    <label for="sex">Gender</label>
    <select id="sex" name="sex" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Non-binary/Genderfluid/Other</option>
    </select>
    <div></div>
    <div>
        <button>Add student</button>
        <button type="button" id="reassign_class">Reassign student</button>
    </div>
</form>
<p id="insert_student_toast"></p>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Mark</th>
            <th>Sex/Gender</th>
        </tr>
    </thead>
    <tbody id="students_list">
    </tbody>
</table>
<h2>Best Students</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Class</th>
        <th>Mark</th>
        <th>Sex/Gender</th>
    </tr>
    </thead>
    <tbody id="group1">
    </tbody>
</table>
<h2>Good Students</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Class</th>
        <th>Mark</th>
        <th>Sex/Gender</th>
    </tr>
    </thead>
    <tbody id="group2">
    </tbody>
</table>
<h2>Average Students</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Class</th>
        <th>Mark</th>
        <th>Sex/Gender</th>
    </tr>
    </thead>
    <tbody id="group3">
    </tbody>
</table>
</body>
<script src="/exercise8/index.js"></script>
</html>
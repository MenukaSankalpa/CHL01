let users = [];
const tableBody = document.querySelector('#usersTable tbody');
const userModal = document.getElementById('userModal');
const createUserBtn = document.getElementById('createUserBtn');
const closeModal = document.getElementById('closeModal');
const cancelBtn = document.getElementById('cancelBtn');
const userForm = document.getElementById('userForm');
const successMsg = document.getElementById('successMsg');

createUserBtn.addEventListener('click', () => userModal.style.display = 'flex');
closeModal.addEventListener('click', () => userModal.style.display = 'none');
cancelBtn.addEventListener('click', () => userModal.style.display = 'none');

userForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    if(password !== confirmPassword){ alert('Passwords do not match'); return; }

    const user = {id: users.length + 1, username, email, password};
    users.push(user);
    addUserRow(user);

    userForm.reset();
    userModal.style.display = 'none';
    successMsg.style.display = 'block';
    setTimeout(() => successMsg.style.display='none', 2000);
});

function addUserRow(user){
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td>${user.id}</td>
        <td>${user.username}</td>
        <td>${user.email}</td>
        <td>${user.password}</td>
        <td>
            <button class="btn btn-sm btn-info editBtn"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-danger deleteBtn"><i class="fas fa-trash-alt"></i></button>
        </td>`;
    tableBody.appendChild(tr);

    tr.querySelector('.deleteBtn').addEventListener('click', () => {
        tr.remove();
        users = users.filter(u => u.id !== user.id);
    });
}

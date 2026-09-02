// admin-script.js

document.addEventListener('DOMContentLoaded', function() {
    const addAccountForm = document.getElementById('addAccountForm');
    const accountsTableBody = document.getElementById('accountsTable').getElementsByTagName('tbody')[0];

    // --- Helper Functions ---

    async function fetchData(url, method = 'GET', body = null) {
        try {
            const options = {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                },
            };
            if (body) {
                options.body = JSON.stringify(body);
            }
            const response = await fetch(url, options);
            if (!response.ok) {
                const errorMessage = await response.text();
                throw new Error(`HTTP error! status: ${response.status}, message: ${errorMessage}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Fetch error:', error);
            alert('An error occurred: ' + error.message);
            throw error; // Re-throw the error for the calling function to handle further if needed
        }
    }

    function displayAccounts(accounts) {
        accountsTableBody.innerHTML = ''; // Clear existing rows

        accounts.forEach(account => {
            const row = accountsTableBody.insertRow();
            const idCell = row.insertCell();
            const usernameCell = row.insertCell();
            const emailCell = row.insertCell();
            const actionsCell = row.insertCell();
            actionsCell.classList.add('action-buttons');

            idCell.textContent = account.id;
            usernameCell.textContent = account.username;
            emailCell.textContent = account.email;

            const editButton = document.createElement('button');
            editButton.className = 'btn btn-primary btn-sm';
            editButton.textContent = 'Edit';
            editButton.addEventListener('click', () => handleEdit(account)); // Handle edit

            const deleteButton = document.createElement('button');
            deleteButton.className = 'btn btn-danger btn-sm';
            deleteButton.textContent = 'Delete';
            deleteButton.addEventListener('click', () => handleDelete(account)); // Handle delete

            actionsCell.appendChild(editButton);
            actionsCell.appendChild(deleteButton);
        });
    }

    async function loadAccounts() {
        try {
            const accounts = await fetchData('admin_actions.php?action=list');
            displayAccounts(accounts);
        } catch (error) {
            console.error('Error loading accounts:', error);
            alert('Failed to load accounts.');
        }
    }

    // --- Account Management Functions ---

    addAccountForm.addEventListener('submit', async function(event) {
        event.preventDefault();
        const username = document.getElementById('addUsername').value;
        const email = document.getElementById('addEmail').value;
        const password = document.getElementById('addPassword').value;

        try {
            const response = await fetchData('admin_actions.php?action=add', 'POST', { username, email, password });
            alert(response.message);
            if (response.success) {
                addAccountForm.reset();
                await loadAccounts(); // Reload the account list
            }
        } catch (error) {
            console.error('Error adding account:', error);
            alert('Failed to add account.');
        }
    });

    // --- Handle Edit and Delete from Table Buttons ---

    function handleEdit(account) {
    const newUsername = prompt("Enter new username (leave blank to keep current):", account.username);
    const newEmail = prompt("Enter new email (leave blank to keep current):", account.email);

    if (newUsername !== null || newEmail !== null) {
        const updateData = {};
        if (newUsername !== null && newUsername !== account.username) {
            updateData.username = newUsername;
        }
        if (newEmail !== null && newEmail !== account.email) {
            updateData.email = newEmail;
        }

        if (Object.keys(updateData).length > 0) {
            updateAccount(account.id, updateData); // Pass the account.id here
        }
    }
}

async function updateAccount(id, updateData) {
    try {
        const response = await fetchData('admin_actions.php?action=update_inline', 'POST', { id: id, ...updateData });
        alert(response.message);
        if (response.success) {
            await loadAccounts(); // Reload the account list
        }
    } catch (error) {
        console.error('Error updating account:', error);
        alert('Failed to update account.');
    }
}

    async function handleDelete(account) {
        if (!confirm(`Are you sure you want to delete the account with username: "${account.username}" and email: "${account.email}"?`)) {
            return;
        }

        try {
            const response = await fetchData('admin_actions.php?action=delete', 'POST', { find: { username: account.username, email: account.email } });
            alert(response.message);
            if (response.success) {
                await loadAccounts(); // Reload the account list
            }
        } catch (error) {
            console.error('Error deleting account:', error);
            alert('Failed to delete account.');
        }
    }

    // --- Initial Load ---
    loadAccounts();
});
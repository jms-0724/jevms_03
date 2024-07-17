document.addEventListener("DOMContentLoaded",()=> {
    countUsers();
    countJournal();
    countTitle();
    currentJournal()
})

function countUsers(){
    const userCount = document.getElementById("totalUsers");

    let data = {
        dd:1
    }
    fetch('dashboard/totalUser.php', {
        method:'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body:JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); 
    })
    .then(records=> {
        
        userCount.innerHTML = records;
    })

    .catch(err=> {
        console.log(err);
    })
    
}

function countJournal(){
    const journalCount = document.getElementById("totalJournal");

    let data = {
        dd:1
    }
    fetch('dashboard/totalJournal.php', {
        method:'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body:JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); 
    })
    .then(records=> {
        journalCount.innerHTML = records;
    })

    .catch(err=> {
        console.log(err);
    })
    
}

function countTitle(){
    const titleCount = document.getElementById("totalAccounts");

    let data = {
        dd:1
    }
    fetch('dashboard/totalAccounts.php', {
        method:'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body:JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); 
    })
    .then(records=> {
        titleCount.innerHTML = records;
    })

    .catch(err=> {
        console.log(err);
    })
    
}
function currentJournal(){
    const currentJournal = document.getElementById("currentJournal");

    let data = {
        dd:1
    }
    fetch('dashboard/currentJournal.php', {
        method:'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body:JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); 
    })
    .then(records=> {
        currentJournal.innerHTML = records;
    })

    .catch(err=> {
        console.log(err);
    })
}
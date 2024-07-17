document.addEventListener("DOMContentLoaded",()=>{
    document.getElementById('logout').addEventListener('click', function() {
        fetch('./system/logout.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'logout=1'
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          console.log('You Clicked Me');
          window.location.href = './../index.php';
        })
        .catch(error => {
          console.error('There was a problem with the fetch operation:', error);
        });
      });
})
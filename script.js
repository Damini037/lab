document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    
    // Retrieve username and password
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    
    // Check if username and password are valid (this is a basic example)
    if (username === 'admin' && password === 'password') {
      alert('Login successful!');
      window.location.href='submit_request.html';
      // Redirect to dashboard or another page
      // window.location.href = 'dashboard.html';
    } else {
      alert('Invalid username or password. Please try again.');
    }
  });
  
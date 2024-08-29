const loginBtn = document.getElementById('loginBtn');
const signUpBtn = document.getElementById('signUpBtn');

loginBtn.addEventListener('click', () => {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // You can add your login logic here
    console.log('Email:', email);
    console.log('Password:', password);
});

signUpBtn.addEventListener('click', () => {
    // You can add your sign-up logic here
    console.log('Sign up button clicked');
});
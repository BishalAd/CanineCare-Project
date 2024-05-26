document.getElementById('register').addEventListener('click', () => {
    document.getElementById('container').classList.add('active');
});

document.getElementById('login').addEventListener('click', () => {
    document.getElementById('container').classList.remove('active');
});

document.querySelectorAll('.close-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('container').classList.remove('active');
    });
});

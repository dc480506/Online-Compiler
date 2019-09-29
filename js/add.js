document.querySelector('#add-button').addEventListener('click',
    function() {
        document.querySelector('.create-box').style.display = 'flex';
        document.querySelector('.bg').style.opacity = '0.4';
    });
document.querySelector('.fa-window-close').addEventListener('click',
    function() {
        document.querySelector('.create-box').style.display = 'none';
        document.querySelector('.bg').style.opacity = '1';
    });
document.querySelector('.r-btn').addEventListener('click',
    function() {
        document.querySelector('.rename-box').style.display = 'flex';
        document.querySelector('.bg').style.opacity = '0.4';
    });
document.querySelector('.re').addEventListener('click',
    function() {
        document.querySelector('.rename-box').style.display = 'none';
        document.querySelector('.bg').style.opacity = '1';
    });
<div id="menu" class="sidemenu">
    <div class="top">
        <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>
        <a href="../store/store.php" target="_blank" onclick="closeMenu()">Store</a>
        <a href="#iphone" onclick="closeMenu()">iPhone</a>
        <a href="#samsung" onclick="closeMenu()">Samsung</a>
        <a href="#redmi" onclick="closeMenu()">Redmi</a>
        <a href="#wihp" onclick="closeMenu()">Wired HeadPhone</a>
        <a href="#wrhp" onclick="closeMenu()">Wireless HeadPhone</a>
        <a href="#air" onclick="closeMenu()">Airpods</a>
        <a href="#News-letter" onclick="closeMenu()">Subscribition</a>
        <a href="#footer" onclick="closeMenu()">More</a>
    </div>
</div>

<div class="navbar">
    <div class="navbar-logo">
        <a href="#">NextGen</a>
    </div>
    <div id="navbar-links" class="navbar-links">
        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
            </svg></a>
        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
            </svg></a>
        <a href="#####" onclick="openMenu()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg></a>
    </div>
</div>
<style>
    
    .sidemenu {
        height: 100%;
        width: 0;
        position: fixed;
        top: 0;
        left: 0;
        overflow: hidden;
        background-color: #1abc9c;
        transition: 0.5s;
        padding-top: 60px;
        z-index: 999 !important; 
        border-radius: 0 10px 10px 0;
    }

    .top {
        padding-top: 20px;
    }

    .sidemenu a {
        text-decoration: none;
        font-size: 18px;
        color: black;
        display: block;
        transition: 0.3s;
        padding: 15px 0px;
        text-align: center;
    }

    .sidemenu .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    .sidemenu a:hover {
        color: #f1f1f1;
    }

    #main {
        transition: margin-left .5s;
        padding: 16px;
    }

    .navbar {
        position: fixed;
        width: 100%;
        padding: 40px 60px;
        top: 0px;
        display: flex;
        z-index: 22;
        justify-content: space-between;
    }

    .navbar-logo a {
        text-decoration: none;
        color: #1abc9c;
    }

    .navbar-links a {
        padding: 0 0 0 20px;
        color: #1abc9c;
        transition: all ease .7s;
    }

    .navbar-links a:hover {
        color: grey !important;
        transition: all ease .7s;
    }

    svg {
        width: 20px;
        height: fit-content;
    }
</style>
<script>
    function openMenu() {
        document.getElementById("menu").style.width = "40%";
        document.getElementById("main").style.marginLeft = "250px";
        document.addEventListener('click', handleClickOutside);
    }

    function closeMenu() {
        document.getElementById("menu").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.removeEventListener('click', handleClickOutside);
    }

    function handleClickOutside(event) {
        const menu = document.getElementById('menu');
        if (!menu.contains(event.target) && !document.getElementById('navbar-links').contains(event.target)) {
            closeMenu();
        }
    }
</script>
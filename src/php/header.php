
<?php

function injectHeader($tabs, $activeTabIndex) {

    $navTabs = "";
    $currTabIndex = 0;

    foreach ($tabs as $tabName => $tabLink) {
        $activeClass = $currTabIndex == $activeTabIndex ? "active" : "";
        $navTabs .= "<li class='nav-item'><a class='nav-link mx-2 $activeClass' href='$tabLink'>$tabName</a></li>";
        $currTabIndex++;
    }

    echo "
        <nav class='navbar navbar-expand-sm p-3' style='background-color: #1a1a1a;'>
            <div class='container-fluid'>

                <a class='navbar-brand' href='' tabindex='-1'>
                    <img src='../src/images/logo.png' alt='logo' height='25' width='90' />
                </a>
                
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbar'>
                    <span class='navbar-toggler-icon'></span>
                </button>

                <div class='collapse navbar-collapse' id='navbar'>
                    <ul class='navbar-nav ms-auto'>
                        $navTabs
                    </ul>
                </div>

            </div>
        </nav>
    ";
}

?>


<?php

function displayAchievementCard($cardTitle, $cardThemeColor, $icon, $entriesCount) {
    echo "
        <div class='col-12 col-sm-6 col-lg-4 col-xl-3'>
            <div class='card rounded-4' style='--card-theme-color: $cardThemeColor'>
                <div class='card-body'>
                    <h6 class='card-title p-3'>
                        <i class='bi bi-$icon'></i>{$cardTitle}s
                        <span class='entries-count'>$entriesCount</span>
                    </h6>
                    <div class='p-4'>
                        <button type='button' class='btn btn-primary w-100' data-bs-toggle='modal' data-bs-target='#" . strtok($cardTitle, " ") . "Modal" . "'>
                            <i class='bi bi-plus-circle-dotted'></i>Add New
                        </button>
                    </div>
                    <div class='p-4'>
                        <button type='button' class='btn btn-primary w-100'>
                            <i class='bi bi-view-stacked'></i>View All
                        </button>
                    </div>
                </div>
            </div>
        </div>
    ";
}



function displaySkillCard() {
    // code
}

?>

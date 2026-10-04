
<?php

function createAchievementModal($category) {

    echo "
        <div class='modal fade' id='" . strtok($category, " ") . "Modal" . "'>
            <div class='modal-dialog modal-dialog-centered modal-dialog-scrollable'>
                <div class='modal-content px-5 py-3'>

                    <div class='modal-header px-0'>
                        <h5 class='modal-title'>Add New $category</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                    </div>

                    <form action='../src/capabilities/student/add-achievement.php' method='post' enctype='multipart/form-data'>

                        <input type='hidden' name='stuId' value='1' />
                        <input type='hidden' name='category' value='$category' />

                        <div class='modal-body px-0'>
                            <div class='mb-3 mt-2'>
                                <label for='{$category}Name' class='form-label'>$category Name</label>
                                <input type='text' class='form-control' id='{$category}Name' name='name' required />
                            </div>
                            <div class='mb-3'>
                                <label for='{$category}Desc' class='form-label'>Description</label>
                                <textarea class='form-control' rows='3' id='{$category}Desc' name='description' required></textarea>
                            </div>
                            <div class='input-group mb-3 mt-4'>
                                <label for='{$category}Doc' class='input-group-text'>Document</label>
                                <input type='file' class='form-control' id='{$category}Doc' name='document' required />
                            </div>
                            <div class='input-group mb-3 mt-4'>
                                <label for='{$category}Sem' class='input-group-text'>Semester</label>
                                <select class='form-control' id='{$category}Sem' name='semester' required>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                </select>
                            </div>
                            <div class='input-group mb-3 mt-4'>
                                <label for='{$category}Workshop' class='input-group-text'>Capable For Workshop?</label>
                                <select class='form-control' id='{$category}Workshop' name='capableForWorkshop' required>
                                    <option value='yes'>Yes</option>
                                    <option value='no'>No</option>
                                </select>
                            </div>
                        </div>

                        <div class='modal-footer justify px-0'>
                            <button type='submit' class='btn btn-success w-100 mt-3'>Add $category</button>
                        </div>
                    
                    </form>

                </div>
            </div>
        </div>
    ";
}



function createSkillModal($category) {
    // code
}

?>

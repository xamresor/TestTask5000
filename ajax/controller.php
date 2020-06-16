<?php
require('../initialize.php');

switch ($_POST['method']) {
    case 'getApplicationsDataList':
        $list = Application::getApplicationDataList();
        die(json_encode($list));

    case 'makeOffer':
        $id = validateId($_POST['application_id'] ?? null);
        $result = Application::makeOffer($id);
        if ($result) {
            die(json_encode(['success' => 1]));
        }
        die('Offer grant error');
}

function validateId($id) : string {
    if (empty($id)) {
        die('empty id');
    } elseif ($id <= 0) {
        die('id is not positive');
    }
    return $id;
}



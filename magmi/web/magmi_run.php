<?php

$params = $_REQUEST;
require_once("security.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log.txt'); // Log errors to a file

require_once("../inc/magmi_defs.php");
require_once("../inc/magmi_statemanager.php");

try {
    $engdef = explode(":", $params["engine"]);
    $engine_name = $engdef[0];
    $engine_class = $engdef[1];
    require_once("../engines/$engine_name.php");
} catch (Exception $e) {
    die("ERROR");
}

if (Magmi_StateManager::getState() !== "running") {
    Magmi_StateManager::setState("idle");
    $pf = Magmi_StateManager::getProgressFile(true);
    if (file_exists($pf)) {
        @unlink($pf);
    }
    set_time_limit(0);
    $mmi_imp = new $engine_class();
    $logfile = isset($params["logfile"]) ? $params["logfile"] : null;
    if (isset($logfile) && $logfile != "") {
        $fname = Magmi_StateManager::getStateDir() . DIRSEP . $logfile;
        if (file_exists($fname)) {
            @unlink($fname);
        }
        $mmi_imp->setLogger(new FileLogger($fname));
    } else {
        $mmi_imp->setLogger(new EchoLogger());
    }

    $mmi_imp->run($params);
} else {
    die("RUNNING");
}

<?php
define('USERNAME', 'ankitagarwal');
define('REPO', 'moodle');
require_once 'lib/Github/Autoloader.php';
Github_Autoloader::register();
$github = new Github_Client();
$user = $github->getUserApi()->show('ornicar');
$repo = $github->getRepoApi()->show(USERNAME, REPO);
$branches =  $github->getRepoApi()->getRepoBranches(USERNAME, REPO);
//var_dump($user, $repo, $branches);
echo "<table border = 1 wdith = 100%><tr><td>SL No</td><td>Checkbox</td><td>Branch Name</td><td colspan=3>Last commit details</td></tr>";
$i = 0;
foreach($branches as $branch) {
    $i++;
    $mdl = preg_match('<MDL-([0-9]+)?>i', $branch['name'], $res);
    //var_dump($mdl,$res);
    if(!empty($mdl)) {
        $tracker = "<td><a href =http://tracker.moodle.org/browse/".$res[0].">Tracker URL </a></td>";
    }
    else {
        $tracker ="<td></td>";
    }
    echo "<tr><td>$i</td><td><input type=checkbox /></td><td>".$branch['name']."</td><td>".$branch['commit']['sha']."</td><td><a href = ".$branch['commit']['url']."> Last commit URL </a></td>$tracker</tr>";
}
echo "</table>";
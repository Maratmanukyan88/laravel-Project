<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\DripPrograms;
use App\Http\Controllers\Controller;

class DripProgramController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Users Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function getDrip() {
        return view('drips/drip');
    }

    public function php_file_tree($directory, $return_link, $extensions = array()) {
        // Generates a valid XHTML list of all directories, sub-directories, and files in $directory
        // Remove trailing slash
        $code = '';
        if (substr($directory, -1) == "/")
            $directory = substr($directory, 0, strlen($directory) - 1);
        $code .= $this->php_file_tree_dir($directory, $return_link, $extensions);
        return $code;
    }

    public function php_file_tree_dir($directory, $return_link, $extensions = array(), $first_call = true) {
        // Recursive function called by php_file_tree() to list directories/files
        // Get and sort directories/files
        if (function_exists("scandir"))
            $file = scandir($directory);
        else
            $file = php4_scandir($directory);
        natcasesort($file);
        // Make directories first
        $files = $dirs = array();
        foreach ($file as $this_file) {
            if (is_dir("$directory/$this_file"))
                $dirs[] = $this_file;
            else
                $files[] = $this_file;
        }
        $file = array_merge($dirs, $files);

        // Filter unwanted extensions
        if (!empty($extensions)) {
            foreach (array_keys($file) as $key) {
                if (!is_dir("$directory/$file[$key]")) {
                    $ext = substr($file[$key], strrpos($file[$key], ".") + 1);
                    if (!in_array($ext, $extensions))
                        unset($file[$key]);
                }
            }
        }

        if (count($file) > 2) { // Use 2 instead of 0 to account for . and .. "directories"
            $php_file_tree = "<ul";
            if ($first_call) {
                $php_file_tree .= " class=\"php-file-tree\"";
                $first_call = false;
            }
            $php_file_tree .= ">";
            foreach ($file as $this_file) {
                if ($this_file != "." && $this_file != "..") {
                    if (is_dir("$directory/$this_file")) {
                        // Directory
                        $php_file_tree .= "<li class=\"pft-directory\"><a href=\"#\">" . htmlspecialchars($this_file) . "</a>";
                        $php_file_tree .= $this->php_file_tree_dir("$directory/$this_file", $return_link, $extensions, false);
                        $php_file_tree .= "</li>";
                    } else {
                        // File
                        // Get extension (prepend 'ext-' to prevent invalid classes from extensions that begin with numbers)
                        $ext = "ext-" . substr($this_file, strrpos($this_file, ".") + 1);
                        $link = str_replace("[link]", "$directory/" . urlencode($this_file), $return_link);
                        $php_file_tree .= "<li class=\"pft-file " . strtolower($ext) . "\"><a href=\"$link\">" . htmlspecialchars($this_file) . "</a></li>";
                    }
                }
            }
            $php_file_tree .= "</ul>";
        }
        return $php_file_tree;
    }

// For PHP4 compatibility
    public function php4_scandir($dir) {
        $dh = opendir($dir);
        while (false !== ($filename = readdir($dh))) {
            $files[] = $filename;
        }
        sort($files);
        return($files);
    }

    public function getLogic() {
        $data = $this->php_file_tree("../resources/uncategorized", "javascript:$(document).ready(function(){ $('.file-link').attr('value','[link]')});");

        return view('drips/logic')->with(array(
                    'data' => $data
        ));
    }

    public function getDripStruct() {

      return view('drips/confirm')->with(['flash' => ['message' => trans('Phrase has been Updated successfully.'),]]);
    }

    public function postDripStruct() {
        $data['data'] = \Request::get('data');
        \App\DripPrograms::insertDrip($data);
    }

}

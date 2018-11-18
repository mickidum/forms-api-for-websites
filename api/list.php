<?php 

session_start(); 
if (@$_POST['logout']) {
    unset($_SESSION['logged']);
    header("Location: ../index.php"); 
    exit; 
}

if(!$_SESSION['logged']){ 
    header("Location: ../index.php"); 
    exit; 
}

if($_SESSION['logged']){ 

header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

@$table_titles = fopen('table_content.txt', 'r');
@$table_titles_list = fread($table_titles, filesize("table_content.txt"));
@$filename = fopen('temp_file_name.txt', 'r');
@$filename_title = fread($filename, filesize('temp_file_name.txt'));
@$file = fopen('html/'.$filename_title.'.html', 'r');
@$list = fread($file, filesize('html/'.$filename_title.'.html'));
@fclose($file);
@fclose($table_titles);
@fclose($filename);
$table_titles_list = explode(',', $table_titles_list);
// SCAN DIRECTORIES WITH FILES
$htmlfiles = array_diff(scandir('html', 1), array('.', '..', 'index.php')); 

if (@$_POST['pretty_links']) {
  $html_file = $_POST['htmlfile'];
  include $html_file;
  exit;
}
if (@$_POST['delete']) {
  $html_file = $_POST['htmlfile'];
  $csv_file = $_POST['csvfile'];
  unlink($html_file);
  unlink($csv_file);
  header("Location: ../index.php"); 
  exit; 
}
if (@$_POST['popup']) {
  $html_file = $_POST['htmlfile'];
  include $html_file;
  exit;
}
if (@$_POST['csvlink']) {
  $csv_file = $_POST['csvfile'];
  include $csv_file;
  exit;
}
?>

<!doctype html>
<html class="no-js" lang="en" dir="rtl">
  <head>
    <meta charset="utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="robots" content="noindex, nofollow">
    <title>Register System</title>

    <link rel="stylesheet" href="styles/foundation.css">    
    <link rel="stylesheet" href="styles/style.css">
  </head>

<body>
<!-- Logout button -->
<a href="#" class="exit" id="exit">exit</a>

<?php if(count($htmlfiles) > 1): ?>

    <?php 
    if (!$list) {
        $filename_title = str_replace('.html', '', $htmlfiles[count($htmlfiles) - 1]);
        @$file = fopen('html/'.$filename_title.'.html', 'r');
        @$list = fread($file, filesize('html/'.$filename_title.'.html'));
        @fclose($file);
    }
    ?>

    <?php if(count($htmlfiles) > 1): ?>
    <div class="sidebar">
        <h2><span dir="rtl">הצגת רשימות אחרות מאתר</span></h2>
        <div dir="ltr" class="htmllinks">
            <?php 
                foreach ($htmlfiles as $link) {
                    if ($link !== $filename_title.'.html') {
                        $link_id = str_replace('.html', '', $link);
                        $link_id_title = str_replace('_', ' ', $link_id);
                        echo '<a id="'.$link_id.'" href="#">'.$link_id_title.'</a>';
                    }
                }
            ?>
        </div>
    </div>
    <style>
    .wrapper {
        margin: 0;
    }
    </style>
    <?php endif; ?>



    <div class="wrapper">
        <span class="name"><?php echo 'Welcome, '.$_SESSION['username']; ?></span>
        <div class="row">
            <div class="large-12 columns">
                <h1>אתר <a target="_blank" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>"><?php echo $_SERVER['HTTP_HOST']; ?></a> - נרשמים</h1>
            </div>
        </div>
        <br>
        <div class="content">
            <div class="event-code-name">
              <strong>שם קובץ</strong><span class="event-code-name-head"> <?php echo $filename_title; ?></span>
            </div>
             <?php echo $list ?>
             </tbody>
            </table>
        </div>
        <div class="csv-footer">
            <a class="popup-csv-link" data-csv="<?php echo $filename_title; ?>" href="#">קובץ CSV להורדה ↓</a>
            <a class="delete-link" data-delete="<?php echo $filename_title; ?>" href="#">DELETE</a>
        </div>
    </div>

<?php else: ?>

    <h1>אתר <a target="_blank" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>"><?php echo $_SERVER['HTTP_HOST']; ?></a> - נרשמים: <span style="color: red;">אין נתונים</span></h1>

<?php endif ?>

<!-- popup -->
<div id="popup" class="popup">
    <div dir="ltr" class="loading"><span>loading</span></div>
    <div class="hdr">
        <button class="left closebtn small button">close</button>
    </div>
    <div class="csv-footer">
        <a id="popup-csv-link" class="popup-csv-link" href="#">קובץ CSV להורדה ↓</a>
        <a href="#" id="delete-link" class="delete-link">DELETE</a>
    </div>
    <div class="content">
        <div class="row collapse expanded">
            <div class="large-12 columns">
                <div class="event-code-name">
                  <strong>שם קובץ</strong><span id="event_c_name"></span>
                </div>
                <span id="res"></span>
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="styles/app.js"></script>
</body>
</html>

<?php } ?>